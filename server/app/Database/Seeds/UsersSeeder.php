<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'admin_user',
                'email'      => 'admin@example.com',
                'password'   => password_hash('admin_password', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'employee_user',
                'email'      => 'employee@example.com',
                'password'   => password_hash('employee_password', PASSWORD_BCRYPT),
                'role'       => 'employee',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using the query builder to insert the data
        $this->db->table('users')->insertBatch($data);
    }
}