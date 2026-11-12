<?php

namespace App\Models;

use CodeIgniter\Model;

class KomisariatModel extends Model
{
    protected $table            = 'komisariat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'kode_komisariat', // Ditambahkan agar kolom kode_komisariat bisa diakses Model
        'nama_komisariat',
        'kampus_fakultas',
        'nama_ketua',
        'status_aktif',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil daftar komisariat yang aktif untuk pilihan dropdown pengajuan KTA
     */
    public function getActiveKomisariat()
    {
        return $this->where('status_aktif', 'aktif')
            ->orderBy('kode_komisariat', 'ASC')
            ->findAll();
    }
}
