<?php
// app/Database/Seeds/DatabaseSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('DepartmentSeeder');
        $this->call('JabatanSeeder');
        $this->call('KaryawanSeeder');
        $this->call('CutiSeeder');
    }
}