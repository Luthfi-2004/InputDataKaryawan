<?php

// app/Controllers/CutiController.php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\KaryawanModel;

class CutiController extends BaseController
{
    protected $cutiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->cutiModel = new CutiModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Cuti',
            'cuti' => $this->cutiModel->getCutiWithKaryawan()
        ];

        return view('cuti/index', $data);
    }

    public function show($id)
    {
        $cuti = $this->cutiModel->getCutiById($id);
        
        if (!$cuti) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data cuti tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Cuti',
            'cuti' => $cuti
        ];

        return view('cuti/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Pengajuan Cuti',
            'karyawan' => $this->karyawanModel->getKaryawanWithDepartmentAndJabatan()
        ];

        return view('cuti/create', $data);
    }

    public function store()
    {
        $rules = [
            'karyawan_id' => 'required|integer',
            'tanggal_mulai' => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date',
            'jenis_cuti' => 'required|in_list[tahunan,sakit,melahirkan,darurat]',
            'alasan' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'karyawan_id' => $this->request->getPost('karyawan_id'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'jenis_cuti' => $this->request->getPost('jenis_cuti'),
            'alasan' => $this->request->getPost('alasan'),
            'status' => 'pending'
        ];

        if ($this->cutiModel->save($data)) {
            return redirect()->to('/cuti')->with('success', 'Pengajuan cuti berhasil disubmit');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengajukan cuti');
        }
    }

    public function edit($id)
    {
        $cuti = $this->cutiModel->find($id);
        
        if (!$cuti) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data cuti tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Cuti',
            'cuti' => $cuti,
            'karyawan' => $this->karyawanModel->getKaryawanWithDepartmentAndJabatan()
        ];

        return view('cuti/edit', $data);
    }

    public function update($id)
    {
        $cuti = $this->cutiModel->find($id);
        
        if (!$cuti) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data cuti tidak ditemukan');
        }

        $rules = [
            'karyawan_id' => 'required|integer',
            'tanggal_mulai' => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date',
            'jenis_cuti' => 'required|in_list[tahunan,sakit,melahirkan,darurat]',
            'alasan' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'karyawan_id' => $this->request->getPost('karyawan_id'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'jenis_cuti' => $this->request->getPost('jenis_cuti'),
            'alasan' => $this->request->getPost('alasan')
        ];

        if ($this->cutiModel->update($id, $data)) {
            return redirect()->to('/cuti')->with('success', 'Data cuti berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data cuti');
        }
    }

    public function approve($id)
    {
        $cuti = $this->cutiModel->find($id);
        
        if (!$cuti) {
            return redirect()->to('/cuti')->with('error', 'Data cuti tidak ditemukan');
        }

        $data = [
            'status' => 'approved',
            'approved_by' => session()->get('user_id'), // Assuming user session exists
            'catatan_approval' => $this->request->getPost('catatan_approval')
        ];

        if ($this->cutiModel->update($id, $data)) {
            return redirect()->to('/cuti')->with('success', 'Cuti berhasil disetujui');
        } else {
            return redirect()->to('/cuti')->with('error', 'Gagal menyetujui cuti');
        }
    }

    public function reject($id)
    {
        $cuti = $this->cutiModel->find($id);
        
        if (!$cuti) {
            return redirect()->to('/cuti')->with('error', 'Data cuti tidak ditemukan');
        }

        $data = [
            'status' => 'rejected',
            'approved_by' => session()->get('user_id'), // Assuming user session exists
            'catatan_approval' => $this->request->getPost('catatan_approval')
        ];

        if ($this->cutiModel->update($id, $data)) {
            return redirect()->to('/cuti')->with('success', 'Cuti berhasil ditolak');
        } else {
            return redirect()->to('/cuti')->with('error', 'Gagal menolak cuti');
        }
    }

    public function delete($id)
    {
        $cuti = $this->cutiModel->find($id);
        
        if (!$cuti) {
            return redirect()->to('/cuti')->with('error', 'Data cuti tidak ditemukan');
        }

        if ($this->cutiModel->delete($id)) {
            return redirect()->to('/cuti')->with('success', 'Data cuti berhasil dihapus');
        } else {
            return redirect()->to('/cuti')->with('error', 'Gagal menghapus data cuti');
        }
    }
}
