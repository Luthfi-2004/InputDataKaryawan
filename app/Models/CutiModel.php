<?php
// app/Models/CutiModel.php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'karyawan_id', 'tanggal_mulai', 'tanggal_selesai', 
        'jenis_cuti', 'alasan', 'status', 'approved_by', 'catatan_approval'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'karyawan_id'     => 'required|integer|is_not_unique[karyawan.id]',
        'tanggal_mulai'   => 'required|valid_date',
        'tanggal_selesai' => 'required|valid_date',
        'jenis_cuti'      => 'required|in_list[tahunan,sakit,melahirkan,darurat]',
        'alasan'          => 'required|min_length[10]',
        'status'          => 'in_list[pending,approved,rejected]'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getCutiWithKaryawan()
    {
        return $this->select('cuti.*, karyawan.nama as nama_karyawan, departments.nama_departemen')
                    ->join('karyawan', 'karyawan.id = cuti.karyawan_id')
                    ->join('departments', 'departments.id = karyawan.department_id')
                    ->orderBy('cuti.created_at', 'DESC')
                    ->findAll();
    }

    public function getCutiById($id)
    {
        return $this->select('cuti.*, karyawan.nama as nama_karyawan, departments.nama_departemen')
                    ->join('karyawan', 'karyawan.id = cuti.karyawan_id')
                    ->join('departments', 'departments.id = karyawan.department_id')
                    ->find($id);
    }
}