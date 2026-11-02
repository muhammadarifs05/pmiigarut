<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\KomisariatModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KomisariatController extends BaseController
{
    protected $inboxModel;
    protected $commentModel;
    protected $komisariatModel;

    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();
        $this->komisariatModel = new KomisariatModel();
    }

    public function index()
    {
        $data = [
            'akun'          => $this->akun,
            'title'         => 'Komisariat',
            'active'        => 'komisariat',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),

            'komisariat'    => $this->komisariatModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('admin/v_komisariat-view', $data);
    }

    public function add()
    {
        $data = [
            'akun'          => $this->akun,
            'title'         => 'Add Komisariat',
            'active'        => 'komisariat',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'validation'    => \Config\Services::validation(),
        ];

        return view('admin/v_komisariat-add', $data);
    }

    public function save()
    {
        $rules = [
            'nama_komisariat' => 'required|min_length[3]|max_length[150]',
            'kampus_fakultas' => 'required|min_length[3]|max_length[150]',
            'nama_ketua'      => 'required|min_length[3]|max_length[150]',
            'status_aktif'    => 'required|in_list[aktif,nonaktif]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->komisariatModel->insert([
            'nama_komisariat' => $this->request->getPost('nama_komisariat'),
            'kampus_fakultas' => $this->request->getPost('kampus_fakultas'),
            'nama_ketua'      => $this->request->getPost('nama_ketua'),
            'status_aktif'    => $this->request->getPost('status_aktif'),
        ]);

        return redirect()->to('/admin/komisariat')->with('msg', 'success');
    }

    public function edit(int $id)
    {
        $komisariat = $this->komisariatModel->find($id);

        if (! $komisariat) {
            throw PageNotFoundException::forPageNotFound('Data komisariat tidak ditemukan.');
        }

        $data = [
            'akun'          => $this->akun,
            'title'         => 'Edit Komisariat',
            'active'        => 'komisariat',
            'total_inbox'   => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs'        => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments'      => $this->commentModel->where('comment_status', 0)->findAll(6),
            'breadcrumbs'   => $this->request->getUri()->getSegments(),
            'komisariat'    => $komisariat,
            'validation'    => \Config\Services::validation(),
        ];

        return view('admin/v_komisariat-edit', $data);
    }

    public function update(int $id)
    {
        $komisariat = $this->komisariatModel->find($id);

        if (! $komisariat) {
            throw PageNotFoundException::forPageNotFound('Data komisariat tidak ditemukan.');
        }

        $rules = [
            'nama_komisariat' => 'required|min_length[3]|max_length[150]',
            'kampus_fakultas' => 'required|min_length[3]|max_length[150]',
            'nama_ketua'      => 'required|min_length[3]|max_length[150]',
            'status_aktif'    => 'required|in_list[aktif,nonaktif]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->komisariatModel->update($id, [
            'nama_komisariat' => $this->request->getPost('nama_komisariat'),
            'kampus_fakultas' => $this->request->getPost('kampus_fakultas'),
            'nama_ketua'      => $this->request->getPost('nama_ketua'),
            'status_aktif'    => $this->request->getPost('status_aktif'),
        ]);

        return redirect()->to('/admin/komisariat')->with('msg', 'info');
    }

    public function toggleStatus(int $id)
    {
        $komisariat = $this->komisariatModel->find($id);

        if (! $komisariat) {
            return redirect()->to('/admin/komisariat')->with('msg', 'error-notfound');
        }

        $newStatus = $komisariat['status_aktif'] === 'aktif' ? 'nonaktif' : 'aktif';

        $this->komisariatModel->update($id, [
            'status_aktif' => $newStatus,
        ]);

        return redirect()->to('/admin/komisariat')->with('msg', 'status-updated');
    }

    public function delete()
    {
        $id = (int) $this->request->getPost('id');
        $komisariat = $this->komisariatModel->find($id);

        if (! $komisariat) {
            return redirect()->to('/admin/komisariat')->with('msg', 'error-notfound');
        }

        $db = \Config\Database::connect();
        $usedCount = $db->table('pengajuan_sk')
            ->where('komisariat_id', $id)
            ->countAllResults();

        if ($usedCount > 0) {
            return redirect()->to('/admin/komisariat')->with('msg', 'error-used');
        }

        $this->komisariatModel->delete($id);

        return redirect()->to('/admin/komisariat')->with('msg', 'success-delete');
    }
}
