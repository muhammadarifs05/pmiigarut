<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\KtaRequestModel;
use CodeIgniter\Exceptions\PageNotFoundException;
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
        $isBaruApprove = ($statusBaru === 'approved' && $pengajuan['status'] !== 'approved');

        $updateData = [
            'status'        => $statusBaru,
            'catatan_admin' => $catatanAdmin !== '' ? $catatanAdmin : null,
        ];

        $db = \Config\Database::connect();
        $db->transStart();

        if ($statusBaru === 'approved' && empty($pengajuan['nomor_kta'])) {
            $req            = $this->ktaRequestModel->getRequestsWithKomisariat($id);
            $kodeKomisariat = (string) ($req['kode_komisariat'] ?? '00');
            $tahunMapaba    = (string) ($req['tahun_mapaba'] ?? date('Y'));

            $updateData['nomor_kta']   = $this->generateUniqueNia($kodeKomisariat, $tahunMapaba);
            $updateData['approved_at'] = date('Y-m-d H:i:s');
        }

        $this->ktaRequestModel->update($id, $updateData);
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/admin/kta/' . $id . '/detail')->with('error', 'Gagal memproses persetujuan dan pembuatan NIA.');
        }

        // Kirim notifikasi email jika status baru saja disetujui
        if ($isBaruApprove) {
            $kaderApproved = $this->ktaRequestModel->getRequestsWithKomisariat($id);
            if (! empty($kaderApproved['email'])) {
                $this->sendApprovalEmail($kaderApproved);
            }
        }

        return redirect()->to('/admin/kta/' . $id . '/detail')->with('msg', 'status-updated');
    }

    private function sendApprovalEmail(array $kader): bool
    {
        try {
            $email = \Config\Services::email();
            $email->setTo($kader['email']);
            $email->setSubject('KTA Digital PMII Kabupaten Garut Anda Telah Terbit');

            $cekStatusUrl = base_url('kta/cek-status');
            $verifyUrl    = base_url('verify/' . $kader['uuid_token']);

            $message = "
                <div style='font-family: Arial, sans-serif; color: #1e293b; line-height: 1.6; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;'>
                    <div style='background: #0c44a6; color: #ffffff; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 18px;'>PC PMII KABUPATEN GARUT</h2>
                        <p style='margin: 4px 0 0 0; font-size: 12px; color: #f3c430;'>Sistem Informasi Keanggotaan & KTA Digital</p>
                    </div>
                    <div style='padding: 24px;'>
                        <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                        <p>Sahabat/i <strong>" . esc($kader['nama_lengkap']) . "</strong>,</p>
                        <p>Selamat! Pengajuan Kartu Tanda Anggota (KTA) Digital Anda telah <strong>diverifikasi dan disetujui</strong> oleh Pengurus Cabang PMII Kabupaten Garut.</p>
                        <table style='width: 100%; background: #f8fafc; border-collapse: collapse; margin: 16px 0;'>
                            <tr>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0; width: 35%;'><strong>Nomor Induk Anggota (NIA)</strong></td>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0; color: #0c44a6; font-weight: bold;'>" . esc($kader['nomor_kta']) . "</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0;'><strong>NIM</strong></td>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0;'>" . esc($kader['nim']) . "</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0;'><strong>Komisariat</strong></td>
                                <td style='padding: 8px 12px; border: 1px solid #e2e8f0;'>" . esc($kader['nama_komisariat'] ?? '-') . "</td>
                            </tr>
                        </table>
                        <p>Anda dapat mengunduh file KTA Digital (format <strong>PDF</strong> maupun <strong>JPG</strong>) melalui halaman Cek Status menggunakan <strong>NIM</strong> dan <strong>Tanggal Lahir</strong> Anda:</p>
                        <p style='text-align: center; margin: 24px 0;'>
                            <a href='{$cekStatusUrl}' style='background: #106eea; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;'>Unduh KTA Digital Sekarang</a>
                        </p>
                        <p style='font-size: 12px; color: #64748b;'>Tautan verifikasi keabsahan KTA: <a href='{$verifyUrl}'>{$verifyUrl}</a></p>
                        <hr style='border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;'>
                        <p style='margin: 0; font-size: 13px;'>Wallahul Muwaffiq Ila Aqwamith Tharieq,<br>Wassalamu'alaikum Warahmatullahi Wabarakatuh.<br><strong>PC PMII Kabupaten Garut</strong></p>
                    </div>
                </div>
            ";

            $email->setMessage($message);

            if (! $email->send()) {
                log_message('error', 'Gagal mengirim email KTA ke ' . $kader['email'] . ': ' . $email->printDebugger(['headers']));
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            log_message('error', 'Exception email KTA: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Menghasilkan NIA unik tanpa pemisah: [4 Digit Tahun MAPABA] + V02 + [2 Digit Kode Komisariat] + [4 Digit Urut]
     * Contoh: 2024V02040001
     */
    private function generateUniqueNia(string $kodeKomisariat, string $tahunMapaba): string
    {
        $tahunClean = substr(preg_replace('/\D/', '', $tahunMapaba), 0, 4);
        $tahun4     = str_pad($tahunClean !== '' ? $tahunClean : date('Y'), 4, '0', STR_PAD_LEFT);

        $kodeClean = preg_replace('/\D/', '', $kodeKomisariat);
        $kode2     = str_pad($kodeClean !== '' ? substr($kodeClean, -2) : '00', 2, '0', STR_PAD_LEFT);

        // Prefix 9 karakter: contoh "2024V0204"
        $prefix = $tahun4 . 'V02' . $kode2;

        // Ambil seluruh NIA yang sudah terbit dengan prefix angkatan & komisariat yang sama
        $existingRows = $this->ktaRequestModel
            ->select('nomor_kta')
            ->like('nomor_kta', $prefix, 'after')
            ->findAll();

        $maxUrut = 0;
        foreach ($existingRows as $row) {
            $nia = (string) ($row['nomor_kta'] ?? '');
            if (strpos($nia, $prefix) === 0) {
                $tail = (int) substr($nia, strlen($prefix), 4);
                if ($tail > $maxUrut) {
                    $maxUrut = $tail;
                }
            }
        }

        $nextUrut = $maxUrut + 1;

        // Pastikan NIA benar-benar belum ada di database sebelum dikembalikan
        do {
            $candidateNia = $prefix . str_pad((string) $nextUrut, 4, '0', STR_PAD_LEFT);
            $isDuplicate  = $this->ktaRequestModel
                ->where('nomor_kta', $candidateNia)
                ->countAllResults() > 0;
            $nextUrut++;
        } while ($isDuplicate);

        return $candidateNia;
    }

    public function previewFile(int $id, string $field)
    {
        if (! in_array($field, ['pas_foto', 'berkas_bukti'], true)) {
            throw PageNotFoundException::forPageNotFound('Field file tidak valid.');
        }

        $pengajuan = $this->ktaRequestModel->find($id);

        if (! $pengajuan || empty($pengajuan[$field])) {
            throw PageNotFoundException::forPageNotFound('Data file tidak ditemukan.');
        }

        $fullPath = $this->resolveFilePath($field, (string) $pengajuan[$field]);

        if ($fullPath === null) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan di server.');
        }

        $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($fullPath) . '"')
            ->setBody(file_get_contents($fullPath));
    }

    public function downloadFile(int $id, string $field)
    {
        if (! in_array($field, ['pas_foto', 'berkas_bukti'], true)) {
            throw PageNotFoundException::forPageNotFound('Field file tidak valid.');
        }

        $pengajuan = $this->ktaRequestModel->find($id);

        if (! $pengajuan || empty($pengajuan[$field])) {
            throw PageNotFoundException::forPageNotFound('Data file tidak ditemukan.');
        }

        $fullPath = $this->resolveFilePath($field, (string) $pengajuan[$field]);

        if ($fullPath === null) {
            throw PageNotFoundException::forPageNotFound('File tidak ditemukan di server.');
        }

        return $this->response->download($fullPath, null);
    }

    public function delete()
    {
        $id        = (int) $this->request->getPost('id');
        $pengajuan = $this->ktaRequestModel->find($id);

        if (! $pengajuan) {
            return redirect()->to('/admin/kta')->with('msg', 'error-notfound');
        }

        foreach (['pas_foto', 'berkas_bukti'] as $field) {
            if (! empty($pengajuan[$field])) {
                $filePath = $this->resolveFilePath($field, (string) $pengajuan[$field]);
                if ($filePath !== null && is_file($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $this->ktaRequestModel->delete($id);

        return redirect()->to('/admin/kta')->with('msg', 'success-delete');
    }

    private function resolveFilePath(string $field, string $storedValue): ?string
    {
        $cleanValue = ltrim(str_replace(['\\', '../'], ['/', ''], $storedValue), '/');

        $candidates = [
            WRITEPATH . $cleanValue,
            FCPATH . $cleanValue,
        ];

        if ($field === 'pas_foto') {
            $candidates[] = WRITEPATH . 'uploads/kta/pasfoto/' . basename($cleanValue);
            $candidates[] = FCPATH . 'uploads/kta/pasfoto/' . basename($cleanValue);
        } else {
            $candidates[] = WRITEPATH . 'uploads/kta/berkas/' . basename($cleanValue);
            $candidates[] = WRITEPATH . 'uploads/kta/sertifikat/' . basename($cleanValue);
            $candidates[] = WRITEPATH . 'uploads/kta/bukti/' . basename($cleanValue);
            $candidates[] = WRITEPATH . 'uploads/kta/' . basename($cleanValue);
            $candidates[] = FCPATH . 'uploads/kta/berkas/' . basename($cleanValue);
            $candidates[] = FCPATH . 'uploads/kta/sertifikat/' . basename($cleanValue);
        }

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
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

        $fotoBase64 = '';
        if (! empty($kader['pas_foto'])) {
            $fotoPath = $this->resolveFilePath('pas_foto', (string) $kader['pas_foto']);
            if ($fotoPath !== null && is_file($fotoPath)) {
                $mimeType   = mime_content_type($fotoPath) ?: 'image/jpeg';
                $fotoBase64 = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($fotoPath));
            }
        }

        $logoPath   = FCPATH . 'assets/frontend/img/apple-touch-icon2.png';
        $logoBase64 = is_file($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';

        return view('admin/kta/pdf_template', [
            'kader'      => $kader,
            'qrBase64'   => $qrBase64,
            'fotoBase64' => $fotoBase64,
            'logoBase64' => $logoBase64,
        ]);
    }
}
