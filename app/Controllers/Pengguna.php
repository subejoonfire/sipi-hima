<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Pengguna_m;

class Pengguna extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new Pengguna_m();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Pengguna | Inventaris HIMA-TI',
            'Pengguna' => $this->penggunaModel->getPengguna(),
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];

        echo view('layout/header', $data);
        echo view('layout/topbar', $data);
        echo view('layout/sidebar_admin', $data);
        echo view('admin/kelolapengguna', $data);
        echo view('layout/footer');
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[pengguna.nama,iduser,{iduser}]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'is_unique' => 'Nama sudah terdaftar'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[pengguna.username,iduser,{iduser}]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            if (isset($errors['username'])) {
                session()->setFlashdata('error', $errors['username']);
            } elseif (isset($errors['nama'])) {
                session()->setFlashdata('error', $errors['nama']);
            } else {
                session()->setFlashdata('error', $validation->getErrors());
            }
        } else {
            $tambah = $this->penggunaModel->insert([
                'username' => $data['username'],
                'password' => $data['password'],
                'nama' => $data['nama'],
                'level' => $data['level']
            ]);

            if ($tambah) {
                session()->setFlashdata('success', 'Pengguna berhasil ditambahkan');
            } else {
                session()->setFlashdata('error', 'Pengguna gagal ditambahkan');
            }
        }

        return redirect()->to('/pengguna');
    }

    public function edit($iduser)
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $penggunalama = $this->penggunaModel->find($iduser);

        $rules = [
            'nama' => [
                'rules' => $data['nama'] != $penggunalama['nama'] ? 'required|is_unique[pengguna.nama,iduser,{iduser}]' : [],
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'is_unique' => 'Nama sudah terdaftar'
                ]
            ],
            'username' => [
                'rules' => $data['username'] != $penggunalama['username'] ? 'required|is_unique[pengguna.username,iduser,{iduser}]' : [],
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => $data['password'] != $penggunalama['password'] ? 'required' : [],
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            if (isset($errors['username'])) {
                session()->setFlashdata('error', $errors['username']);
            } elseif (isset($errors['nama'])) {
                session()->setFlashdata('error', $errors['nama']);
            } else {
                session()->setFlashdata('error', $validation->getErrors());
            }
        } else {
            $ubah = $this->penggunaModel->update($iduser, [
                'username' => $data['username'] ?? $penggunalama['username'],
                'password' => $data['password'],
                'nama' => $data['nama'],
                'level' => $data['level']
            ]);

            if ($ubah) {
                session()->setFlashdata('success', 'Pengguna berhasil diubah');
            } else {
                session()->setFlashdata('error', 'Pengguna gagal diubah');
            }
            return redirect()->to('/pengguna');
        }

        return redirect()->to('/pengguna');
    }


    public function hapus($iduser)
    {
        $Pengguna = $this->penggunaModel->find($iduser);

        if ($Pengguna) {
            $hapus = $this->penggunaModel->delete($iduser);
            if ($hapus) {
                session()->setFlashdata('success', 'Pengguna berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Pengguna gagal dihapus');
            }
        } else {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan');
        }

        return redirect()->to('/pengguna');
    }
}
