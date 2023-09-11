<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AccountsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'user1',
                'password' => password_hash('qweqwe', PASSWORD_DEFAULT), // Mengenkripsi password
                'point' => 100,
                'status' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'username' => 'user2',
                'password' => password_hash('qweqwe', PASSWORD_DEFAULT),
                'point' => 100,
                'status' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            // Tambahkan data dummy lain sesuai kebutuhan
        ];

        // Insert data ke tabel 'accounts'
        $this->db->table('accounts')->insertBatch($data);
    }
}
