<?php

namespace App\Controllers;

use App\Models\KomisariatModel;
use App\Models\PengajuanSkHistoryModel;
use App\Models\PengajuanSkModel;
use App\Models\SiteModel;
use CodeIgniter\I18n\Time;

class PermohonanSkController extends BaseController
{
    private array $fileFields = [
        'surat_pengajuan_sk',
        'berita_acara_rtk',
        'berita_acara_formatur',
        'struktur_kepengurusan',
        'laporan_pertanggungjawaban_demisioner',
        'dokumentasi_rtk',
        'sertifikat_pkd_ketua_bph',
        'cv_pengurus_ktm_ktp_transkrip',
        'cv_bph_komisariat',
        'database_anggota',
    ];

    private array $fileLabels = [
        'surat_pengajuan_sk'                    => 'Surat Pengajuan SK',
        'berita_acara_rtk'                      => 'Berita Acara RTK',
        'berita_acara_formatur'                 => 'Berita Acara Formatur',
        'struktur_kepengurusan'                 => 'Struktur Kepengurusan',
        'laporan_pertanggungjawaban_demisioner' => 'Laporan Pertanggungjawaban Pengurus Demisioner',
        'dokumentasi_rtk'                       => 'Dokumentasi RTK',
        'sertifikat_pkd_ketua_bph'              => 'Fotocopy Sertifikat PKD bagi Ketua dan BPH Komisariat',
        'cv_pengurus_ktm_ktp_transkrip'         => 'CV Pengurus Komisariat (KTM, KTP, Transkrip Nilai)',
        'cv_bph_komisariat'                     => 'CV Badan Pengurus Harian (BPH) Komisariat',
        'database_anggota'                      => 'Database Anggota Lengkap',
    ];

    public function index()
    {
        $komisariatModel = new KomisariatModel();
        $siteModel       = new SiteModel();

        // Hapus sisa berkas temp jika bukan hasil redirect gagal validasi submit
        if (! session()->getFlashdata('keep_sk_temp')) {
            $this->clearTempFiles('sk_temp_files');
        }

        $data = [
            'title'      => 'Permohonan SK Pengurus Komisariat',
            'active'     => 'Permohonan SK',
            'komisariat' => $komisariatModel->getActiveKomisariat(),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tempFiles'  => $this->getValidTempFiles('sk_temp_files'),
            'site'       => $siteModel->first(),
        ];

        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');

        return view('permohonan_sk/index', $data);
    }

    public function store()
    {
        $pengajuanSkModel = new PengajuanSkModel();

        // Normalisasi nomor WhatsApp (hapus spasi, strip, titik, atau +62/62 -> 08...)
        $rawWhatsapp        = (string) $this->request->getPost('whatsapp');
        $normalizedWhatsapp = $this->normalizeWhatsapp($rawWhatsapp);
        $_POST['whatsapp']  = $normalizedWhatsapp;

        // Simpan sementara file PDF baru yang sudah valid agar tidak hilang jika ada field lain yang error
        $tempFiles = $this->cacheValidUploadedFiles('sk_temp_files');

        $komisariatId = (int) $this->request->getPost('komisariat_id');

        if ($komisariatId > 0 && $pengajuanSkModel->hasActiveSubmissionByKomisariat($komisariatId)) {
            return redirect()->back()
                ->withInput()
                ->with('keep_sk_temp', true)
                ->with('error', 'Komisariat ini sudah memiliki pengajuan aktif yang sedang diproses.');
        }

        $rules = [
            'nama_pemohon'  => 'required|min_length[3]|max_length[150]',
            'whatsapp'      => 'required|regex_match[/^08[1-9][0-9]{7,11}$/]',
            'komisariat_id' => 'required|is_natural_no_zero',
        ];

        $messages = [
            'nama_pemohon' => [
                'required'   => 'Nama lengkap pemohon wajib diisi.',
                'min_length' => 'Nama lengkap pemohon minimal 3 karakter.',
                'max_length' => 'Nama lengkap pemohon maksimal 150 karakter.',
            ],
            'whatsapp' => [
                'required'    => 'Nomor WhatsApp aktif wajib diisi.',
                'regex_match' => 'Format nomor WhatsApp tidak valid. Gunakan nomor HP Indonesia yang aktif (contoh: 081234567890).',
            ],
            'komisariat_id' => [
                'required'           => 'Silakan pilih Komisariat terlebih dahulu.',
                'is_natural_no_zero' => 'Pilihan Komisariat tidak valid.',
            ],
        ];

        foreach ($this->fileFields as $field) {
            $label = $this->fileLabels[$field] ?? $field;
            if (isset($tempFiles[$field])) {
                $rules[$field] = "if_exist|max_size[{$field},10240]|ext_in[{$field},pdf,PDF]";
            } else {
                $rules[$field] = "uploaded[{$field}]|max_size[{$field},10240]|ext_in[{$field},pdf,PDF]";
            }

            $messages[$field] = [
                'uploaded' => "Dokumen {$label} wajib diunggah.",
                'max_size' => "Ukuran file {$label} maksimal 10 MB.",
                'ext_in'   => "File {$label} harus berformat PDF.",
            ];
        }

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('keep_sk_temp', true)
                ->with('validation', $this->validator);
        }

