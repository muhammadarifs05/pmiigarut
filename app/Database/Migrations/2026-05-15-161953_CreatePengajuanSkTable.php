<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanSkTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_pengajuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_pemohon' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'komisariat_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu', 'diterima', 'ditolak', 'revisi'],
                'default'    => 'menunggu',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'surat_pengajuan_sk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'berita_acara_rtk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'berita_acara_formatur' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'struktur_kepengurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'laporan_pertanggungjawaban_demisioner' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'dokumentasi_rtk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'sertifikat_pkd_ketua_bph' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'cv_pengurus_ktm_ktp_transkrip' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'cv_bph_komisariat' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'database_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kode_pengajuan');
        $this->forge->addKey('komisariat_id');

        $this->forge->addForeignKey('komisariat_id', 'komisariat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengajuan_sk');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_sk');
    }
}
