<?php
// app/Controllers/KaryawanController.php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\DepartmentModel;
use App\Models\JabatanModel;

class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $departmentModel;
    protected $jabatanModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->departmentModel = new DepartmentModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => $this->karyawanModel->getKaryawanWithDepartmentAndJabatan(),
            'departments' => $this->departmentModel->findAll(),
            'jabatan' => $this->jabatanModel->findAll()
        ];

        return view('karyawan/index', $data);
    }

    public function show($id)
    {
        $karyawan = $this->karyawanModel->getKaryawanById($id);
        
        if (!$karyawan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Karyawan tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Karyawan',
            'karyawan' => $karyawan
        ];

        return view('karyawan/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Karyawan',
            'departments' => $this->departmentModel->findAll(),
            'jabatan' => $this->jabatanModel->findAll()
        ];

        return view('karyawan/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[karyawan.email]',
            'department_id' => 'required|integer',
            'jabatan_id' => 'required|integer',
            'tanggal_masuk' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,cuti]',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Pastikan folder upload ada
            $uploadPath = ROOTPATH . 'public/uploads/karyawan/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $fotoName = $foto->getRandomName();
            $foto->move($uploadPath, $fotoName);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'department_id' => $this->request->getPost('department_id'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'status' => $this->request->getPost('status'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'foto' => $fotoName
        ];

        if ($this->karyawanModel->save($data)) {
            return redirect()->to('/karyawan')->with('success', 'Karyawan berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan karyawan');
        }
    }

    public function edit($id)
    {
        $karyawan = $this->karyawanModel->find($id);
        
        if (!$karyawan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Karyawan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Karyawan',
            'karyawan' => $karyawan,
            'departments' => $this->departmentModel->findAll(),
            'jabatan' => $this->jabatanModel->findAll()
        ];

        return view('karyawan/edit', $data);
    }

    public function update($id)
    {
        // Debug - uncomment jika perlu debugging
        // echo "<pre>POST Data: "; print_r($this->request->getPost()); echo "</pre>";
        // echo "<pre>FILES: "; print_r($_FILES); echo "</pre>";
        // die();

        $karyawan = $this->karyawanModel->find($id);
        
        if (!$karyawan) {
            return redirect()->to('/karyawan')->with('error', 'Karyawan tidak ditemukan');
        }

        // Rules untuk update - email harus unique kecuali untuk record yang sama
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[karyawan.email,id,$id]",
            'department_id' => 'required|integer',
            'jabatan_id' => 'required|integer',
            'tanggal_masuk' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,cuti]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]' // permit_empty untuk update
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data update
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'department_id' => $this->request->getPost('department_id'),
            'jabatan_id' => $this->request->getPost('jabatan_id'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'status' => $this->request->getPost('status'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon')
        ];

        // Handle foto upload
        $foto = $this->request->getFile('foto');
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Pastikan folder upload ada
            $uploadPath = ROOTPATH . 'public/uploads/karyawan/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Hapus foto lama jika ada
            if ($karyawan['foto'] && file_exists($uploadPath . $karyawan['foto'])) {
                unlink($uploadPath . $karyawan['foto']);
            }
            
            // Upload foto baru
            $fotoName = $foto->getRandomName();
            if ($foto->move($uploadPath, $fotoName)) {
                $data['foto'] = $fotoName;
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal upload foto');
            }
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $data['foto'] = $karyawan['foto'];
        }

        // Update data dengan error handling
        try {
            if ($this->karyawanModel->update($id, $data)) {
                return redirect()->to('/karyawan')->with('success', 'Karyawan berhasil diupdate');
            } else {
                // Cek error dari model
                $errors = $this->karyawanModel->errors();
                if (!empty($errors)) {
                    return redirect()->back()->withInput()->with('errors', $errors);
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal mengupdate karyawan - tidak ada perubahan atau terjadi kesalahan');
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating karyawan: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $karyawan = $this->karyawanModel->find($id);
        
        if (!$karyawan) {
            return redirect()->to('/karyawan')->with('error', 'Karyawan tidak ditemukan');
        }

        // Delete photo if exists
        if ($karyawan['foto'] && file_exists(ROOTPATH . 'public/uploads/karyawan/' . $karyawan['foto'])) {
            unlink(ROOTPATH . 'public/uploads/karyawan/' . $karyawan['foto']);
        }

        if ($this->karyawanModel->delete($id)) {
            return redirect()->to('/karyawan')->with('success', 'Karyawan berhasil dihapus');
        } else {
            return redirect()->to('/karyawan')->with('error', 'Gagal menghapus karyawan');
        }
    }
}