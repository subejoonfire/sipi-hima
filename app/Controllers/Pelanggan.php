<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pelanggan_m;
use App\Models\Pengguna_m;

class Pelanggan extends BaseController
{
    protected $pelangganModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->pelangganModel = new Pelanggan_m();
        $this->penggunaModel = new Pengguna_m();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Pelanggan | Inventaris HIMA-TI',
            'pelanggan' => $this->pelangganModel->findAll(),
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];

        echo view('layout/header', $data);
        echo view('layout/topbar', $data);
        echo view('layout/sidebar_admin', $data);
        echo view('admin/kelolapelanggan', $data);
        echo view('layout/footer');
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $errors = [];

        // Validation
        if (empty($data['idpelanggan'])) {
            $errors['idpelanggan'] = 'ID pelanggan tidak boleh kosong';
        } elseif ($this->pelangganModel->where('idpelanggan', $data['idpelanggan'])->first()) {
            $errors['idpelanggan'] = 'ID pelanggan sudah terdaftar';
        } elseif (strlen($data['idpelanggan']) > 20) {
            $errors['idpelanggan'] = 'ID pelanggan tidak boleh lebih dari 20 karakter';
        }

        if (empty($data['nama_pelanggan'])) {
            $errors['nama_pelanggan'] = 'Nama pelanggan tidak boleh kosong';
        }

        if (empty($data['no_kontak'])) {
            $errors['no_kontak'] = 'Nomor kontak tidak boleh kosong';
        } elseif (!is_numeric($data['no_kontak'])) {
            $errors['no_kontak'] = 'Nomor kontak harus berupa angka';
        }

        if (!empty($errors)) {
            session()->setFlashdata('error', $errors);
            return redirect()->to('/pelanggan');
        }

        $tambah = $this->pelangganModel->insert([
            'idpelanggan' => $data['idpelanggan'],
            'nama_pelanggan' => $data['nama_pelanggan'],
            'no_kontak' => $data['no_kontak'],
            'delegasi' => $data['delegasi'] ?? null,
        ]);

        if ($tambah) {
            session()->setFlashdata('success', 'Pelanggan berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Pelanggan gagal ditambahkan');
        }

        return redirect()->to('/pelanggan');
    }

    public function edit($idpelanggan)
    {
        $data = $this->request->getPost();
        $errors = [];
        $pelangganlama = $this->pelangganModel->find($idpelanggan);

        // Validation
        if (empty($data['idpelanggan'])) {
            $errors['idpelanggan'] = 'ID pelanggan tidak boleh kosong';
        } elseif (strlen($data['idpelanggan']) > 20) {
            $errors['idpelanggan'] = 'ID pelanggan tidak boleh lebih dari 20 karakter';
        }

        if (empty($data['nama_pelanggan'])) {
            $errors['nama_pelanggan'] = 'Nama pelanggan tidak boleh kosong';
        }

        if (empty($data['no_kontak'])) {
            $errors['no_kontak'] = 'Nomor kontak tidak boleh kosong';
        } elseif (!is_numeric($data['no_kontak'])) {
            $errors['no_kontak'] = 'Nomor kontak harus berupa angka';
        }

        if (!empty($errors)) {
            $error = implode('<br>', array_map(function ($error) {
                return '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }, $errors));

            return redirect()->to('/pelanggan/' . $idpelanggan)->withInput()->with('error', $error);
        }

        $updatedData = [
            'idpelanggan' => $data['idpelanggan'] ?? $pelangganlama['idpelanggan'],
            'nama_pelanggan' => $data['nama_pelanggan'] ?? $pelangganlama['nama_pelanggan'],
            'no_kontak' => $data['no_kontak'] ?? $pelangganlama['no_kontak'],
            'delegasi' => $data['delegasi'] ?? $pelangganlama['delegasi'],
        ];

        $request = $this->pelangganModel->update($idpelanggan, $updatedData);

        if ($request) {
            session()->setFlashdata('success', 'Data berhasil diubah');
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
        }

        return redirect()->to('/pelanggan');
    }

    public function hapus($idpelanggan)
    {
        $hapus = $this->pelangganModel->delete($idpelanggan);

        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }

        return redirect()->to('/pelanggan');
    }
}
