<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PengajuanSkHistoryModel;
use App\Models\PengajuanSkModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

class PengajuanSkController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $pengajuanSkModel;
    protected $pengajuanSkHistoryModel;

    protected array $allowedFileFields = [
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

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->pengajuanSkModel = new PengajuanSkModel();
        $this->pengajuanSkHistoryModel = new PengajuanSkHistoryModel();
    }

    public function index()
    {
        $status = trim((string) $this->request->getGet('status'));
        $keyword = trim((string) $this->request->getGet('keyword'));

        $data = [
            'akun'          => $this->akun,
            'title'         => 'Pengajuan SK',
            'active'        => 'pengajuan_sk',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'statusFilter'  => $status ?: 'semua',
            'keywordFilter' => $keyword,
            'pengajuan'     => $this->pengajuanSkModel->getAllWithKomisariat($status, $keyword),
        ];

        return view('admin/v_pengajuan-sk', $data);
    }

    public function detail(int $id)
    {
        $pengajuan = $this->pengajuanSkModel->getDetailWithKomisariat($id);

        if (! $pengajuan) {
            throw PageNotFoundException::forPageNotFound('Data pengajuan SK tidak ditemukan.');
        }

        $data = [
            'akun'          => $this->akun,
            'title'         => 'Detail Pengajuan SK',
            'active'        => 'pengajuan_sk',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'pengajuan'     => $pengajuan,
            'fileFields'    => $this->getFileLabels(),
            'histories'     => $this->pengajuanSkHistoryModel->getByPengajuanId($id),
        ];

        return view('admin/v_pengajuan-sk-detail', $data);
    }

    public function updateStatus(int $id)
    {
        $pengajuan = $this->pengajuanSkModel->find($id);

        if (! $pengajuan) {
            return redirect()->to('/admin/pengajuan-sk')->with('msg', 'error-notfound');
        }

        $rules = [
            'status'        => 'required|in_list[menunggu,diterima,ditolak,revisi]',
            'catatan_admin' => 'permit_empty|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('msg', 'error-validation');
        }

        $statusBaru = (string) $this->request->getPost('status');
        $catatanAdmin = trim((string) $this->request->getPost('catatan_admin'));

        $this->pengajuanSkModel->update($id, [
            'status'        => $statusBaru,
            'catatan_admin' => $catatanAdmin !== '' ? $catatanAdmin : null,
            'reviewed_at'   => Time::now('Asia/Jakarta')->toDateTimeString(),
            'reviewed_by'   => session('id'),
        ]);

        $this->pengajuanSkHistoryModel->insert([
            'pengajuan_sk_id'   => $id,
            'aksi'              => 'update_status',
            'status_lama'       => $pengajuan['status'],
            'status_baru'       => $statusBaru,
            'catatan'           => $catatanAdmin !== '' ? $catatanAdmin : null,
            'performed_by'      => session('id'),
            'performed_by_role' => session('role'),
            'created_at'        => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        return redirect()->to('/admin/pengajuan-sk/' . $id . '/detail')->with('msg', 'status-updated');
    }

    public function previewFile(int $id, string $field)
    {
        if (! in_array($field, $this->allowedFileFields, true)) {
            throw PageNotFoundException::forPageNotFound('Field file tidak valid.');
        }

        $pengajuan = $this->pengajuanSkModel->find($id);

        if (! $pengajuan || empty($pengajuan[$field])) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan.');
        }

        $fullPath = WRITEPATH . $pengajuan[$field];

        if (! is_file($fullPath)) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan di server.');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($fullPath) . '"')
            ->setBody(file_get_contents($fullPath));
    }

    public function downloadFile(int $id, string $field)
    {
        if (! in_array($field, $this->allowedFileFields, true)) {
            throw PageNotFoundException::forPageNotFound('Field file tidak valid.');
        }

        $pengajuan = $this->pengajuanSkModel->find($id);

        if (! $pengajuan || empty($pengajuan[$field])) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan.');
        }

        $fullPath = WRITEPATH . $pengajuan[$field];

        if (! is_file($fullPath)) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan di server.');
        }

        return response()->download($fullPath, null);
    }

    public function delete()
    {
        $id = (int) $this->request->getPost('id');
        $pengajuan = $this->pengajuanSkModel->find($id);

        if (! $pengajuan) {
            return redirect()->to('/admin/pengajuan-sk')->with('msg', 'error-notfound');
        }

        $this->pengajuanSkHistoryModel->insert([
            'pengajuan_sk_id'   => $id,
            'aksi'              => 'delete_pengajuan',
            'status_lama'       => $pengajuan['status'] ?? null,
            'status_baru'       => null,
            'catatan'           => 'Pengajuan dihapus oleh admin.',
            'performed_by'      => session('id'),
            'performed_by_role' => session('role'),
            'created_at'        => Time::now('Asia/Jakarta')->toDateTimeString(),
        ]);

        $uploadDir = WRITEPATH . 'uploads/pengajuan_sk/' . $pengajuan['kode_pengajuan'];

        if (is_dir($uploadDir)) {
            $this->removeDirectory($uploadDir);
        }

        $this->pengajuanSkModel->delete($id);

        return redirect()->to('/admin/pengajuan-sk')->with('msg', 'success-delete');
    }

    private function getFileLabels(): array
    {
        return [
            'surat_pengajuan_sk' => 'Surat Pengajuan SK',
            'berita_acara_rtk' => 'Berita Acara RTK',
            'berita_acara_formatur' => 'Berita Acara Formatur',
            'struktur_kepengurusan' => 'Struktur Kepengurusan',
            'laporan_pertanggungjawaban_demisioner' => 'Laporan Pertanggungjawaban Pengurus Demisioner',
            'dokumentasi_rtk' => 'Dokumentasi RTK',
            'sertifikat_pkd_ketua_bph' => 'Fotocopy Sertifikat PKD bagi Ketua dan BPH Komisariat',
            'cv_pengurus_ktm_ktp_transkrip' => 'CV Pengurus Komisariat + KTM/KTP/Transkrip',
            'cv_bph_komisariat' => 'CV Badan Pengurus Harian Komisariat',
            'database_anggota' => 'Database Anggota Lengkap',
        ];
    }

    private function removeDirectory(string $dirPath): void
    {
        if (! is_dir($dirPath)) {
            return;
        }

        $items = scandir($dirPath);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $dirPath . DIRECTORY_SEPARATOR . $item;

            if (is_dir($fullPath)) {
                $this->removeDirectory($fullPath);
            } elseif (is_file($fullPath)) {
                unlink($fullPath);
            }
        }

        rmdir($dirPath);
    }
}
