<?php

// app/Database/Seeds/JabatanSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_jabatan' => 'Software Engineer',
                'level' => 2,
                'gaji_pokok' => 8000000,
                'deskripsi' => 'Mengembangkan dan memelihara aplikasi software',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'Senior Software Engineer',
                'level' => 3,
                'gaji_pokok' => 12000000,
                'deskripsi' => 'Lead developer untuk project besar dan mentoring junior',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'IT Manager',
                'level' => 5,
                'gaji_pokok' => 18000000,
                'deskripsi' => 'Mengelola departemen IT dan strategi teknologi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'HR Specialist',
                'level' => 2,
                'gaji_pokok' => 7000000,
                'deskripsi' => 'Menangani rekrutmen dan administrasi karyawan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'Finance Analyst',
                'level' => 2,
                'gaji_pokok' => 7500000,
                'deskripsi' => 'Melakukan analisis keuangan dan laporan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'Marketing Executive',
                'level' => 2,
                'gaji_pokok' => 6500000,
                'deskripsi' => 'Menjalankan strategi pemasaran dan promosi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_jabatan' => 'Operations Supervisor',
                'level' => 4,
                'gaji_pokok' => 10000000,
                'deskripsi' => 'Mengawasi operasional harian perusahaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('jabatan')->insertBatch($data);
    }
}
