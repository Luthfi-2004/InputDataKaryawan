<?php
// app/Views/department/index.php
?>
<?= $this->include('layout/header') ?>

<!-- Custom CSS untuk Modal Modern -->
<style>
.pulse-animation {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.modal-content {
    border-radius: 15px !important;
    background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
    border: 2px solid #dc3545;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

.btn-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient-secondary:hover {
    background: linear-gradient(135deg, #5a6268 0%, #545b62 100%);
    transform: translateY(-1px);
}

.table-hover tbody tr:hover {
    background-color: rgba(0,123,255,.075);
    transition: background-color 0.3s ease;
}
</style>

<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Departemen</h6>
        <a href="<?= base_url('/department/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Departemen
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Departemen</th>
                        <th>Nama Departemen</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($departments)): ?>
                        <?php foreach ($departments as $index => $dept): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><span class="badge bg-primary"><?= $dept['kode_departemen'] ?></span></td>
                                <td><?= $dept['nama_departemen'] ?></td>
                                <td><?= $dept['deskripsi'] ?: '-' ?></td>
                                <td><?= date('d/m/Y', strtotime($dept['created_at'])) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/department/edit/' . $dept['id']) ?>" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- UBAH BAGIAN INI: Ganti dari confirmDelete ke showDeleteConfirm -->
                                        <button onclick="showDeleteConfirm('<?= $dept['nama_departemen'] ?>', '<?= $dept['kode_departemen'] ?>', '<?= base_url('/department/delete/' . $dept['id']) ?>')" 
                                                class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data departemen</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAMBAHAN: Modal Konfirmasi Delete Modern MERAH -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="fas fa-building text-danger fa-3x pulse-animation"></i>
                </div>
                <h5 class="mb-3 text-danger fw-bold">🚨 KONFIRMASI HAPUS DEPARTEMEN</h5>
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10" role="alert">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Apakah Anda yakin ingin menghapus departemen:
                    <br><strong id="departmentName" class="text-danger fw-bold fs-5"></strong>
                    <br><span class="badge bg-danger mt-1" id="departmentCode"></span>
                </div>
                <p class="text-danger mb-4 fw-semibold">
                    <i class="fas fa-skull-crossbones me-1"></i>
                    <small>PERINGATAN: Menghapus departemen akan mempengaruhi data karyawan terkait!</small>
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-gradient-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-danger px-4" id="confirmDeleteBtn">
                        <span class="spinner-border spinner-border-sm d-none me-1" role="status"></span>
                        <i class="fas fa-trash me-1" id="deleteIcon"></i>
                        <span id="deleteText">Hapus Departemen</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TAMBAHAN: JavaScript Functions -->
<script>
function showDeleteConfirm(departmentName, departmentCode, deleteUrl) {
    // Set nama dan kode departemen di modal
    document.getElementById('departmentName').textContent = departmentName;
    document.getElementById('departmentCode').textContent = departmentCode;
    
    // Set click handler untuk tombol konfirmasi
    document.getElementById('confirmDeleteBtn').onclick = function() {
        deleteDepartment(deleteUrl);
    };
    
    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function deleteDepartment(url) {
    const btn = document.getElementById('confirmDeleteBtn');
    const spinner = btn.querySelector('.spinner-border');
    const icon = document.getElementById('deleteIcon');
    const text = document.getElementById('deleteText');
    
    // Ubah state tombol ke loading
    btn.disabled = true;
    spinner.classList.remove('d-none');
    icon.classList.add('d-none');
    text.textContent = 'Menghapus...';
    
    // Redirect ke URL delete
    setTimeout(() => {
        window.location.href = url;
    }, 500);
}

// Reset modal state ketika ditutup
document.getElementById('deleteModal').addEventListener('hidden.bs.modal', function () {
    const btn = document.getElementById('confirmDeleteBtn');
    const spinner = btn.querySelector('.spinner-border');
    const icon = document.getElementById('deleteIcon');
    const text = document.getElementById('deleteText');
    
    // Reset tombol ke state normal
    btn.disabled = false;
    spinner.classList.add('d-none');
    icon.classList.remove('d-none');
    text.textContent = 'Hapus Departemen';
});
</script>

<?= $this->include('layout/footer') ?>