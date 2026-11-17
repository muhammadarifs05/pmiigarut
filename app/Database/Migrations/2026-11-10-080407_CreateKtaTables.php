<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKtaTables extends Migration
{
    public function up()
    {
        // 1. Tabel Master Komisariat
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_komisariat' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_komisariat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('komisariat', true);

        // 2. Tabel Pengajuan & Data KTA Kader
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uuid_token' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'unique'     => true,
            ],
            'nomor_kta' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'       => true,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'komisariat_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'rayon' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'tahun_mapaba' => [
                'type'       => 'YEAR',
            ],
            'pas_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'berkas_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_at' => [
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
        $this->forge->addForeignKey('komisariat_id', 'komisariat', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('kta_requests', true);
    }

    public function down()
    {
        $this->forge->dropTable('kta_requests', true);
        $this->forge->dropTable('komisariat', true);
    }
}
