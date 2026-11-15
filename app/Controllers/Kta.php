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
            'nik' => [
                'rules'  => 'required|numeric|exact_length[16]',
                'errors' => [
                    'required'     => 'NIK wajib diisi.',
                    'numeric'      => 'NIK harus berupa angka.',
                    'exact_length' => 'NIK harus berjumlah tepat 16 digit.',
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

        $nik = trim((string) $this->request->getPost('nik'));
        $existingKta = $this->ktaRequestModel
            ->where('nik', $nik)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingKta) {
            return redirect()->back()->withInput()->with('errors', [
                'nik' => 'NIK ini sudah terdaftar pada pengajuan aktif atau sudah memiliki KTA. Silakan cek pada menu Cek Status Pengajuan.',
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
            'nik'           => $this->request->getPost('nik'),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
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
        $site = $this->siteModel->find(1);

        if (! $kader) {
            return view('kta/verify_invalid', [
                'title' => 'Verifikasi KTA - Data Tidak Ditemukan',
                'site'  => $site
            ]);
        }

        // Data Masking untuk Keamanan Privasi Publik
        $maskedNik = substr($kader['nik'], 0, 6) . '******' . substr($kader['nik'], -4);

        $data = [
            'title'     => 'Verifikasi KTA Sah - PC PMII Garut',
            'kader'     => $kader,
            'maskedNik' => $maskedNik,
            'site'      => $site,
        ];

        return view('kta/verify', $data);
    }
    /**
     * Halaman Form Cek Status KTA
     */
    public function cekStatus()
    {
        $data = [
            'title' => 'Cek Status Pengajuan KTA - PC PMII Garut',
            'site'  => $this->siteModel->find(1),
        ];

        return view('kta/cek_status', $data);
    }

    /**
     * Proses Pencarian Status KTA menggunakan NIK & Tanggal Lahir
     */
    public function hasilStatus()
    {
        $nik          = trim((string) $this->request->getPost('nik'));
        $tanggalLahir = trim((string) $this->request->getPost('tanggal_lahir'));

        if ($nik === '' || $tanggalLahir === '') {
            return redirect()->back()->withInput()->with('error', 'NIK dan Tanggal Lahir wajib diisi.');
        }

        // Ambil pengajuan terbaru berdasarkan NIK dan Tanggal Lahir
        $pengajuan = $this->ktaRequestModel
            ->where('nik', $nik)
            ->where('tanggal_lahir', $tanggalLahir)
            ->orderBy('id', 'DESC')
            ->first();

        if (! $pengajuan) {
            return redirect()->back()->withInput()->with('error', 'Data pengajuan tidak ditemukan. Periksa kembali NIK dan Tanggal Lahir Anda.');
        }

        // Ambil nama komisariat
        $komisariat = $this->komisariatModel->find($pengajuan['komisariat_id']);
        $pengajuan['nama_komisariat'] = $komisariat['nama_komisariat'] ?? '-';

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

        $data = [
            'title'         => 'Hasil Cek Status KTA - PC PMII Garut',
            'site'          => $this->siteModel->find(1),
            'pengajuan'     => $pengajuan,
            'nik_input'     => $nik,
            'tgl_input'     => $tanggalLahir,
            'qrBase64'      => $qrBase64,
            'fotoBase64'    => $fotoBase64,
        ];

        return view('kta/cek_status', $data);
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

        // Gunakan ulang template PDF KTA yang sudah ada
        $html = view('admin/kta/pdf_template', [
            'kader'      => $kader,
            'qrBase64'   => $qrBase64,
            'fotoBase64' => $fotoBase64,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 242.64, 153.00], 'landscape');
        $dompdf->render();

        $fileName = 'KTA_PMII_' . str_replace('.', '', $kader['nomor_kta']) . '.pdf';
        $dompdf->stream($fileName, ['Attachment' => true]);
    }
}
