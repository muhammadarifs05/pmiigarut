<?php

namespace App\Controllers;

use App\Models\KomisariatModel;
use App\Models\PengajuanSkModel;
use App\Models\PengajuanSkHistoryModel;
use App\Models\SiteModel;
use CodeIgniter\I18n\Time;

class PermohonanSkController extends BaseController
{
    public function index()
    {
        $komisariatModel = new KomisariatModel();
        $siteModel = new SiteModel();

        $data = [
            'title'      => 'Permohonan SK Pengurus Komisariat',
            'active'     => 'Permohonan SK',
            'komisariat' => $komisariatModel->getActiveKomisariat(),
            'validation' => \Config\Services::validation(),
            'site'       => $siteModel->first(),
        ];

        return view('permohonan_sk/index', $data);
    }

    public function store()
    {
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel  = new KomisariatModel();
        $siteModel        = new SiteModel();

        $komisariatId = (int) $this->request->getPost('komisariat_id');

        $existingSubmission = $pengajuanSkModel->hasActiveSubmissionByKomisariat($komisariatId);
        if ($existingSubmission) {
            return redirect()->back()->withInput()->with('error', 'Komisariat ini sudah memiliki pengajuan aktif.');
        }

        $rules = [
            'nama_pemohon' => 'required|min_length[3]|max_length[150]',
            'whatsapp' => 'required|min_length[10]|max_length[20]',
            'komisariat_id' => 'required|is_natural_no_zero',

            'surat_pengajuan_sk' => 'uploaded[surat_pengajuan_sk]|max_size[surat_pengajuan_sk,10240]|ext_in[surat_pengajuan_sk,pdf,PDF]',
            'berita_acara_rtk' => 'uploaded[berita_acara_rtk]|max_size[berita_acara_rtk,10240]|ext_in[berita_acara_rtk,pdf,PDF]',
            'berita_acara_formatur' => 'uploaded[berita_acara_formatur]|max_size[berita_acara_formatur,10240]|ext_in[berita_acara_formatur,pdf,PDF]',
            'struktur_kepengurusan' => 'uploaded[struktur_kepengurusan]|max_size[struktur_kepengurusan,10240]|ext_in[struktur_kepengurusan,pdf,PDF]',
            'laporan_pertanggungjawaban_demisioner' => 'uploaded[laporan_pertanggungjawaban_demisioner]|max_size[laporan_pertanggungjawaban_demisioner,10240]|ext_in[laporan_pertanggungjawaban_demisioner,pdf,PDF]',
            'dokumentasi_rtk' => 'uploaded[dokumentasi_rtk]|max_size[dokumentasi_rtk,10240]|ext_in[dokumentasi_rtk,pdf,PDF]',
            'sertifikat_pkd_ketua_bph' => 'uploaded[sertifikat_pkd_ketua_bph]|max_size[sertifikat_pkd_ketua_bph,10240]|ext_in[sertifikat_pkd_ketua_bph,pdf,PDF]',
            'cv_pengurus_ktm_ktp_transkrip' => 'uploaded[cv_pengurus_ktm_ktp_transkrip]|max_size[cv_pengurus_ktm_ktp_transkrip,10240]|ext_in[cv_pengurus_ktm_ktp_transkrip,pdf,PDF]',
            'cv_bph_komisariat' => 'uploaded[cv_bph_komisariat]|max_size[cv_bph_komisariat,10240]|ext_in[cv_bph_komisariat,pdf,PDF]',
            'database_anggota' => 'uploaded[database_anggota]|max_size[database_anggota,10240]|ext_in[database_anggota,pdf,PDF]',
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title'      => 'Permohonan SK Pengurus Komisariat',
                'active'     => 'Permohonan SK',
                'komisariat' => $komisariatModel->getActiveKomisariat(),
                'validation' => $this->validator,
                'site'       => $siteModel->first(),
            ];

            return view('permohonan_sk/index', $data);
        }

        $kodePengajuan = $this->generateKodePengajuan();

