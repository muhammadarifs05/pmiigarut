<?php

namespace App\Models;

use CodeIgniter\Model;

class KtaRequestModel extends Model
{
    protected $table            = 'kta_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'uuid_token',
        'nomor_kta',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'komisariat_id',
        'rayon',
        'tahun_mapaba',
        'pas_foto',
        'berkas_bukti',
        'status',
        'catatan_admin',
        'approved_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getFilteredWithKomisariat(?string $status = null, ?string $keyword = null): array
    {
        $builder = $this->select('kta_requests.*, komisariat.nama_komisariat, komisariat.kode_komisariat')
            ->join('komisariat', 'komisariat.id = kta_requests.komisariat_id', 'left');

        if (! empty($status) && $status !== 'semua') {
            $builder->where('kta_requests.status', $status);
        }

        if (! empty($keyword)) {
            $builder->groupStart()
                ->like('kta_requests.nama_lengkap', $keyword)
                ->orLike('kta_requests.nik', $keyword)
                ->orLike('kta_requests.nomor_kta', $keyword)
                ->orLike('komisariat.nama_komisariat', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('kta_requests.id', 'DESC')->findAll();
    }

    /**
     * Mengambil data pengajuan KTA lengkap dengan nama komisariatnya
     */
    public function getRequestsWithKomisariat(?int $id = null)
    {
        $builder = $this->db->table($this->table)
            ->select('kta_requests.*, komisariat.nama_komisariat, komisariat.kode_komisariat')
            ->join('komisariat', 'komisariat.id = kta_requests.komisariat_id');

        if ($id !== null) {
            return $builder->where('kta_requests.id', $id)->get()->getRowArray();
        }

        return $builder->orderBy('kta_requests.id', 'DESC')->get()->getResultArray();
    }

    /**
     * Mengambil data KTA berdasarkan UUID Token (Untuk QR Code Verification)
     */
    public function getByUuid(string $uuidToken)
    {
        return $this->db->table($this->table)
            ->select('kta_requests.*, komisariat.nama_komisariat')
            ->join('komisariat', 'komisariat.id = kta_requests.komisariat_id')
            ->where('kta_requests.uuid_token', $uuidToken)
            ->where('kta_requests.status', 'approved')
            ->get()
            ->getRowArray();
    }
}
