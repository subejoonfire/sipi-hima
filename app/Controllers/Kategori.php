<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Kategori_m;
use App\Models\Pengguna_m;

class Kategori extends BaseController
{
    protected $kategorimodel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new Pengguna_m();
        $this->kategorimodel = new Kategori_m();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Kategori | Inventaris HIMA-TI',
            'kategori' => $this->kategorimodel->getKategori(),
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];

        echo view('layout/header', $data);
        echo view('layout/topbar', $data);
        echo view('layout/sidebar_admin', $data);
        echo view('admin/kategoribarang', $data);
        echo view('layout/footer');
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $rules = [
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori,id_kategori,{id_kategori}]',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah terdaftar',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            if (isset($errors['nama_kategori'])) {
                session()->setFlashdata('error', $errors['nama_kategori']);
            }
        } else {
            // Cek apakah nama kategori sudah ada di database
            $existingCategory = $this->kategorimodel->where('nama_kategori', $data['nama_kategori'])->first();

            if ($existingCategory) {
                // Jika nama kategori sudah ada, tampilkan pesan error
                session()->setFlashdata('error', 'Kategori dengan nama yang sama sudah ada');
            } else {
                // Jika nama kategori belum ada, lakukan insert
                $tambah = $this->kategorimodel->insert([
                    'nama_kategori' => $data['nama_kategori'],
                    'deskripsi' => $data['deskripsi']
                ]);

                if ($tambah) {
                    session()->setFlashdata('success', 'Kategori berhasil ditambahkan');
                } else {
                    session()->setFlashdata('error', 'Kategori gagal ditambahkan');
                }
            }
        }

        return redirect()->to('/kategori');
    }

    public function edit($idkategori)
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $kategoriLama = $this->kategorimodel->find($idkategori);

        $rules = [
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori,idkategori,' . $idkategori . ']',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong',
                    'is_unique' => 'Nama kategori sudah terdaftar',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            if (isset($errors['nama_kategori'])) {
                session()->setFlashdata('error', $errors['nama_kategori']);
                return redirect()->to('/kategori');
            }
        } else {
            $ubah = $this->kategorimodel->update($idkategori, [
                'nama_kategori' => $data['nama_kategori'] ?? $kategoriLama['nama_kategori'],
                'deskripsi' => $data['deskripsi']
            ]);

            if ($ubah) {
                session()->setFlashdata('success', 'Kategori berhasil diubah');
            } else {
                session()->setFlashdata('error', 'Kategori gagal diubah');
            }
            return redirect()->to('/kategori');
        }

        return redirect()->to('/kategori');
    }

    public function hapus($idkategori)
    {
        $kategori = $this->kategorimodel->find($idkategori);

        if ($kategori) {
            $hapus = $this->kategorimodel->delete($idkategori);
            if ($hapus) {
                session()->setFlashdata('success', 'Kategori berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Kategori gagal dihapus');
            }
        } else {
            session()->setFlashdata('error', 'Kategori tidak ditemukan');
        }

        return redirect()->to('/kategori');
    }
}
