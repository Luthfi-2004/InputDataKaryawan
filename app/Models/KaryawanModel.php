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
    
    // PENTING: Pastikan semua field ada di sini
    protected $allowedFields = [
        'nama', 'email', 'department_id', 'jabatan_id', 
        'tanggal_masuk', 'status', 'foto', 'alamat', 'telepon'
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules untuk insert
    protected $validationRules = [
        'nama'          => 'required|min_length[3]|max_length[100]',
        'email'         => 'required|valid_email',
        'department_id' => 'required|integer|is_not_unique[departments.id]',
        'jabatan_id'    => 'required|integer|is_not_unique[jabatan.id]',
        'tanggal_masuk' => 'required|valid_date',
        'status'        => 'required|in_list[active,inactive,cuti]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal 3 karakter',
            'max_length' => 'Nama maksimal 100 karakter'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid'
        ],
        'department_id' => [
            'required' => 'Departemen harus dipilih',
            'integer' => 'Departemen tidak valid',
            'is_not_unique' => 'Departemen tidak ditemukan'
        ],
        'jabatan_id' => [
            'required' => 'Jabatan harus dipilih',
            'integer' => 'Jabatan tidak valid',
            'is_not_unique' => 'Jabatan tidak ditemukan'
        ],
        'tanggal_masuk' => [
            'required' => 'Tanggal masuk harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'status' => [
            'required' => 'Status harus dipilih',
            'in_list' => 'Status harus active, inactive, atau cuti'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Custom method untuk get karyawan dengan join
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

    // Override update method untuk handling khusus
    public function update($id = null, $data = null): bool
    {
        // Skip validation untuk update jika tidak ada data yang berubah
        if (empty($data)) {
            return false;
        }

        // Cek apakah ada perubahan data
        $existingData = $this->find($id);
        if (!$existingData) {
            return false;
        }

        // Bandingkan data lama dengan data baru
        $hasChanges = false;
        foreach ($data as $key => $value) {
            if (isset($existingData[$key]) && $existingData[$key] != $value) {
                $hasChanges = true;
                break;
            }
        }

        // Jika tidak ada perubahan, return true (dianggap berhasil)
        if (!$hasChanges) {
            return true;
        }

        // Lakukan update normal
        return parent::update($id, $data);
    }

    // Method untuk validasi update dengan rules khusus
    public function validateForUpdate($data, $id)
    {
        $rules = [
            'nama'          => 'required|min_length[3]|max_length[100]',
            'email'         => "required|valid_email|is_unique[karyawan.email,id,$id]",
            'department_id' => 'required|integer|is_not_unique[departments.id]',
            'jabatan_id'    => 'required|integer|is_not_unique[jabatan.id]',
            'tanggal_masuk' => 'required|valid_date',
            'status'        => 'required|in_list[active,inactive,cuti]'
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $this->validationMessages);
        
        return $validation->run($data);
    }
}