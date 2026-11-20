<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomisariatModel;
use App\Models\KtaRequestModel;
use App\Models\SiteModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Kta extends BaseController
{
    // Deklarasi tipe data pada properti model
    protected KomisariatModel $komisariatModel;
    protected KtaRequestModel $ktaRequestModel;
    protected SiteModel $siteModel;

    public function __construct()
    {
        $this->komisariatModel = new KomisariatModel();
        $this->ktaRequestModel = new KtaRequestModel();
        $this->siteModel       = new SiteModel();
    }

    /**
     * Tampilan Form Pengajuan KTA
     */
    public function pengajuan()
    {
        $data = [
            'title'      => 'Pengajuan KTA Digital - PC PMII Garut',
            'komisariat' => $this->komisariatModel->getActiveKomisariat(),
            'validation' => \Config\Services::validation(),
            'site'       => $this->siteModel->find(1),
        ];

        return view('kta/form_pengajuan', $data);
    }

    /**
     * Proses Pemrosesan & Simpan Form Pengajuan KTA
     */
    public function store()
    {
        // Validasi Input Form
        $rules = [
            'nim' => [
                'rules'  => 'required|alpha_numeric_punct|min_length[4]|max_length[30]',
                'errors' => [
                    'required'            => 'NIM / NPM wajib diisi.',
                    'alpha_numeric_punct' => 'Format NIM / NPM tidak valid.',
                    'min_length'          => 'NIM / NPM minimal 4 karakter.',
                    'max_length'          => 'NIM / NPM maksimal 30 karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[150]',
                'errors' => [
                    'required'    => 'Alamat email wajib diisi.',
                    'valid_email' => 'Format alamat email tidak valid.',
                    'max_length'  => 'Alamat email maksimal 150 karakter.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'required|min_length[9]|max_length[20]',
                'errors' => [
                    'required'   => 'Nomor HP / WhatsApp wajib diisi.',
                    'min_length' => 'Nomor HP / WhatsApp minimal 9 digit.',
                    'max_length' => 'Nomor HP / WhatsApp maksimal 20 digit.',
                ],
            ],
            'nama_lengkap' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                ],
            ],
            'tempat_lahir' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tempat lahir wajib diisi.'],
            ],
            'tanggal_lahir' => [
                'rules'  => 'required|valid_date',
                'errors' => ['required' => 'Tanggal lahir wajib diisi.'],
            ],
            'alamat' => [
                'rules'  => 'required|min_length[5]',
                'errors' => [
                    'required'   => 'Alamat lengkap wajib diisi.',
                    'min_length' => 'Alamat minimal 5 karakter.',
                ],
            ],
            'jenis_kelamin' => [
                'rules'  => 'required|in_list[L,P]',
                'errors' => ['required' => 'Pilih jenis kelamin.'],
            ],
            'komisariat_id' => [
                'rules'  => 'required|is_not_unique[komisariat.id]',
                'errors' => ['required' => 'Pilih komisariat asal.'],
            ],
            'tahun_mapaba' => [
                'rules'  => 'required|numeric|exact_length[4]',
                'errors' => ['required' => 'Tahun Mapaba wajib diisi.'],
            ],
            'pas_foto' => [
                'rules'  => 'uploaded[pas_foto]|is_image[pas_foto]|mime_in[pas_foto,image/jpg,image/jpeg,image/png]|max_size[pas_foto,2048]',
                'errors' => [
                    'uploaded' => 'Pasfoto formal wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran pasfoto maksimal 2 MB.',
                ],
            ],
            'berkas_bukti' => [
                'rules'  => 'uploaded[berkas_bukti]|mime_in[berkas_bukti,image/jpg,image/jpeg,image/png,application/pdf]|max_size[berkas_bukti,2048]',
                'errors' => [
                    'uploaded' => 'Sertifikat/bukti Mapaba wajib diunggah.',
                    'mime_in'  => 'Format berkas harus JPG, PNG, atau PDF.',
                    'max_size' => 'Ukuran berkas maksimal 2 MB.',
                ],
            ],
        ];

        $nim          = trim((string) $this->request->getPost('nim'));
        $email        = strtolower(trim((string) $this->request->getPost('email')));
        $noHp         = preg_replace('/\D/', '', (string) $this->request->getPost('no_hp'));
        $komisariatId = (int) $this->request->getPost('komisariat_id');

        // 1. Cek duplikat NIM pada komisariat yang sama
        $existingKta = $this->ktaRequestModel
            ->where('nim', $nim)
            ->where('komisariat_id', $komisariatId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingKta) {
            return redirect()->back()->withInput()->with('errors', [
                'nim' => 'NIM ini sudah terdaftar pada pengajuan aktif atau sudah memiliki KTA di komisariat tersebut. Silakan cek pada menu Cek Status Pengajuan.',
            ]);
        }

        // 2. Cek duplikat Email pada pengajuan aktif
        $existingEmail = $this->ktaRequestModel
            ->where('email', $email)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingEmail) {
            return redirect()->back()->withInput()->with('errors', [
                'email' => 'Alamat email ini sudah digunakan pada pengajuan aktif atau KTA yang sudah terbit.',
            ]);
        }

        // 3. Cek duplikat No. HP / WhatsApp pada pengajuan aktif
        $existingHp = $this->ktaRequestModel
            ->where('no_hp', $noHp)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingHp) {
            return redirect()->back()->withInput()->with('errors', [
                'no_hp' => 'Nomor HP / WhatsApp ini sudah digunakan pada pengajuan aktif atau KTA yang sudah terbit.',
            ]);
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload Berkas dengan Nama Acak (Security Best Practice)
        $fileFoto   = $this->request->getFile('pas_foto');
        $fileBukti  = $this->request->getFile('berkas_bukti');

        $nameFoto   = $fileFoto->getRandomName();
        $nameBukti  = $fileBukti->getRandomName();

        $fileFoto->move(WRITEPATH . 'uploads/kta/pasfoto', $nameFoto);
        $fileBukti->move(WRITEPATH . 'uploads/kta/bukti', $nameBukti);

        // Generate UUID Token Unik untuk QR Code
        $uuidToken = bin2hex(random_bytes(16));

        // Simpan Data Pengajuan
        $this->ktaRequestModel->save([
            'uuid_token'    => $uuidToken,
            'nim'           => $nim,
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'email'         => $email,
            'no_hp'         => $noHp,
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat'        => $this->request->getPost('alamat'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'komisariat_id' => $this->request->getPost('komisariat_id'),
            'rayon'         => $this->request->getPost('rayon'),
            'tahun_mapaba'  => $this->request->getPost('tahun_mapaba'),
            'pas_foto'      => $nameFoto,
            'berkas_bukti'  => $nameBukti,
            'status'        => 'pending',
        ]);

        return redirect()->to('/kta/sukses/' . $uuidToken);
    }

    /**
     * Halaman Konfirmasi Sukses Pengajuan
     */
    public function sukses(string $uuidToken)
    {
        $requestData = $this->ktaRequestModel->where('uuid_token', $uuidToken)->first();

        if (! $requestData) {
            throw PageNotFoundException::forPageNotFound('Pengajuan KTA tidak ditemukan.');
        }

        $data = [
            'title' => 'Pengajuan Berhasil - PC PMII Garut',
            'kader' => $requestData,
            'site'  => $this->siteModel->find(1),
        ];

        return view('kta/sukses', $data);
    }

    /**
     * Halaman Publik Hasil Scan QR Code (Public Verification)
     */
    public function verify(string $uuidToken)
    {
        $kader = $this->ktaRequestModel->getByUuid($uuidToken);
        $site  = $this->siteModel->find(1);

        if (! $kader) {
            return view('kta/verify_invalid', [
                'title' => 'Verifikasi KTA - Data Tidak Ditemukan',
                'site'  => $site,
            ]);
        }

        // Data Masking untuk Keamanan Privasi Publik
        $rawNim    = (string) ($kader['nim'] ?? '');
        $lenNim    = strlen($rawNim);
        $maskedNim = $lenNim > 6
            ? substr($rawNim, 0, 3) . str_repeat('*', $lenNim - 6) . substr($rawNim, -3)
            : $rawNim;

        $data = [
            'title'     => 'Verifikasi KTA Sah - PC PMII Garut',
            'kader'     => $kader,
            'maskedNim' => $maskedNim,
            'site'      => $site,
        ];

        return view('kta/verify', $data);
    }

    /**
     * Halaman Form Cek Status KTA
     */
    /**
     * Halaman Form Cek Status KTA
     */
    public function cekStatus()
    {
        $data = [
            'title'      => 'Cek Status Pengajuan KTA - PC PMII Garut',
            'site'       => $this->siteModel->find(1),
            'pengajuan'  => session()->getFlashdata('hasil_kta_pengajuan'),
            'nim_input'  => (string) session()->getFlashdata('hasil_kta_nim'),
            'tgl_input'  => (string) session()->getFlashdata('hasil_kta_tgl'),
            'qrBase64'   => (string) session()->getFlashdata('hasil_kta_qr'),
            'fotoBase64' => (string) session()->getFlashdata('hasil_kta_foto'),
            'logoBase64' => (string) session()->getFlashdata('hasil_kta_logo'),
        ];

        return view('kta/cek_status', $data);
    }

    /**
     * Proses Pencarian Status KTA menggunakan NIM & Tanggal Lahir
     */
    public function hasilStatus()
    {
        $nim          = trim((string) $this->request->getPost('nim'));
        $tanggalLahir = trim((string) $this->request->getPost('tanggal_lahir'));

        if ($nim === '' || $tanggalLahir === '') {
            return redirect()->to('/kta/cek-status')
                ->with('error', 'NIM dan Tanggal Lahir wajib diisi.')
                ->with('hasil_kta_nim', $nim)
                ->with('hasil_kta_tgl', $tanggalLahir);
        }

        // Ambil pengajuan terbaru berdasarkan NIM dan Tanggal Lahir
        $pengajuan = $this->ktaRequestModel
            ->where('nim', $nim)
            ->where('tanggal_lahir', $tanggalLahir)
            ->orderBy('id', 'DESC')
            ->first();

        if (! $pengajuan) {
            return redirect()->to('/kta/cek-status')
                ->with('error', 'Data pengajuan tidak ditemukan. Periksa kembali NIM dan Tanggal Lahir Anda.')
                ->with('hasil_kta_nim', $nim)
                ->with('hasil_kta_tgl', $tanggalLahir);
        }

        // Ambil nama komisariat & kampus
        $komisariat = $this->komisariatModel->find($pengajuan['komisariat_id']);
        $pengajuan['nama_komisariat'] = $komisariat['nama_komisariat'] ?? '-';
        $pengajuan['kampus_fakultas'] = $komisariat['kampus_fakultas'] ?? '';

        // Siapkan Logo PMII Base64
        $logoPath   = FCPATH . 'assets/frontend/img/apple-touch-icon2.png';
        $logoBase64 = is_file($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';

        // Jika sudah disetujui, siapkan QR Code & Pasfoto Base64 untuk pratinjau & unduh JPG
        $qrBase64   = '';
        $fotoBase64 = '';

        if ($pengajuan['status'] === 'approved') {
            $urlVerify = base_url('verify/' . $pengajuan['uuid_token']);
            $qrCode    = QrCode::create($urlVerify)->setSize(150)->setMargin(2);
            $writer    = new PngWriter();
            $qrBase64  = $writer->write($qrCode)->getDataUri();

            $fotoPath = WRITEPATH . 'uploads/kta/pasfoto/' . $pengajuan['pas_foto'];
            if (! empty($pengajuan['pas_foto']) && is_file($fotoPath)) {
                $fotoType   = pathinfo($fotoPath, PATHINFO_EXTENSION);
                $fotoBase64 = 'data:image/' . $fotoType . ';base64,' . base64_encode(file_get_contents($fotoPath));
            }
        }

        return redirect()->to('/kta/cek-status')
            ->with('hasil_kta_pengajuan', $pengajuan)
            ->with('hasil_kta_nim', $nim)
            ->with('hasil_kta_tgl', $tanggalLahir)
            ->with('hasil_kta_qr', $qrBase64)
            ->with('hasil_kta_foto', $fotoBase64)
            ->with('hasil_kta_logo', $logoBase64);
    }

    /**
     * Unduh KTA dalam format PDF oleh Anggota
     */
    public function downloadPdf(string $uuidToken)
    {
        $kader = $this->ktaRequestModel->where('uuid_token', $uuidToken)->first();

        if (! $kader || $kader['status'] !== 'approved') {
            throw PageNotFoundException::forPageNotFound('KTA belum diterbitkan atau tidak ditemukan.');
        }

        $komisariat = $this->komisariatModel->find($kader['komisariat_id']);
        $kader['nama_komisariat'] = $komisariat['nama_komisariat'] ?? '-';
        $kader['kampus_fakultas'] = $komisariat['kampus_fakultas'] ?? '';

        // Generate QR Code Base64
        $urlVerify = base_url('verify/' . $kader['uuid_token']);
        $qrCode    = QrCode::create($urlVerify)->setSize(150)->setMargin(2);
        $writer    = new PngWriter();
        $qrBase64  = $writer->write($qrCode)->getDataUri();

        // Ambil Pasfoto Base64
        $fotoPath   = WRITEPATH . 'uploads/kta/pasfoto/' . $kader['pas_foto'];
        $fotoBase64 = '';
        if (! empty($kader['pas_foto']) && is_file($fotoPath)) {
            $fotoType   = pathinfo($fotoPath, PATHINFO_EXTENSION);
            $fotoBase64 = 'data:image/' . $fotoType . ';base64,' . base64_encode(file_get_contents($fotoPath));
        }

        // Siapkan Logo PMII Base64
        $logoPath   = FCPATH . 'assets/frontend/img/apple-touch-icon2.png';
        $logoBase64 = is_file($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';

        $html = view('admin/kta/pdf_template', [
            'kader'      => $kader,
            'qrBase64'   => $qrBase64,
            'fotoBase64' => $fotoBase64,
            'logoBase64' => $logoBase64,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 242.64, 153.00], 'landscape');
        $dompdf->render();

        $fileName = 'KTA_PMII_' . str_replace('.', '', $kader['nomor_kta']) . '.pdf';
        $dompdf->stream($fileName, ['Attachment' => true]);
    }
}
