<?php
// app/Database/Seeds/CutiSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CutiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'karyawan_id' => 1, // John Doe
                'tanggal_mulai' => '2024-02-15',
                'tanggal_selesai' => '2024-02-17',
                'jenis_cuti' => 'tahunan',
                'alasan' => 'Berlibur bersama keluarga ke Bali',
                'status' => 'approved',
                'approved_by' => 1,
                'catatan_approval' => 'Cuti disetujui. Selamat berlibur!',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'karyawan_id' => 2, // Jane Smith
                'tanggal_mulai' => '2024-03-01',
                'tanggal_selesai' => '2024-03-01',
                'jenis_cuti' => 'sakit',
                'alasan' => 'Demam tinggi dan perlu istirahat',
                'status' => 'approved',
                'approved_by' => 1,
                'catatan_approval' => 'Cepat sembuh ya!',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'karyawan_id' => 4, // Sarah Wilson
                'tanggal_mulai' => '2024-04-10',
                'tanggal_selesai' => '2024-04-12',
                'jenis_cuti' => 'tahunan',
                'alasan' => 'Menghadiri acara keluarga di kampung halaman',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'karyawan_id' => 5, // David Brown
                'tanggal_mulai' => '2024-05-01',
                'tanggal_selesai' => '2024-05-03',
                'jenis_cuti' => 'darurat',
                'alasan' => 'Orangtua sakit dan perlu dirawat di rumah sakit',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('cuti')->insertBatch($data);
    }
}