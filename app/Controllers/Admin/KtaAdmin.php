<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\KtaRequestModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

/**
 * @property array $akun
 */
class KtaAdmin extends BaseController
{
    protected KtaRequestModel $ktaRequestModel;
    protected InboxModel $inboxModel;
    protected CommentModel $commentModel;

    public function __construct()
    {
        $this->ktaRequestModel = new KtaRequestModel();
        $this->inboxModel      = new InboxModel();
        $this->commentModel    = new CommentModel();
    }

    public function index()
    {
        $status  = trim((string) $this->request->getGet('status'));
        $keyword = trim((string) $this->request->getGet('keyword'));

        $data = [
            'akun'          => $this->akun,
            'title'         => 'Kelola Pengajuan KTA',
            'active'        => 'kta',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'statusFilter'  => $status ?: 'semua',
            'keywordFilter' => $keyword,
            'requests'      => $this->ktaRequestModel->getFilteredWithKomisariat($status, $keyword),
        ];

        return view('admin/kta/index', $data);
    }

    public function detail(int $id)
    {
        $pengajuan = $this->ktaRequestModel->getRequestsWithKomisariat($id);

        if (! $pengajuan) {
            throw PageNotFoundException::forPageNotFound('Data pengajuan KTA tidak ditemukan.');
        }

        $data = [
            'akun'          => $this->akun,
            'title'         => 'Detail Pengajuan KTA',
            'active'        => 'kta',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'pengajuan'     => $pengajuan,
        ];

        return view('admin/kta/detail', $data);
    }

    public function updateStatus(int $id)
    {
        $pengajuan = $this->ktaRequestModel->find($id);

        if (! $pengajuan) {
            return redirect()->to('/admin/kta')->with('msg', 'error-notfound');
        }

        $statusBaru   = (string) $this->request->getPost('status');
        $catatanAdmin = trim((string) $this->request->getPost('catatan_admin'));

        $updateData = [
            'status'        => $statusBaru,
            'catatan_admin' => $catatanAdmin !== '' ? $catatanAdmin : null,
        ];

        if ($statusBaru === 'approved' && empty($pengajuan['nomor_kta'])) {
            $req            = $this->ktaRequestModel->getRequestsWithKomisariat($id);
            $kodeKomisariat = $req['kode_komisariat'] ?? '00';
            $tahunMapaba    = $req['tahun_mapaba'];

            $count = $this->ktaRequestModel
                ->where('komisariat_id', $req['komisariat_id'])
                ->where('tahun_mapaba', $tahunMapaba)
                ->where('status', 'approved')
                ->countAllResults();

            $nomorUrut                 = str_pad((string) ($count + 1), 4, '0', STR_PAD_LEFT);
            $updateData['nomor_kta']   = "32.05.{$kodeKomisariat}.{$tahunMapaba}.{$nomorUrut}";
            $updateData['approved_at'] = date('Y-m-d H:i:s');
        }

        $this->ktaRequestModel->update($id, $updateData);

        return redirect()->to('/admin/kta/' . $id . '/detail')->with('msg', 'status-updated');
    }

    public function delete()
    {
        $id        = (int) $this->request->getPost('id');
        $pengajuan = $this->ktaRequestModel->find($id);

        if (! $pengajuan) {
            return redirect()->to('/admin/kta')->with('msg', 'error-notfound');
        }

        if (! empty($pengajuan['pas_foto'])) {
            $fotoPath = WRITEPATH . 'uploads/kta/pasfoto/' . $pengajuan['pas_foto'];
            if (is_file($fotoPath)) {
                unlink($fotoPath);
            }
        }

        if (! empty($pengajuan['berkas_bukti'])) {
            $berkasPath = WRITEPATH . 'uploads/kta/berkas/' . $pengajuan['berkas_bukti'];
            if (is_file($berkasPath)) {
                unlink($berkasPath);
            }
        }

        $this->ktaRequestModel->delete($id);

        return redirect()->to('/admin/kta')->with('msg', 'success-delete');
    }

    public function exportPdf(int $id)
    {
        $kader = $this->ktaRequestModel->getRequestsWithKomisariat($id);
        if (! $kader || $kader['status'] !== 'approved') {
            return redirect()->back()->with('error', 'KTA belum di-approve.');
        }

        $urlVerify = base_url('verify/' . $kader['uuid_token']);
        $qrCode    = QrCode::create($urlVerify)->setSize(150)->setMargin(2);
        $writer    = new PngWriter();
        $qrBase64  = $writer->write($qrCode)->getDataUri();

        $fotoPath   = WRITEPATH . 'uploads/kta/pasfoto/' . $kader['pas_foto'];
        $fotoBase64 = '';
        if (is_file($fotoPath)) {
            $fotoType   = pathinfo($fotoPath, PATHINFO_EXTENSION);
            $fotoBase64 = 'data:image/' . $fotoType . ';base64,' . base64_encode(file_get_contents($fotoPath));
        }

        $html = view('admin/kta/pdf_template', [
            'kader'      => $kader,
            'qrBase64'   => $qrBase64,
            'fotoBase64' => $fotoBase64,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 242.64, 153.00], 'landscape');
        $dompdf->render();
        $dompdf->stream('KTA_PMII_' . str_replace('.', '', $kader['nomor_kta']) . '.pdf', ['Attachment' => false]);
    }
}
