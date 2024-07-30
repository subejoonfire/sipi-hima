<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Peminjaman_m;
use App\Models\Barang_m;
use App\Models\Pengguna_m;
use App\Models\Pelanggan_m;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $barangModel;
    protected $penggunaModel;
    protected $pelangganModel;
    protected $validation;

    public function __construct()
    {
        $this->peminjamanModel = new \App\Models\Peminjaman_m();
        $this->barangModel = new \App\Models\Barang_m();
        $this->pelangganModel = new \App\Models\Pelanggan_m();
        $this->penggunaModel = new Pengguna_m();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $iduser = session('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];

        $data = [
            'title' => 'Peminjaman | Inventaris HIMA-TI',
            'data' => $this->peminjamanModel->join('barang', 'barang.kdbarang = peminjaman.kdbarang')->join('pelanggan', 'pelanggan.idpelanggan = peminjaman.idpelanggan')->findAll(),
            'barang' => $this->barangModel->findAll(),
            'peminjaman' => $this->peminjamanModel->findAll(),
            'pelanggan' => $this->pelangganModel->findAll(),
            'level_user' => $level_user,
            'nama_user' => $nama_user,
            'status' => [
                'Sedang dipinjam',
                'Selesai'
            ]
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/pinjambarang');
        echo view('layout/footer');
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $rules = [
            'kdbarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode barang tidak boleh kosong'
                ]
            ],
            'idpelanggan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID pelanggan tidak boleh kosong'
                ]
            ],
            'tanggal_peminjaman' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal peminjaman tidak boleh kosong',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'tanggal_pengembalian' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal pengembalian tidak boleh kosong',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status tidak boleh kosong'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            $error = implode('<br>', array_map(function ($error) {
                return '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }, $errors));

            session()->setFlashdata('errors', $error);
            return redirect()->to('/peminjaman')->withInput();
        }

        $data = [
            'kdbarang' => $this->request->getPost('kdbarang'),
            'idpelanggan' => $this->request->getPost('idpelanggan'),
            'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
            'tanggal_pengembalian' => $this->request->getPost('tanggal_pengembalian'),
            'status' => $this->request->getPost('status'),
        ];

        $result = $this->peminjamanModel->insert($data);

        if ($result) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to('/peminjaman');
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to('/peminjaman');
        }
    }

    public function edit($id_peminjaman)
{
    // Get the POST data from the form
    $data = $this->request->getPost();

    // Update the record in the database
    $request = $this->peminjamanModel->update($id_peminjaman, [
        'kdbarang' => $data['editSelectBarang'], // The selected barang
        'idpelanggan' => $data['editSelectPeminjam'], // The selected pelanggan
        'tanggal_peminjaman' => $data['editWaktuPinjam'], // The borrowing date
        'tanggal_pengembalian' => $data['editWaktuKembali'], // The return date
        'status' => $data['status'], // Status of the borrowing
    ]);

    // Check if the update was successful
    if ($request) {
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/peminjaman');
    } else {
        session()->setFlashdata('error', 'Data gagal diubah');
        return redirect()->to('/peminjaman');
    }
}


    public function hapus($id_peminjaman)
    {
        $hapus = $this->peminjamanModel->delete($id_peminjaman);
        if ($hapus) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/peminjaman');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
            return redirect()->to('/peminjaman');
        }
    }
}