        $uploadPath = WRITEPATH . 'uploads/pengajuan_sk/' . $kodePengajuan;
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileFields = [
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

        $uploadedFiles = [];

        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $newName = $field . '.pdf';
                $file->move($uploadPath, $newName);
                $uploadedFiles[$field] = 'uploads/pengajuan_sk/' . $kodePengajuan . '/' . $newName;
            }
        }

        $pengajuanSkModel->insert([
            'kode_pengajuan' => $kodePengajuan,
            'nama_pemohon' => $this->request->getPost('nama_pemohon'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'komisariat_id' => $komisariatId,
            'status' => 'menunggu',
            'catatan_admin' => null,
            'surat_pengajuan_sk' => $uploadedFiles['surat_pengajuan_sk'] ?? null,
            'berita_acara_rtk' => $uploadedFiles['berita_acara_rtk'] ?? null,
            'berita_acara_formatur' => $uploadedFiles['berita_acara_formatur'] ?? null,
            'struktur_kepengurusan' => $uploadedFiles['struktur_kepengurusan'] ?? null,
            'laporan_pertanggungjawaban_demisioner' => $uploadedFiles['laporan_pertanggungjawaban_demisioner'] ?? null,
            'dokumentasi_rtk' => $uploadedFiles['dokumentasi_rtk'] ?? null,
            'sertifikat_pkd_ketua_bph' => $uploadedFiles['sertifikat_pkd_ketua_bph'] ?? null,
            'cv_pengurus_ktm_ktp_transkrip' => $uploadedFiles['cv_pengurus_ktm_ktp_transkrip'] ?? null,
            'cv_bph_komisariat' => $uploadedFiles['cv_bph_komisariat'] ?? null,
            'database_anggota' => $uploadedFiles['database_anggota'] ?? null,
            'submitted_at' => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        $pengajuanId = $pengajuanSkModel->getInsertID();

        $historyModel = new PengajuanSkHistoryModel();
        $historyModel->insert([
            'pengajuan_sk_id' => $pengajuanId,
            'aksi' => 'submit_pengajuan',
            'status_lama' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru dibuat oleh pemohon.',
            'performed_by' => null,
            'performed_by_role' => 'public',
            'created_at' => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        return redirect()->to('/permohonan-sk/sukses/' . $kodePengajuan);
    }

    public function sukses(string $kodePengajuan)
    {
        $siteModel = new SiteModel();

        $data = [
            'title' => 'Pengajuan Berhasil',
            'active' => 'Permohonan SK',
            'kode_pengajuan' => $kodePengajuan,
            'site' => $siteModel->first(),
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
            'title' => 'Cek Status Pengajuan',
            'active' => 'Cek Status',
            'site' => $siteModel->first(),
        ];

        return view('permohonan_sk/cek_status', $data);
    }

    public function hasilStatus()
    {
        $siteModel = new SiteModel();
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel = new KomisariatModel();

        $kodePengajuan = trim((string) $this->request->getPost('kode_pengajuan'));

        if ($kodePengajuan === '') {
            return redirect()->back()->with('error', 'Kode pengajuan wajib diisi.');
        }

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->back()->with('error', 'Kode pengajuan tidak ditemukan.');
        }

        $komisariat = $komisariatModel->find($pengajuan['komisariat_id']);

        $data = [
            'title' => 'Cek Status Pengajuan',
            'active' => 'Cek Status',
            'site' => $siteModel->first(),
            'pengajuan' => $pengajuan,
            'komisariat' => $komisariat,
            'kode_pengajuan' => $kodePengajuan,
        ];

        return view('permohonan_sk/cek_status', $data);
    }

    public function formUploadUlang(string $kodePengajuan)
    {
        $siteModel = new SiteModel();
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel = new KomisariatModel();

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Kode pengajuan tidak ditemukan.');
        }

        if (! in_array($pengajuan['status'], ['revisi', 'ditolak'], true)) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Pengajuan ini belum dapat melakukan upload ulang.');
        }

        $komisariat = $komisariatModel->find($pengajuan['komisariat_id']);

        $data = [
            'title' => 'Upload Ulang Pengajuan',
            'active' => 'Permohonan SK',
            'site' => $siteModel->first(),
            'pengajuan' => $pengajuan,
            'komisariat' => $komisariat,
            'validation' => \Config\Services::validation(),
        ];

        return view('permohonan_sk/upload_ulang', $data);
    }

    public function submitUploadUlang(string $kodePengajuan)
    {
        $siteModel = new SiteModel();
        $pengajuanSkModel = new PengajuanSkModel();
        $komisariatModel = new KomisariatModel();

        $pengajuan = $pengajuanSkModel->findByKode($kodePengajuan);

        if (! $pengajuan) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Kode pengajuan tidak ditemukan.');
        }

        if (! in_array($pengajuan['status'], ['revisi', 'ditolak'], true)) {
            return redirect()->to('/cek-status-pengajuan')->with('error', 'Pengajuan ini belum dapat melakukan upload ulang.');
        }

        $rules = [
            'surat_pengajuan_sk' => 'if_exist|max_size[surat_pengajuan_sk,10240]|ext_in[surat_pengajuan_sk,pdf,PDF]',
            'berita_acara_rtk' => 'if_exist|max_size[berita_acara_rtk,10240]|ext_in[berita_acara_rtk,pdf,PDF]',
            'berita_acara_formatur' => 'if_exist|max_size[berita_acara_formatur,10240]|ext_in[berita_acara_formatur,pdf,PDF]',
            'struktur_kepengurusan' => 'if_exist|max_size[struktur_kepengurusan,10240]|ext_in[struktur_kepengurusan,pdf,PDF]',
            'laporan_pertanggungjawaban_demisioner' => 'if_exist|max_size[laporan_pertanggungjawaban_demisioner,10240]|ext_in[laporan_pertanggungjawaban_demisioner,pdf,PDF]',
            'dokumentasi_rtk' => 'if_exist|max_size[dokumentasi_rtk,10240]|ext_in[dokumentasi_rtk,pdf,PDF]',
            'sertifikat_pkd_ketua_bph' => 'if_exist|max_size[sertifikat_pkd_ketua_bph,10240]|ext_in[sertifikat_pkd_ketua_bph,pdf,PDF]',
            'cv_pengurus_ktm_ktp_transkrip' => 'if_exist|max_size[cv_pengurus_ktm_ktp_transkrip,10240]|ext_in[cv_pengurus_ktm_ktp_transkrip,pdf,PDF]',
            'cv_bph_komisariat' => 'if_exist|max_size[cv_bph_komisariat,10240]|ext_in[cv_bph_komisariat,pdf,PDF]',
            'database_anggota' => 'if_exist|max_size[database_anggota,10240]|ext_in[database_anggota,pdf,PDF]',
        ];

        if (! $this->validate($rules)) {
            $komisariat = $komisariatModel->find($pengajuan['komisariat_id']);

            $data = [
                'title' => 'Upload Ulang Pengajuan',
                'active' => 'Permohonan SK',
                'site' => $siteModel->first(),
                'pengajuan' => $pengajuan,
                'komisariat' => $komisariat,
                'validation' => $this->validator,
            ];

            return view('permohonan_sk/upload_ulang', $data);
        }

        $fileFields = [
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

        $uploadPath = WRITEPATH . 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'];

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $updateData = [
            'status' => 'menunggu',
            'catatan_admin' => null,
            'submitted_at' => Time::now('Asia/Jakarta')->toDateTimeString(),
        ];

        $hasUploadedFile = false;

        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $newName = $field . '.pdf';
                $file->move($uploadPath, $newName, true);
                $updateData[$field] = 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'] . '/' . $newName;
                $hasUploadedFile = true;
            }
        }

        if (! $hasUploadedFile) {
            return redirect()->back()->with('error', 'Silakan unggah minimal satu file untuk diperbarui.');
        }

        $pengajuanSkModel->update($pengajuan['id'], $updateData);

        $historyModel = new PengajuanSkHistoryModel();
        $historyModel->insert([
            'pengajuan_sk_id' => $pengajuan['id'],
            'aksi' => 'upload_ulang',
            'status_lama' => $pengajuan['status'],
            'status_baru' => 'menunggu',
            'catatan' => 'Pemohon melakukan upload ulang berkas.',
            'performed_by' => null,
            'performed_by_role' => 'public',
            'created_at' => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        return redirect()->to('/permohonan-sk/sukses/' . $pengajuan['kode_pengajuan'])->with('success', 'Upload ulang berkas berhasil dikirim.');
    }
}
