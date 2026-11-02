<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReviewFieldsToPengajuanSk extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengajuan_sk', [
            'reviewed_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'submitted_at',
            ],
            'reviewed_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'reviewed_at',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pengajuan_sk', ['reviewed_at', 'reviewed_by']);
    }
}
