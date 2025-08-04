<?php

// app/Controllers/JabatanController.php

namespace App\Controllers;

use App\Models\JabatanModel;

class JabatanController extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => $this->jabatanModel->findAll()
        ];

        return view('jabatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jabatan'
        ];

        return view('jabatan/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_jabatan' => 'required|min_length[3]|max_length[100]',
            'level' => 'required|integer|greater_than[0]',
            'gaji_pokok' => 'required|decimal|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'level' => $this->request->getPost('level'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->jabatanModel->save($data)) {
            return redirect()->to('/jabatan')->with('success', 'Jabatan berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan jabatan');
        }
    }

    public function edit($id)
    {
        $jabatan = $this->jabatanModel->find($id);
        
        if (!$jabatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jabatan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Jabatan',
            'jabatan' => $jabatan
        ];

        return view('jabatan/edit', $data);
    }

    public function update($id)
    {
        $jabatan = $this->jabatanModel->find($id);
        
        if (!$jabatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jabatan tidak ditemukan');
        }

        $rules = [
            'nama_jabatan' => 'required|min_length[3]|max_length[100]',
            'level' => 'required|integer|greater_than[0]',
            'gaji_pokok' => 'required|decimal|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'level' => $this->request->getPost('level'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->jabatanModel->update($id, $data)) {
            return redirect()->to('/jabatan')->with('success', 'Jabatan berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate jabatan');
        }
    }

    public function delete($id)
    {
        $jabatan = $this->jabatanModel->find($id);
        
        if (!$jabatan) {
            return redirect()->to('/jabatan')->with('error', 'Jabatan tidak ditemukan');
        }

        if ($this->jabatanModel->delete($id)) {
            return redirect()->to('/jabatan')->with('success', 'Jabatan berhasil dihapus');
        } else {
            return redirect()->to('/jabatan')->with('error', 'Gagal menghapus jabatan');
        }
    }
}
