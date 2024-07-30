<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang_m extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'kdbarang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kdbarang', 'idkategori', 'nama_barang', 'tgl_masuk', 'kondisi_barang', 'foto_barang'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getBarang()
    {
        $builder = $this->db->table('barang');
        $builder->select('barang.*, kategori.nama_kategori');
        $builder->join('kategori', 'kategori.idkategori = barang.idkategori');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getLastKodeBarangByKategoriBarang($singkatanKategori, $singkatanBarang)
    {
        $query = $this->db->query("SELECT kdbarang FROM barang WHERE kdbarang LIKE '$singkatanKategori$singkatanBarang%' ORDER BY kdbarang DESC LIMIT 1");
        return $query->getRow() ? $query->getRow()->kdbarang : false;
    }

    public function isKodeBarangUnique($kdbarang)
    {
        $query = $this->db->table('barang')
            ->where('kdbarang', $kdbarang)
            ->get();

        return $query->getNumRows() === 0;
    }

    public function getLastKodeBarangBySingkatanBarang($singkatanBarang)
    {
        $query = $this->db->query("SELECT kdbarang FROM barang WHERE kdbarang LIKE '%$singkatanBarang%' ORDER BY kdbarang DESC LIMIT 1");
        return $query->getRow() ? $query->getRow()->kdbarang : null;
    }

    public function editBarang($kdbarang, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('kdbarang', $kdbarang);
        return $builder->update($data);
    }

    public function getBarangByFilter($kategori = null, $start_date = null, $end_date = null, $cetak_semua = false)
    {
        $builder = $this->db->table('barang');
        $builder->select('barang.*, kategori.nama_kategori');
        $builder->join('kategori', 'barang.idkategori = kategori.idkategori');

        if (!$cetak_semua) {
            if ($kategori) {
                $builder->where('barang.idkategori', $kategori);
            } else {
                // Jika kategori tidak dipilih, tampilkan semua kategori
                $builder->groupStart();
                $builder->orWhere('barang.idkategori IS NOT NULL');
                $builder->groupEnd();
            }
            if ($start_date && $end_date) {
                $builder->where('barang.tgl_masuk >=', $start_date);
                $builder->where('barang.tgl_masuk <=', $end_date);
            } elseif ($start_date) {
                $builder->where('barang.tgl_masuk >=', $start_date);
            } elseif ($end_date) {
                $builder->where('barang.tgl_masuk <=', $end_date);
            }

            return $builder->get()->getResultArray();
        }
    }

    public function getBarangByKondisi($kondisi)
    {
        return $this->where(['kondisi_barang' => $kondisi])->findAll();
    }

    public function getJumlahBarang()
    {
        return $this->countAll();
    }

    public function getJumlahBarangByNamaBarang($namaBarang)
    {
        $namaBarang = strtolower($namaBarang);
        $namaBarang = str_replace(' ', '_', $namaBarang);

        $builder = $this->db->table('barang');
        $builder->like('LOWER(nama_barang)', $namaBarang);
        $query = $builder->get();

        $jumlahBarang = $query->getNumRows();

        // Menambahkan nomor urut berdasarkan jumlah nama barang yang muncul
        $builder = $this->db->table('barang');
        $builder->groupBy('nama_barang');
        $builder->having('LOWER(nama_barang)', $namaBarang);
        $query = $builder->get();

        $jumlahNamaBarang = $query->getNumRows();

        if ($jumlahNamaBarang > 0) {
            $jumlahBarang = $jumlahNamaBarang + 1;
        } else {
            $jumlahBarang = 1;
        }

        return $jumlahBarang;
    }
}
