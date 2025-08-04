<?php

// app/Database/Seeds/KaryawanSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'John Doe',
                'email' => 'john.doe@aicc.com',
                'department_id' => 1, // IT
                'jabatan_id' => 1, // Software Engineer
                'tanggal_masuk' => '2023-01-15',
                'status' => 'active',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'telepon' => '081234567890',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jane Smith',
                'email' => 'jane.smith@aicc.com',
                'department_id' => 1, // IT
                'jabatan_id' => 2, // Senior Software Engineer
                'tanggal_masuk' => '2022-03-10',
                'status' => 'active',
                'alamat' => 'Jl. Sudirman No. 456, Jakarta',
                'telepon' => '081234567891',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Michael Johnson',
                'email' => 'michael.johnson@aicc.com',
                'department_id' => 1, // IT
                'jabatan_id' => 3, // IT Manager
                'tanggal_masuk' => '2021-05-20',
                'status' => 'active',
                'alamat' => 'Jl. Thamrin No. 789, Jakarta',
                'telepon' => '081234567892',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Sarah Wilson',
                'email' => 'sarah.wilson@aicc.com',
                'department_id' => 2, // HR
                'jabatan_id' => 4, // HR Specialist
                'tanggal_masuk' => '2023-02-01',
                'status' => 'active',
                'alamat' => 'Jl. Gatot Subroto No. 321, Jakarta',
                'telepon' => '081234567893',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'David Brown',
                'email' => 'david.brown@aicc.com',
                'department_id' => 3, // Finance
                'jabatan_id' => 5, // Finance Analyst
                'tanggal_masuk' => '2023-04-15',
                'status' => 'active',
                'alamat' => 'Jl. Kuningan No. 654, Jakarta',
                'telepon' => '081234567894',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Lisa Anderson',
                'email' => 'lisa.anderson@aicc.com',
                'department_id' => 4, // Marketing
                'jabatan_id' => 6, // Marketing Executive
                'tanggal_masuk' => '2023-06-01',
                'status' => 'active',
                'alamat' => 'Jl. Senayan No. 987, Jakarta',
                'telepon' => '081234567895',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Robert Taylor',
                'email' => 'robert.taylor@aicc.com',
                'department_id' => 5, // Operations
                'jabatan_id' => 7, // Operations Supervisor
                'tanggal_masuk' => '2022-08-10',
                'status' => 'active',
                'alamat' => 'Jl. Kemang No. 147, Jakarta',
                'telepon' => '081234567896',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('karyawan')->insertBatch($data);
    }
}