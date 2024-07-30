<?php

namespace App\Controllers;

use App\Models\Barang_m;
use App\Models\Pengguna_m;

class Home extends BaseController
{
    protected $barangModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->barangModel = new Barang_m();
        $this->penggunaModel = new Pengguna_m();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $databarang = $this->barangModel->getBarang();
        $jumlahbarang = $this->barangModel->countAll();
        $jumlahpengguna = $this->penggunaModel->countAll();
        $data = [
            'title' => 'Dashboard | Inventaris HIMA-TI',
            'barang' => $databarang,
            'jumlahbarang' => $jumlahbarang,
            'jumlahpengguna' => $jumlahpengguna,
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar', $data);
        echo view('layout/sidebar_admin', $data);
        echo view('admin/dashboard', $data);
        echo view('layout/footer');
    }

    public function pelanggan()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Pelanggan | Inventaris HIMA-TI',
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/pelanggan');
        echo view('layout/footer');
    }

    public function pinjambarang()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Pinjam Barang | Inventaris HIMA-TI',
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/pinjambarang');
        echo view('layout/footer');
    }

    public function titipbarang()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Titip Barang | Inventaris HIMA-TI',
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/titipbarang');
        echo view('layout/footer');
    }

    public function user()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'User | Inventaris HIMA-TI',
            'level_user' => $level_user,
            'nama_user' => $nama_user
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/user');
        echo view('layout/footer');
    }
}
