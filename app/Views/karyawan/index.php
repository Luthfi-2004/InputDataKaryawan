<?php
// app/Views/karyawan/index.php
?>
<?= $this->include('layout/header') ?>

<style>
    .custom-modal .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .custom-modal .modal-header {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }
    
    .custom-modal .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .danger-icon {
        font-size: 4rem;
        color: #dc3545;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .modal-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .btn-danger-custom {
        background: linear-gradient(135deg, #dc3545, #c82333);
        border: none;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
    }
    
    .btn-secondary-custom {
        background: #6c757d;
        border: none;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-secondary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,.075);
        transition: all 0.2s ease;
    }
    
    .btn-group .btn {
        transition: all 0.2s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
</style>

<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
        <a href="<?= base_url('/karyawan/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Karyawan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($karyawan)): ?>
                        <?php foreach ($karyawan as $index => $k): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if ($k['foto']): ?>
                                        <img src="<?= base_url('uploads/karyawan/' . $k['foto']) ?>" 
                                             class="rounded-circle" width="40" height="40">
                                    <?php else: ?>
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $k['nama'] ?></td>
                                <td><?= $k['email'] ?></td>
                                <td><?= $k['nama_departemen'] ?></td>
                                <td><?= $k['nama_jabatan'] ?></td>
                                <td>
                                    <?php if ($k['status'] == 'active'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php elseif ($k['status'] == 'inactive'): ?>
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Cuti</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/karyawan/show/' . $k['id']) ?>" 
                                           class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('/karyawan/edit/' . $k['id']) ?>" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="showDeleteConfirm('<?= $k['nama'] ?>', '<?= base_url('/karyawan/delete/' . $k['id']) ?>')" 
                                                class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data karyawan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Delete Confirmation Modal -->
<div class="modal fade custom-modal" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-fade-in">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="danger-icon mb-3">
                    <i class="fas fa-user-times"></i>
                </div>
                <h5 class="mb-3">Yakin ingin menghapus karyawan?</h5>
                <p class="text-muted mb-1">Nama: <strong id="employeeName"></strong></p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Peringatan:</strong> Data yang sudah dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-secondary-custom me-3" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger-custom" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>

<script>
    let deleteModal;
    let deleteUrl;
    
    // Initialize modal when page loads
    document.addEventListener('DOMContentLoaded', function() {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    });
    
    function showDeleteConfirm(employeeName, url) {
        // Set employee name in modal
        document.getElementById('employeeName').textContent = employeeName;
        deleteUrl = url;
        
        // Show modal
        deleteModal.show();
    }
    
    // Handle delete confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteUrl) {
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menghapus...';
            this.disabled = true;
            
            // Redirect to delete URL after short delay for UX
            setTimeout(() => {
                window.location.href = deleteUrl;
            }, 800);
        }
    });
    
    // Reset button state when modal is hidden
    document.getElementById('deleteConfirmModal').addEventListener('hidden.bs.modal', function() {
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        deleteBtn.innerHTML = '<i class="fas fa-trash me-1"></i> Ya, Hapus!';
        deleteBtn.disabled = false;
        deleteUrl = null;
    });
    
    // Image preview function for create form (if needed)
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php
// app/Views/karyawan/create.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Karyawan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/karyawan/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="<?= old('nama') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Departemen *</label>
                        <select class="form-select" id="department_id" name="department_id" required>
                            <option value="">Pilih Departemen</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= old('department_id') == $dept['id'] ? 'selected' : '' ?>>
                                    <?= $dept['nama_departemen'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jabatan_id" class="form-label">Jabatan *</label>
                        <select class="form-select" id="jabatan_id" name="jabatan_id" required>
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($jabatan as $jab): ?>
                                <option value="<?= $jab['id'] ?>" <?= old('jabatan_id') == $jab['id'] ? 'selected' : '' ?>>
                                    <?= $jab['nama_jabatan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk *</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" 
                               value="<?= old('tanggal_masuk') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Aktif</option>
                            <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="cuti" <?= old('status') == 'cuti' ? 'selected' : '' ?>>Cuti</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" 
                               value="<?= old('telepon') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" 
                               accept="image/*" onchange="previewImage(this)">
                        <img id="imagePreview" src="#" alt="Preview" class="mt-2" 
                             style="max-width: 200px; display: none;">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= old('alamat') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/karyawan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->include('layout/footer') ?>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>