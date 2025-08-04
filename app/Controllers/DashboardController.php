<?php
// app/Controllers/DashboardController.php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\DepartmentModel;
use App\Models\JabatanModel;
use App\Models\CutiModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $departmentModel = new DepartmentModel();
        $jabatanModel = new JabatanModel();
        $cutiModel = new CutiModel();

        $data = [
            'title' => 'Dashboard',
            'total_karyawan' => $karyawanModel->countAll(),
            'total_department' => $departmentModel->countAll(),
            'total_jabatan' => $jabatanModel->countAll(),
            'total_cuti_pending' => $cutiModel->where('status', 'pending')->countAllResults(),
            'recent_karyawan' => $karyawanModel->getKaryawanWithDepartmentAndJabatan(),
        ];

        return view('dashboard/index', $data);
    }
}