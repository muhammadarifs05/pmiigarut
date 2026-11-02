<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanSkHistories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pengajuan_sk_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'aksi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status_lama' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'status_baru' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'performed_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'performed_by_role' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('pengajuan_sk_id');
        $this->forge->createTable('pengajuan_sk_histories');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_sk_histories');
    }
}
