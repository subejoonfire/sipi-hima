<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Pdfgenerator;
use App\Models\penitipan_m;
use App\Models\pelanggan_m;
use App\Models\Pengguna_m;

class Penitipan extends BaseController
{
    protected $penitipanModel;
    protected $pelangganModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->penitipanModel = new penitipan_m();
        $this->penggunaModel = new Pengguna_m();
        $this->pelangganModel = new Pelanggan_m();
    }

    public function index()
    {
        $iduser = session()->get('iduser');
        $user = $this->penggunaModel->find($iduser);
        $level_user = $user['level'];
        $nama_user = $user['nama'];
        $data = [
            'title' => 'Titip Barang | Inventaris HIMA-TI',
            'level_user' => $level_user,
            'nama_user' => $nama_user,
        ];
        $data2 = [
            'data' => $this->penitipanModel->join('pelanggan', 'pelanggan.idpelanggan = penitipan.idpelanggan')->findAll(),
            'penitip' => $this->pelangganModel->findAll(),
        ];
        echo view('layout/header', $data);
        echo view('layout/topbar');
        echo view('layout/sidebar_admin');
        echo view('admin/titipbarang', $data2);
        echo view('layout/footer');
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $filegambar = $this->request->getFile('fotoBarang');

        if ($filegambar->getError() == 4) {
            $namafoto = 'default.jpg';
        } else {
            $namafoto = $filegambar->getRandomName();
            $filegambar->move('img', $namafoto);
        }

        $data = [
            'idpelanggan' => $this->request->getPost('namaPenitip'),
            'nama_barang' => $this->request->getPost('namaBarang'),
            'jumlah_barang' => $this->request->getPost('satuanBarang'),
            'deskripsi' => $this->request->getPost('deskripsiBarang'),
            'tgl_titip' => $this->request->getPost('waktuTitip'),
            'tgl_kembali' => $this->request->getPost('waktuKembali'),
            'foto_titip' => $namafoto,
            'status' => 'proses',
        ];

        if (!$this->penitipanModel->insert($data)) {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
        } else {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        }

        return redirect()->to('/penitipan');
    }

    public function edit($id_penitipan)
{
    // Retrieve individual form fields
    $idPelanggan = $this->request->getPost('editNamaPenitip'); // This should correspond to idpelanggan
    $namaBarang = $this->request->getPost('editNamaBarang');
    $jumlahBarang = $this->request->getPost('editSatuanBarang');
    $deskripsi = $this->request->getPost('editDeskripsiBarang');
    $noKontak = $this->request->getPost('editNoHp');
    $tglTitip = $this->request->getPost('editWaktuTitip');
    $tglKembali = $this->request->getPost('editWaktuKembali');
    $fileGambar = $this->request->getFile('editFotoBarang');
    $existingFoto = $this->request->getPost('existingFotoBarang');

    // Fetch the existing record from the model
    $penitipanLama = $this->penitipanModel->find($id_penitipan);

    // Initialize the photo name variable
    $namaFoto = $existingFoto;

    if ($fileGambar && $fileGambar->isValid()) {
        $namaFoto = $fileGambar->getRandomName(); // Generate a random name for the new image

        // Delete the old image if it exists and is not the default image
        if ($penitipanLama['foto_titip'] != 'default.jpg') {
            @unlink('img/' . $penitipanLama['foto_titip']);
        }

        // Move the new image to the destination directory
        if (!$fileGambar->hasMoved()) {
            $fileGambar->move('img', $namaFoto);
        }
    }

    // Prepare the updated data
    $data = [
        'idpelanggan' => $idPelanggan,
        'nama_barang' => $namaBarang,
        'jumlah_barang' => $jumlahBarang,
        'deskripsi' => $deskripsi,
        'tgl_titip' => $tglTitip,
        'tgl_kembali' => $tglKembali,
        'idpelanggan' => $idPelanggan,
        'foto_titip' => $namaFoto,
        'status' => $penitipanLama['status'] // Assuming status remains unchanged
    ];

    // Update the record in the database
    $ubah = $this->penitipanModel->update($id_penitipan, $data);

    // Set flash data for success or error messages
    if ($ubah === false) {
        session()->setFlashdata('error', 'Data gagal diubah');
    } else {
        session()->setFlashdata('success', 'Data berhasil diubah');
    }

    // Redirect to the penitipan list
    return redirect()->to('/penitipan');
}

    public function hapus($id_penitipan)
    {
        $penitipan = $this->penitipanModel->find($id_penitipan);

        if ($penitipan['foto_titip'] != 'default.jpg') {
            unlink('img/' . $penitipan['foto_titip']);
        }
        $hapus = $this->penitipanModel->delete($id_penitipan);
        if (!$hapus) {
            session()->setFlashdata('error', 'Data gagal dihapus');
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        }

        return redirect()->to('/penitipan');
    }

    public function generatepdf()
    {
        $pelanggan = $this->request->getGet('pelanggan');
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $cetak_semua = $this->request->getGet('cetak_semua');

        $logo_path = FCPATH . '/assets/img/hmti.png';
        $logo_base64 = $this->encodeImageToBase64($logo_path);

        $Pdfgenerator = new Pdfgenerator();
        $data = [
            'title' => 'Laporan Penitipan',
            'titipbarang' => $this->penitipanModel->getPenitipanByFilter($pelanggan, $start_date, $end_date, $cetak_semua),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'logo_base64' => $logo_base64,
        ];

        $file_pdf = 'laporan_Penitipan_HIMA';
        $paper = 'A4';
        $orientation = "portrait";

        $html = view('admin/laporanpenitipan', $data);

        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    private function encodeImageToBase64($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function cetaknota($id_penitipan)
    {
        $Pdfgenerator = new Pdfgenerator();
        $penitipan = $this->penitipanModel->find($id_penitipan);
        $data = [
            'title' => 'Nota Penitipan',
            'pelanggan' => $this->pelangganModel->find($penitipan['idpelanggan']),
            'penitipan' => $penitipan,
        ];

        $file_pdf = 'nota_penitipan_' . $penitipan['tgl_titip'];
        $paper = 'A6';
        $orientation = "portrait";
        $html = view('admin/notapenitipan', $data);
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
