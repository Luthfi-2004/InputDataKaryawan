<?php
// app/Models/KaryawanModel.php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nama', 'email', 'department_id', 'jabatan_id', 
        'tanggal_masuk', 'status', 'foto', 'alamat', 'telepon'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama'          => 'required|min_length[3]|max_length[100]',
        'email'         => 'required|valid_email|is_unique[karyawan.email]',
        'department_id' => 'required|integer|is_not_unique[departments.id]',
        'jabatan_id'    => 'required|integer|is_not_unique[jabatan.id]',
        'tanggal_masuk' => 'required|valid_date',
        'status'        => 'required|in_list[active,inactive,cuti]'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getKaryawanWithDepartmentAndJabatan()
    {
        return $this->select('karyawan.*, departments.nama_departemen, jabatan.nama_jabatan')
                    ->join('departments', 'departments.id = karyawan.department_id')
                    ->join('jabatan', 'jabatan.id = karyawan.jabatan_id')
                    ->findAll();
    }

    public function getKaryawanById($id)
    {
        return $this->select('karyawan.*, departments.nama_departemen, jabatan.nama_jabatan')
                    ->join('departments', 'departments.id = karyawan.department_id')
                    ->join('jabatan', 'jabatan.id = karyawan.jabatan_id')
                    ->find($id);
    }
}
