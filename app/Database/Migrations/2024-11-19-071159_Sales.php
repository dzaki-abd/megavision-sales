<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_client' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_employee' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_item' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'order_date' => [
                'type' => 'DATE'
            ],
            'client_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'client_email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'client_phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
