<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class AdminController extends BaseController
{
    protected $accountModel;
    public function __construct()
    {
        $this->accountModel = new AccountModel(); // this jst for private use on thsi controller, not global, check Basecontroller or see the global !
    }
    public function index(): string
    {
        // Cara koneksi tanpa Model (tidak dianjurkan)
        // $db = \Config\Database::connect();
        // $accounts = $db->query("SELECT * FROM accounts");
        // dd($db); masih mentah
        // foreach ($accounts->getResultArray() as $account) { fetching terlebih dahulu secara manual
        //     d($account);
        // }

        // cara koneksi menggunakan models
        // dd($this->accountModel->findAll());
        // $data = [
        //     'title' => 'Home - User',
        //     'account' => $this->accountModel->findAll(),
        // ];
        $data = [
            'title' => 'Home - Admin',
            'account' => $this->accountModel->getUser(),
        ];
        return view('Admin/home', $data);
    }
    public function get_data($id)
    {
        $data = [
            'title' => 'detail - User',
            'account' => $this->accountModel->getUser($id),
        ];

        if(empty($data['account'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User dengan ID "'. $id . '" tidak ditemukan');
        }
        return view('Admin/detailUser', $data);

    }
    public function get_data_no_query($model)
    {
        // $user = $this->accountModel->getUser($id);
        dd($model);
    }

    public function add()
    {
        // dd(session());
        $data =  [
            'title' => 'form Tambah User',
            // 'validation' => \Config\Services::validation(),
        ];
        return view('Admin/add', $data);
    }
    public function do_add()
    {
        // validasi input 
        // session();

        if(!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[accounts.username]',
                'error' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah dipakai, coba yang lain.',
                ]
            ],
            'password' => 'required|min_length[5]',
            'image' => 'max_size[image,3024]|is_image[image]|mime_in[image, image/jpg,image/jpeg,image/png]',
        ])) {
            // $validation = \Config\Services::validation();
            // dd($validation->listErrors());
            // return redirect()->to('/user/add')->withInput()->with('validation', $validation);
            return redirect()->to('/user/add')->withInput()->with('errors', $this->validator->getErrors());
        }
        // untuk membuat slug seperti blog
        // $slug = url_title($this->request->getVar('username'), '-', true);

        // catch image upload
        $fileImage = $this->request->getFile('image');
        //apakah tidak ada gambar yang diupload
        if($fileImage->getError() == 4) {
            $nameImage = 'image.png';
        }else{
            // generate random name
            $nameImage = $fileImage->getRandomName();
            // pindahkan file ke folder img
            $fileImage->move('image', $nameImage);
            // ambil nama file 
            // $pathImage = $fileImage->getName();
            // dd($nameImage); 
        }
        $this->accountModel->save([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'image' => $nameImage,
        ]);

        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        return redirect()->to('/');
    }

    public function update($id)
    {
        $data =  [
            'title' => 'form Edit User',
            'validation' => \Config\Services::validation(),
            'account' => $this->accountModel->getUser($id)
        ];
        return view('Admin/update', $data);
    }
    public function do_update($id)
    {
        // cek juldul
        $oldUser = $this->accountModel->getUser($id);
        if($oldUser['username'] == $this->request->getVar('username')){
            $ruleUsername = 'required';
        }else {
            $ruleUsername = 'required|is_unique[accounts.username]';
        }
        if(!$this->validate([
            'username' => [
                'rules' => $ruleUsername,
                'error' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah dipakai, coba yang lain.',
                ]
            ],
            'password' => 'required|min_length[5]',
            'image' => 'max_size[image,3024]|is_image[image]|mime_in[image, image/jpg,image/jpeg,image/png]',
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to("/user/update/$id")->withInput()->with('validation', $validation);
            return redirect()->to("/user/update/$id")->withInput();
        }

        // catch image upload
        $fileImage = $this->request->getFile('image');
        //apakah tidak ada gambar yang diupload
        if($fileImage->getError() == 4) {
            $nameImage = 'image.png';
        }else{
            // generate random name
            $nameImage = $fileImage->getRandomName();
            // pindahkan file ke folder img
            $fileImage->move('image', $nameImage);
            // ambil nama file 
            // $pathImage = $fileImage->getName();
            // dd($nameImage); 
        }

        // untuk membuat slug seperti blog
        // $slug = url_title($this->request->getVar('username'), '-', true);
        $this->accountModel->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'point' => $this->request->getVar('point'),
            'status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('pesan', 'data berhasil diubah');
        return redirect()->to('/');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $account = $this->accountModel->getUser($id);
        
        // jika gambarnya adalah default maka tidak usah dihapus
        if($account['image'] != 'default.png'){
            unlink('image/'.$account['image']);
        }
        $this->accountModel->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus');

        return redirect()->to('/');
    }
}
