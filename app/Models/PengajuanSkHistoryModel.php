<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanSkHistoryModel extends Model
{
    protected $table            = 'pengajuan_sk_histories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'pengajuan_sk_id',
        'aksi',
        'status_lama',
        'status_baru',
        'catatan',
        'performed_by',
        'performed_by_role',
        'created_at',
    ];

    public function getByPengajuanId(int $pengajuanSkId)
    {
        return $this->where('pengajuan_sk_id', $pengajuanSkId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
