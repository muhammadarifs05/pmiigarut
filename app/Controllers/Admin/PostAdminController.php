<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\InboxModel;
use App\Models\PostModel;
use App\Models\TagModel;

class PostAdminController extends BaseController
{
    public function __construct()
    {
        $this->inboxModel = new InboxModel();
        $this->commentModel = new CommentModel();

        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }
    public function index()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'All Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'posts' => $this->postModel->get_all_post()->getResultArray()
        ];

        return view('admin/v_post', $data);
    }
    public function add_new()
    {
        $data = [
            'akun' => $this->akun,
            'title' => 'Add New Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(5),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(6),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll()
        ];
        return view('admin/v_add_post', $data);
    }

    public function publish()
    {
        $data = [
            'title' => htmlspecialchars(strip_tags($this->request->getPost('title')), ENT_QUOTES),
            'slug' => htmlspecialchars(strip_tags($this->request->getPost('slug')), ENT_QUOTES),
            'contents' => $this->request->getPost('contents'),
            // 'filefoto' => $this->request->getFile('filefoto'),
            'category' => htmlspecialchars(strip_tags($this->request->getPost('category')), ENT_QUOTES),
            'tag' => $this->request->getPost('tag')
        ];
        $rules = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    // 'required' => 'inputan tidak boleh mengandung karakter aneh'
                ]
            ],
            'slug' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    // 'required' => 'inputan harus berupa alphaber dan strip'
                ]
            ],
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'filefoto' => [
                'rules' => 'max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'category' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    // 'numeric' => 'inputan harus angka'
                ]
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/post/add_new')->withInput()->with('peringatan', 'Data gagal disimpan dikarenakan ada penginputan yang tidak sesuai. silakan coba lagi!');
        }
        // Cek foto
        if ($this->request->getFile('filefoto')->isValid()) {
            // Ambil File foto
            $fotoUpload = $this->request->getFile('filefoto');
            $namaFotoUpload = $fotoUpload->getRandomName();
            $fotoUpload->move('assets/backend/images/post/', $namaFotoUpload);
        } else {
            $namaFotoUpload = 'default-post.png';
        }

        $validData = $this->validator->getValidated();
        $title = $validData['title'];
        $contents = $validData['contents'];
        $category = $validData['category'];
        $slug = $validData['slug'];
        $description = htmlspecialchars(strip_tags($this->request->getPost('description')), ENT_QUOTES);

        if ($this->postModel->where('post_slug', $slug)->get()->getNumRows() > 0) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }

        // $tags[] = $validData['tag'];
        // foreach ($tags as $tag) {
        //     $tags = implode(",", $tag);
        // }

        $tagInput = $this->request->getPost('tag');

        if (!$tagInput) {
            return redirect()->back()->with('peringatan', 'Tag harus dipilih!');
        }

        $tags = implode(",", $tagInput);

        // Simpan ke database
        $this->postModel->save([
            'post_title' => $title,
            'post_description' => $description,
            'post_contents' => $contents,
            'post_image' => $namaFotoUpload,
            'post_category_id' => $category,
            'post_tags' => $tags,
            'post_slug' => $slug,
            'post_status' => 1,
            'post_views' => 0,
            'post_user_id' => session('id')
        ]);
        return redirect()->to('/admin/post')->with('msg', 'success');
    }

    public function edit($id)
    {
        $post = $this->postModel->find($id);
        $post_tags = explode(',', $post['post_tags']);
        $data = [
            'akun' => $this->akun,
            'title' => 'Edit Post',
            'active' => $this->active,
            'total_inbox' => $this->inboxModel->where('inbox_status', 0)->get()->getNumRows(),
            'inboxs' => $this->inboxModel->where('inbox_status', 0)->findAll(),
            'total_comment' => $this->commentModel->where('comment_status', 0)->get()->getNumRows(),
            'comments' => $this->commentModel->where('comment_status', 0)->findAll(),
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            'categories' => $this->categoryModel->findAll(),
            'post' => $post,
            'tags' => $this->tagModel->findAll(),
            'post_tags' => $post_tags
        ];
        return view('admin/v_edit_post', $data);
    }

    public function update()
    {
        $post_id = $this->request->getPost('post_id');
        $postAwal = $this->postModel->find($post_id);

        if (! $postAwal) {
            return redirect()->to('/admin/post')->with('peringatan', 'Data post tidak ditemukan.');
        }

        $slugInput = (string) $this->request->getPost('slug');
        $slugInput = strtolower($slugInput);
        $slugInput = str_replace(['–', '—'], '-', $slugInput);
        $slugInput = preg_replace('/[^a-z0-9\-]+/', '-', $slugInput);
        $slugInput = preg_replace('/-+/', '-', $slugInput);
        $slugInput = trim($slugInput, '-');

        $data = [
            'post_id'     => $post_id,
            'title'       => htmlspecialchars(strip_tags($this->request->getPost('title')), ENT_QUOTES),
            'slug'        => $slugInput,
            'contents'    => $this->request->getPost('contents'),
            'category'    => htmlspecialchars(strip_tags($this->request->getPost('category')), ENT_QUOTES),
            'tag'         => $this->request->getPost('tag'),
            'description' => htmlspecialchars(strip_tags($this->request->getPost('description')), ENT_QUOTES)
        ];

        $rules = [
            'post_id' => [
                'rules' => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required'           => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'inputan harus angka dan tidak boleh nol atau negatif',
                    'numeric'            => 'inputan harus angka'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'slug' => [
                'rules' => 'required|alpha_dash',
                'errors' => [
                    'required'   => 'Kolom {field} harus diisi!',
                    'alpha_dash' => 'Slug hanya boleh berisi huruf, angka, underscore, dan strip'
                ]
            ],
            'contents' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'filefoto' => [
                'rules' => 'if_exist|max_size[filefoto,2048]|is_image[filefoto]|mime_in[filefoto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in'  => 'Yang anda pilih bukan gambar'
                ]
            ],
            'category' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!',
                    'numeric'  => 'inputan harus angka'
                ]
            ],
            'tag' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi!'
                ]
            ],
            'description' => [
                'rules' => 'permit_empty'
            ],
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->to("/admin/post/$post_id/edit")
                ->withInput()
                ->with('peringatan', 'Data gagal disimpan dikarenakan ada penginputan yang tidak sesuai. silakan coba lagi!');
        }

        $validData   = $this->validator->getValidated();
        $title       = $validData['title'];
        $contents    = $validData['contents'];
        $category    = $validData['category'];
        $slug        = $validData['slug'];
        $description = $validData['description'] ?? '';

        if ($this->postModel->where('post_slug', $slug)->where('post_id !=', $post_id)->countAllResults() > 0) {
            $uniqe_num = rand(1, 999);
            $slug = $slug . '-' . $uniqe_num;
        }

        $tagInput = $this->request->getPost('tag');

        if (! $tagInput) {
            return redirect()->back()->withInput()->with('peringatan', 'Tag harus dipilih!');
        }

        $tags = is_array($tagInput) ? implode(",", $tagInput) : $tagInput;

        $fileFoto = $this->request->getFile('filefoto');
        $fotoAwal = $postAwal['post_image'];

        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            $namaFotoUpload = $fileFoto->getRandomName();
            $fileFoto->move('assets/backend/images/post/', $namaFotoUpload);
        } else {
            $namaFotoUpload = $fotoAwal;
        }

        $this->postModel->save([
            'post_id'          => $post_id,
            'post_title'       => $title,
            'post_description' => $description,
            'post_contents'    => $contents,
            'post_image'       => $namaFotoUpload,
            'post_category_id' => $category,
            'post_tags'        => $tags,
            'post_slug'        => $slug,
            'post_status'      => $postAwal['post_status'],
            'post_views'       => $postAwal['post_views'],
            'post_user_id'     => session('id')
        ]);

        return redirect()->to('/admin/post')->with('msg', 'info');
    }

    public function delete()
    {
        $post_id = $this->request->getPost('id');
        $this->postModel->delete($post_id);
        return redirect()->to('/admin/post')->with('msg', 'success-delete');
    }
}
