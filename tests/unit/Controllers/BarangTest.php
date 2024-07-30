<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use App\Models\Kategori_m;
use App\Models\Barang_m;

class BarangTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected $kategoriModel;
    protected $barangModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->kategoriModel = new Kategori_m();
        $this->barangModel = new Barang_m();
    }

    public function testTambahBarangValidInput()
    {
        $data = [
            'nama_barang' => 'Laptop',
            'idkategori' => 1,
            'kondisi_barang' => 'Baik',
            'foto_barang' => $this->getMockFile('foto.jpg')
        ];

        $this->request->setMethod('post')
            ->setBody($data);

        $result = $this->controller(\App\Controllers\Barang::class, 'tambah');
        $this->assertTrue($result->isRedirect());
        $this->assertStringContainsString('Data berhasil ditambahkan', $result->getBody());
    }

    public function testTambahBarangNamaBarangKosong()
    {
        $data = [
            'nama_barang' => '',
            'idkategori' => 1,
            'kondisi_barang' => 'Baik',
            'foto_barang' => $this->getMockFile('foto.jpg')
        ];

        $this->request->setMethod('post')
            ->setBody($data);

        $result = $this->controller(\App\Controllers\Barang::class, 'tambah');
        $this->assertTrue($result->isRedirect());
        $this->assertStringContainsString('Nama barang tidak boleh kosong', $result->getBody());
    }

    public function testTambahBarangFotoTidakValid()
    {
        $data = [
            'nama_barang' => 'Laptop',
            'idkategori' => 1,
            'kondisi_barang' => 'Baik',
            'foto_barang' => $this->getMockFile('file.txt')
        ];

        $this->request->setMethod('post')
            ->setBody($data);

        $result = $this->controller(\App\Controllers\Barang::class, 'tambah');
        $this->assertTrue($result->isRedirect());
        $this->assertStringContainsString('Yang anda pilih bukan foto', $result->getBody());
    }

    public function testTambahBarangKodeBarangUnik()
    {
        $kategori = $this->kategoriModel->find(1);
        $singkatanKategori = strtoupper(substr($kategori['nama_kategori'], 0, 2));
        $namaBarang = 'Laptop Baru';
        $words = explode(' ', $namaBarang);
        $singkatanBarang = '';
        foreach ($words as $word) {
            $singkatanBarang .= strtoupper(substr($word, 0, 3));
        }

        $lastKodeBarang = $this->barangModel->getLastKodeBarangBySingkatanBarang($singkatanBarang);
        if ($lastKodeBarang) {
            $lastNumber = (int) substr($lastKodeBarang, strlen($singkatanBarang) + 1);
            $kdbarang = $singkatanKategori . '_' . $singkatanBarang . '_' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kdbarang = $singkatanKategori . '_' . $singkatanBarang . '_001';
        }

        $this->barangModel->insert([
            'kdbarang' => $kdbarang,
            'nama_barang' => $namaBarang,
            'idkategori' => 1,
            'kondisi_barang' => 'Baik',
            'foto_barang' => 'default.jpg'
        ]);

        $data = [
            'nama_barang' => $namaBarang,
            'idkategori' => 1,
            'kondisi_barang' => 'Baik',
            'foto_barang' => $this->getMockFile('foto.jpg')
        ];

        $this->request->setMethod('post')
            ->setBody($data);

        $result = $this->controller(\App\Controllers\Barang::class, 'tambah');
        $this->assertTrue($result->isRedirect());
        $this->assertStringContainsString('Kode barang sudah ada, silakan coba lagi.', $result->getBody());
    }
}
