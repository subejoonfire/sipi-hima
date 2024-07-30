<?php

namespace App\Models;

use CodeIgniter\Model;

class Peminjaman_m extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kdbarang', 'idpelanggan', 'tanggal_peminjaman', 'tanggal_pengembalian', 'status'];

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

    public function getPeminjaman()
    {
        $builder = $this->db->table('peminjaman');
        $builder->select('*');
        $builder->join('barang', 'barang.kdbarang = peminjaman.kdbarang');
        $builder->join('pelanggan', 'pelanggan.idpelanggan = peminjaman.idpelanggan');
        return $builder->get()->getResultArray();
    }

    public function getJumlahPeminjaman($status = 'sedang dipinjam')
    {
        $builder = $this->db->table('peminjaman');
        $builder->where('status', $status);
        $query = $builder->get();

        return $query->getNumRows();
    }
}