        $kodePengajuan = $this->generateKodePengajuan();
        $uploadPath    = WRITEPATH . 'uploads/pengajuan_sk/' . $kodePengajuan;

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $uploadedFiles = [];

        foreach ($this->fileFields as $field) {
            $newName = $field . '.pdf';
            $file    = $this->request->getFile($field);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $file->move($uploadPath, $newName, true);
                $uploadedFiles[$field] = 'uploads/pengajuan_sk/' . $kodePengajuan . '/' . $newName;
            } elseif (isset($tempFiles[$field]) && is_file($tempFiles[$field]['path'])) {
                rename($tempFiles[$field]['path'], $uploadPath . '/' . $newName);
                $uploadedFiles[$field] = 'uploads/pengajuan_sk/' . $kodePengajuan . '/' . $newName;
            }
        }

        $this->clearTempFiles('sk_temp_files');

        $pengajuanSkModel->insert([
            'kode_pengajuan'                        => $kodePengajuan,
            'nama_pemohon'                          => trim((string) $this->request->getPost('nama_pemohon')),
            'whatsapp'                              => $normalizedWhatsapp,
            'komisariat_id'                         => $komisariatId,
            'status'                                => 'menunggu',
            'catatan_admin'                         => null,
            'surat_pengajuan_sk'                    => $uploadedFiles['surat_pengajuan_sk'] ?? null,
            'berita_acara_rtk'                      => $uploadedFiles['berita_acara_rtk'] ?? null,
            'berita_acara_formatur'                 => $uploadedFiles['berita_acara_formatur'] ?? null,
            'struktur_kepengurusan'                 => $uploadedFiles['struktur_kepengurusan'] ?? null,
            'laporan_pertanggungjawaban_demisioner' => $uploadedFiles['laporan_pertanggungjawaban_demisioner'] ?? null,
            'dokumentasi_rtk'                       => $uploadedFiles['dokumentasi_rtk'] ?? null,
            'sertifikat_pkd_ketua_bph'              => $uploadedFiles['sertifikat_pkd_ketua_bph'] ?? null,
            'cv_pengurus_ktm_ktp_transkrip'         => $uploadedFiles['cv_pengurus_ktm_ktp_transkrip'] ?? null,
            'cv_bph_komisariat'                     => $uploadedFiles['cv_bph_komisariat'] ?? null,
            'database_anggota'                      => $uploadedFiles['database_anggota'] ?? null,
            'submitted_at'                          => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        $pengajuanId = $pengajuanSkModel->getInsertID();

        $historyModel = new PengajuanSkHistoryModel();
        $historyModel->insert([
            'pengajuan_sk_id'   => $pengajuanId,
            'aksi'              => 'submit_pengajuan',
            'status_lama'       => null,
            'status_baru'       => 'menunggu',
            'catatan'           => 'Pengajuan baru dibuat oleh pemohon.',
            'performed_by'      => null,
            'performed_by_role' => 'public',
            'created_at'        => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        return redirect()->to('/permohonan-sk/sukses/' . $kodePengajuan);
    }

    public function sukses(string $kodePengajuan)
    {
        $siteModel = new SiteModel();

        $data = [
            'title'          => 'Pengajuan Berhasil',
            'active'         => 'Permohonan SK',
            'kode_pengajuan' => $kodePengajuan,
            'site'           => $siteModel->first(),
        ];

        return view('permohonan_sk/sukses', $data);
    }

    private function generateKodePengajuan(): string
    {
        $prefix = 'SKK-' . date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 5));

        return $prefix . '-' . $random;
    }

    public function cekStatus()
    {
        $siteModel = new SiteModel();

        $data = [
            'title'          => 'Cek Status Pengajuan',
            'active'         => 'Cek Status',
            'site'           => $siteModel->first(),
            'pengajuan'      => session()->getFlashdata('hasil_pengajuan'),
            'komisariat'     => session()->getFlashdata('hasil_komisariat'),
            'kode_pengajuan' => (string) session()->getFlashdata('hasil_kode'),
        ];

        return view('permohonan_sk/cek_status', $data);
    }

    public function hasilStatus()
    {
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel  = new KomisariatModel();

        $kodePengajuan = trim((string) $this->request->getPost('kode_pengajuan'));

        if ($kodePengajuan === '') {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Kode pengajuan wajib diisi.');
        }

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->to('/cek-status-pengajuan')
                ->with('error', 'Kode pengajuan tidak ditemukan.')
                ->with('hasil_kode', $kodePengajuan);
        }

        $komisariat = $komisariatModel->find($pengajuan['komisariat_id']);

        return redirect()->to('/cek-status-pengajuan')
            ->with('hasil_pengajuan', $pengajuan)
            ->with('hasil_komisariat', $komisariat)
            ->with('hasil_kode', $kodePengajuan);
    }

    public function formUploadUlang(string $kodePengajuan)
    {
        $siteModel        = new SiteModel();
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel  = new KomisariatModel();

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Kode pengajuan tidak ditemukan.');
        }

        if (! in_array($pengajuan['status'], ['revisi', 'ditolak'], true)) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Pengajuan ini belum dapat melakukan upload ulang.');
        }

        $komisariat = $komisariatModel->find($pengajuan['komisariat_id']);
        $sessionKey = 'sk_reupload_temp_' . $kodePengajuan;

        // Hapus sisa berkas temp jika bukan hasil redirect gagal validasi
        if (! session()->getFlashdata('keep_sk_temp_reupload')) {
            $this->clearTempFiles($sessionKey);
        }

        $data = [
            'title'      => 'Upload Ulang Pengajuan',
            'active'     => 'Permohonan SK',
            'site'       => $siteModel->first(),
            'pengajuan'  => $pengajuan,
            'komisariat' => $komisariat,
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tempFiles'  => $this->getValidTempFiles($sessionKey),
        ];

        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');

        return view('permohonan_sk/upload_ulang', $data);
    }

    public function submitUploadUlang(string $kodePengajuan)
    {
        $pengajuanSkModel = new PengajuanSkModel();

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Kode pengajuan tidak ditemukan.');
        }

        if (! in_array($pengajuan['status'], ['revisi', 'ditolak'], true)) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Pengajuan ini belum dapat melakukan upload ulang.');
        }

        $sessionKey = 'sk_reupload_temp_' . $kodePengajuan;
        $tempFiles  = $this->cacheValidUploadedFiles($sessionKey);

        $rules    = [];
        $messages = [];

        foreach ($this->fileFields as $field) {
            $label            = $this->fileLabels[$field] ?? $field;
            $rules[$field]    = "if_exist|max_size[{$field},10240]|ext_in[{$field},pdf,PDF]";
            $messages[$field] = [
                'max_size' => "Ukuran file {$label} maksimal 10 MB.",
                'ext_in'   => "File {$label} harus berformat PDF.",
            ];
        }

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('keep_sk_temp_reupload', true)
                ->with('validation', $this->validator);
        }

        $uploadPath = WRITEPATH . 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'];

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $updateData = [
            'status'        => 'menunggu',
            'catatan_admin' => null,
            'submitted_at'  => Time::now('Asia/Jakarta')->toDateTimeString(),
        ];

        $hasUploadedFile = false;

        foreach ($this->fileFields as $field) {
            $newName = $field . '.pdf';
            $file    = $this->request->getFile($field);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $file->move($uploadPath, $newName, true);
                $updateData[$field] = 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'] . '/' . $newName;
                $hasUploadedFile    = true;
            } elseif (isset($tempFiles[$field]) && is_file($tempFiles[$field]['path'])) {
                rename($tempFiles[$field]['path'], $uploadPath . '/' . $newName);
                $updateData[$field] = 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'] . '/' . $newName;
                $hasUploadedFile    = true;
            }
        }

        if (! $hasUploadedFile) {
            return redirect()->back()->with('error', 'Silakan unggah minimal satu file PDF yang ingin diperbarui.');
        }

        $this->clearTempFiles($sessionKey);

        $pengajuanSkModel->update($pengajuan['id'], $updateData);

        $historyModel = new PengajuanSkHistoryModel();
        $historyModel->insert([
            'pengajuan_sk_id'   => $pengajuan['id'],
            'aksi'              => 'upload_ulang',
            'status_lama'       => $pengajuan['status'],
            'status_baru'       => 'menunggu',
            'catatan'           => 'Pemohon melakukan upload ulang berkas.',
            'performed_by'      => null,
            'performed_by_role' => 'public',
            'created_at'        => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        return redirect()->to('/permohonan-sk/sukses/' . $pengajuan['kode_pengajuan'])->with('success', 'Upload ulang berkas berhasil dikirim.');
    }

    /**
     * Normalisasi input nomor WhatsApp Indonesia ke format 08xxxxxxxxxx.
     */
    private function normalizeWhatsapp(string $input): string
    {
        $digits = preg_replace('/[^0-9]/', '', $input) ?? '';

        if (str_starts_with($digits, '62')) {
            $digits = '0' . substr($digits, 2);
        } elseif ($digits !== '' && str_starts_with($digits, '8')) {
            $digits = '0' . $digits;
        }

        return $digits;
    }

    /**
     * Simpan sementara file PDF valid ke folder temp sesi agar tidak hilang saat form reload.
     */
    private function cacheValidUploadedFiles(string $sessionKey): array
    {
        $existing = $this->getValidTempFiles($sessionKey);
        $token    = session()->get($sessionKey . '_token');

        if (! $token || ! preg_match('/^[a-f0-9]{24}$/', (string) $token)) {
            $token = bin2hex(random_bytes(12));
            session()->set($sessionKey . '_token', $token);
        }

        $tempDir = WRITEPATH . 'uploads/temp_sk/' . $token;

        foreach ($this->fileFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $ext  = strtolower((string) $file->getClientExtension());
                $size = (int) $file->getSize();

                if ($ext === 'pdf' && $size > 0 && $size <= 10 * 1024 * 1024) {
                    if (! is_dir($tempDir)) {
                        mkdir($tempDir, 0777, true);
                    }

                    $originalName = $file->getClientName();
                    $targetName   = $field . '.pdf';
                    $file->move($tempDir, $targetName, true);

                    $existing[$field] = [
                        'path' => $tempDir . '/' . $targetName,
                        'name' => $originalName,
                    ];
                }
            }
        }

        session()->set($sessionKey, $existing);

        return $existing;
    }

    private function getValidTempFiles(string $sessionKey): array
    {
        $saved = session()->get($sessionKey);
        if (! is_array($saved)) {
            return [];
        }

        $valid = [];
        foreach ($saved as $field => $info) {
            if (isset($info['path'], $info['name']) && is_file($info['path'])) {
                $valid[$field] = $info;
            }
        }

        return $valid;
    }

    private function clearTempFiles(string $sessionKey): void
    {
        $token = session()->get($sessionKey . '_token');
        if ($token && preg_match('/^[a-f0-9]{24}$/', (string) $token)) {
            $tempDir = WRITEPATH . 'uploads/temp_sk/' . $token;
            if (is_dir($tempDir)) {
                foreach (glob($tempDir . '/*') ?: [] as $file) {
                    if (is_file($file)) {
                        @unlink($file);
                    }
                }
                @rmdir($tempDir);
            }
        }

        session()->remove([$sessionKey, $sessionKey . '_token']);
    }
}
