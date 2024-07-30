<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Pdfgenerator;
use App\Models\Barang_m;
use App\Models\Kategori_m;
use App\Models\Pengguna_m;

class Barang extends BaseController
{
    protected $kategoriModel;
    protected $barangModel;
    protected $penggunaModel;
    protected $validation;

    public function __construct()
    {
        $this->kategoriModel = new Kategori_m();
        $this->barangModel = new Barang_m();
        $this->penggunaModel = new Pengguna_m();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Barang | Inventaris HIMA-TI',
            'barang' => $this->barangModel->getBarang(),
            'kategori' => $this->kategoriModel->getKategori(),
            'level_user' => $level_user,
            'nama_user' => $nama_user,
            'kondisi_barang' => [
                'Baik',
                'Rusak Ringan',
                'Rusak Berat'
            ]
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin', $data);
        echo view('admin/kelolabarang');
        echo view('layout/footer');
    }


    public function tambah()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $rules = [
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang tidak boleh kosong'
                ]
            ],
            'foto_barang' => [
                'rules' => 'max_size[foto_barang,1024]|is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'is_image' => 'Yang anda pilih bukan foto',
                    'mime_in' => 'Yang anda pilih bukan foto',
                    'uploaded' => 'Yang anda pilih bukan foto',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            $error = implode('<br>', array_map(function ($error) {
                return '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }, $errors));

            session()->setFlashdata('errors', $error);
            return redirect()->to('/barang')->withInput();
        }

        $namaBarang = $data['nama_barang'];
        $kategori = $this->kategoriModel->find($data['idkategori']);
        $singkatanKategori = strtoupper(substr($kategori['nama_kategori'], 0, 2));

        $words = explode(' ', $namaBarang);
        $singkatanBarang = '';
        foreach ($words as $word) {
            $singkatanBarang .= strtoupper(substr($word, 0, 3));
        }

        $tahunMasuk = date('Y', strtotime($data['tgl_masuk']));
        $noIndex = $data['no_index'];

        $kdbarang = $singkatanKategori . '_' . $singkatanBarang . '_' . $tahunMasuk . '_' . str_pad($noIndex, 3, '0', STR_PAD_LEFT);

        // Periksa keunikan kode barang
        if (!$this->barangModel->isKodeBarangUnique($kdbarang)) {
            session()->setFlashdata('error', 'Kode barang sudah ada, silakan coba lagi.');
            return redirect()->to('/barang');
        }

        $filegambar = $this->request->getFile('foto_barang');

        if ($filegambar->getError() == 4) {
            $namafoto = 'default.jpg';
        } else {
            $namafoto = $filegambar->getRandomName();
            $filegambar->move('img', $namafoto);
        }

        $request = $this->barangModel->insert([
            'kdbarang' => $kdbarang,
            'nama_barang' => $data['nama_barang'],
            'tgl_masuk' => $data['tgl_masuk'],
            'idkategori' => $data['idkategori'],
            'kondisi_barang' => $data['kondisi_barang'],
            'foto_barang' => $namafoto,
        ]);

        if ($request) {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to('/barang');
        } else {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to('/barang');
        }
    }


    public function edit($kdbarang)
    {
        $data = $this->request->getPost();
        $barangModel = new Barang_m();
        $kategoriModel = new Kategori_m();
        $validation = \Config\Services::validation();
        $barangLama = $barangModel->find($kdbarang);

        $rules = [
            'kdbarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode barang tidak boleh kosong',
                ],
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang tidak boleh kosong'
                ]
            ],
            'foto_barang' => $this->request->getFile('foto_barang') ? [
                'rules' => 'max_size[foto_barang,1024]|is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'is_image' => 'Yang anda pilih bukan foto',
                    'mime_in' => 'Yang anda pilih bukan foto',
                    'uploaded' => 'Yang anda pilih bukan foto',
                ]
            ] : [],
        ];

        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            $error = implode('<br>', array_map(function ($error) {
                return '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }, $errors));
            session()->setFlashdata('error', $error);
            return redirect()->to('/barang');
        } else {
            $barangLama = $barangModel->find($kdbarang);

            $fileGambar = $this->request->getFile('foto_barang');
            $namaFoto = null;

            if ($fileGambar && $fileGambar->isValid()) {
                $namaFoto = $fileGambar->getRandomName();
            }

            if ($namaFoto) {
                if ($barangLama['foto_barang'] != 'default.jpg') {
                    unlink('img/' . $barangLama['foto_barang']);
                }

                if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                    $fileGambar->move('img', $namaFoto);
                }

                $data['foto_barang'] = $namaFoto;
            } else {
                $data['foto_barang'] = $barangLama['foto_barang'];
            }

            // Cek apakah kdbarang diubah atau tidak
            if ($data['kdbarang'] != $barangLama['kdbarang']) {
                // Jika kdbarang diubah, tampilkan pesan error
                session()->setFlashdata('error', 'Kode barang tidak dapat diubah');
                return redirect()->to('/barang');
            }

            $data['nama_barang'] = $this->request->getPost('nama_barang');
            // ... data lainnya
            $ubah = $barangModel->editBarang($kdbarang, $data);
            if ($ubah === false) {
                session()->setFlashdata('error', 'Data gagal diubah');
                return redirect()->to('/barang');
            } else {
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to('/barang');
            }
        }
    }


    public function hapus($kdbarang)
    {
        $barang = $this->barangModel->find($kdbarang);

        if ($barang['foto_barang'] != 'default.jpg') {
            unlink('img/' . $barang['foto_barang']);
        }
        $hapus = $this->barangModel->delete($kdbarang);
        if (!$hapus) {
            session()->setFlashdata('error', 'Data gagal dihapus');
            return redirect()->to('/barang');
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/barang');
        }
    }


    public function generatepdf()
    {

        $kategori = $this->request->getGet('kategori');
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $cetak_semua = $this->request->getGet('cetak_semua');

        $Pdfgenerator = new Pdfgenerator();
        $data = [
            'title' => 'Laporan Barang',
            'barang' => $this->barangModel->getBarangByFilter($kategori, $start_date, $end_date, $cetak_semua),
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_Barang_HIMA';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('admin/laporanbarang', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
