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

    public function getActiveKomisariat()
    {
        return $this->where('status_aktif', 'aktif')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
