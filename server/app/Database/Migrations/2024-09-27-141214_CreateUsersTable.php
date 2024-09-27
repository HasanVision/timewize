<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Define the fields for the users table
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['employee', 'admin'],
                'default'    => 'employee',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);

       
        $this->forge->addKey('user_id', true);

     
        $this->forge->createTable('users');
    }

    public function down()
    {
        
        $this->forge->dropTable('users');
    }
}