<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKomisariatTable extends Migration
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
            'nama_komisariat' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'kampus_fakultas' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'nama_ketua' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'status_aktif' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'tidak_aktif'],
                'default'    => 'aktif',
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
        $this->forge->addUniqueKey('nama_komisariat');
        $this->forge->createTable('komisariat');
    }

    public function down()
    {
        $this->forge->dropTable('komisariat');
    }
}
