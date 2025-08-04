<?php
// app/Controllers/DepartmentController.php

namespace App\Controllers;

use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Departemen',
            'departments' => $this->departmentModel->findAll()
        ];

        return view('department/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Departemen'
        ];

        return view('department/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_departemen' => 'required|min_length[3]|max_length[100]',
            'kode_departemen' => 'required|min_length[2]|max_length[10]|is_unique[departments.kode_departemen]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'kode_departemen' => strtoupper($this->request->getPost('kode_departemen')),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->departmentModel->save($data)) {
            return redirect()->to('/department')->with('success', 'Departemen berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan departemen');
        }
    }

    public function edit($id)
    {
        $department = $this->departmentModel->find($id);
        
        if (!$department) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Departemen tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Departemen',
            'department' => $department
        ];

        return view('department/edit', $data);
    }

    public function update($id)
    {
        $department = $this->departmentModel->find($id);
        
        if (!$department) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Departemen tidak ditemukan');
        }

        $rules = [
            'nama_departemen' => 'required|min_length[3]|max_length[100]',
            'kode_departemen' => "required|min_length[2]|max_length[10]|is_unique[departments.kode_departemen,id,$id]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'kode_departemen' => strtoupper($this->request->getPost('kode_departemen')),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->departmentModel->update($id, $data)) {
            return redirect()->to('/department')->with('success', 'Departemen berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate departemen');
        }
    }

    public function delete($id)
    {
        $department = $this->departmentModel->find($id);
        
        if (!$department) {
            return redirect()->to('/department')->with('error', 'Departemen tidak ditemukan');
        }

        if ($this->departmentModel->delete($id)) {
            return redirect()->to('/department')->with('success', 'Departemen berhasil dihapus');
        } else {
            return redirect()->to('/department')->with('error', 'Gagal menghapus departemen');
        }
    }
}

