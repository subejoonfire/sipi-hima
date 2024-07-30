<?php

namespace App\Models;

use CodeIgniter\Model;

class Penitipan_m extends Model
{
    protected $table            = 'penitipan';
    protected $primaryKey       = 'id_penitipan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penitipan', 'idpelanggan', 'nama_pelanggan', 'nama_barang', 'jumlah_barang', 'deskripsi', 'tgl_titip', 'tgl_kembali', 'foto_titip', 'status'];

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

    public function getTitipBarangAdmin()
    {
        $builder = $this->db->table('penitipan');
        $builder->select('penitipan.*, pelanggan.nama_pelanggan, pelanggan.no_kontak, pelanggan.delegasi');
        $builder->join('pelanggan', 'pelanggan.idpelanggan = penitipan.idpelanggan');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getPenitipanByFilter($pelanggan = null, $start_date = null, $end_date = null, $cetak_semua = false)
    {
        $builder = $this->db->table('penitipan');
        $builder->select('penitipan.*, pelanggan.nama_pelanggan');
        $builder->join('pelanggan', 'pelanggan.idpelanggan = penitipan.idpelanggan');

        if (!$cetak_semua) {
            if ($pelanggan) {
                $builder->where('penitipan.idpelanggan', $pelanggan);
            } else {
                // Jika kategori tidak dipilih, tampilkan semua kategori
                $builder->groupStart();
                $builder->orWhere('penitipan.idpelanggan IS NOT NULL');
                $builder->groupEnd();
            }
            if ($start_date && $end_date) {
                $builder->where('penitipan.tgl_titip >=', $start_date);
                $builder->where('penitipan.tgl_kembali <=', $end_date);
            } elseif ($start_date) {
                $builder->where('penitipan.tgl_titip >=', $start_date);
            } elseif ($end_date) {
                $builder->where('penitipan.tgl_kembali <=', $end_date);
            }

            return $builder->get()->getResultArray();
        }
    }

    public function getJumlahPenitipan($status = 'proses')
    {
        $builder = $this->db->table('penitipan');
        $builder->where('status', $status);
        $query = $builder->get();

        return $query->getNumRows();
    }
}
