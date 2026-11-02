<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanSkModel extends Model
{
    protected $table            = 'pengajuan_sk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'kode_pengajuan',
        'nama_pemohon',
        'whatsapp',
        'komisariat_id',
        'status',
        'catatan_admin',
        'surat_pengajuan_sk',
        'berita_acara_rtk',
        'berita_acara_formatur',
        'struktur_kepengurusan',
        'laporan_pertanggungjawaban_demisioner',
        'dokumentasi_rtk',
        'sertifikat_pkd_ketua_bph',
        'cv_pengurus_ktm_ktp_transkrip',
        'cv_bph_komisariat',
        'database_anggota',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findByKode(string $kode)
    {
        return $this->where('kode_pengajuan', $kode)->first();
    }

    public function hasActiveSubmissionByKomisariat(int $komisariatId)
    {
        return $this->where('komisariat_id', $komisariatId)
            ->whereIn('status', ['menunggu', 'diterima', 'revisi'])
            ->first();
    }

    public function getAllWithKomisariat(?string $status = null, ?string $keyword = null)
    {
        $builder = $this->select('pengajuan_sk.*, komisariat.nama_komisariat, komisariat.kampus_fakultas, komisariat.nama_ketua')
            ->join('komisariat', 'komisariat.id = pengajuan_sk.komisariat_id', 'left');

        if (! empty($status) && $status !== 'semua') {
            $builder->where('pengajuan_sk.status', $status);
        }

        if (! empty($keyword)) {
            $builder->groupStart()
                ->like('pengajuan_sk.kode_pengajuan', $keyword)
                ->orLike('pengajuan_sk.nama_pemohon', $keyword)
                ->orLike('komisariat.nama_komisariat', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('pengajuan_sk.id', 'DESC')->findAll();
    }

    public function getDetailWithKomisariat(int $id)
    {
        return $this->select('pengajuan_sk.*, komisariat.nama_komisariat, komisariat.kampus_fakultas, komisariat.nama_ketua')
            ->join('komisariat', 'komisariat.id = pengajuan_sk.komisariat_id', 'left')
            ->where('pengajuan_sk.id', $id)
            ->first();
    }
}
