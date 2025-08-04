<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><?= $title ?></h5>
                        <div>
                            <a href="/karyawan/edit/<?= $karyawan['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="/karyawan" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <!-- Photo Section -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    <?php if ($karyawan['foto']): ?>
                                        <img src="/uploads/karyawan/<?= $karyawan['foto'] ?>" 
                                             alt="Foto <?= $karyawan['nama'] ?>" 
                                             class="img-fluid rounded" 
                                             style="max-width: 300px; max-height: 400px;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 200px; height: 250px; margin: 0 auto;">
                                            <i class="fas fa-user fa-5x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Details Section -->
                            <div class="col-md-8">
                                <h4 class="mb-3"><?= $karyawan['nama'] ?></h4>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Email:</strong></div>
                                    <div class="col-sm-8"><?= $karyawan['email'] ?></div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Departemen:</strong></div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-primary"><?= $karyawan['nama_departemen'] ?? 'N/A' ?></span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Jabatan:</strong></div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-success"><?= $karyawan['nama_jabatan'] ?? 'N/A' ?></span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Tanggal Masuk:</strong></div>
                                    <div class="col-sm-8"><?= date('d F Y', strtotime($karyawan['tanggal_masuk'])) ?></div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Status:</strong></div>
                                    <div class="col-sm-8">
                                        <?php 
                                        $statusClass = '';
                                        switch($karyawan['status']) {
                                            case 'active': $statusClass = 'bg-success'; break;
                                            case 'inactive': $statusClass = 'bg-danger'; break;
                                            case 'cuti': $statusClass = 'bg-warning'; break;
                                            default: $statusClass = 'bg-secondary';
                                        }
                                        ?>
                                        <span class="badge <?= $statusClass ?>"><?= ucfirst($karyawan['status']) ?></span>
                                    </div>
                                </div>
                                
                                <?php if ($karyawan['telepon']): ?>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Telepon:</strong></div>
                                    <div class="col-sm-8"><?= $karyawan['telepon'] ?></div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($karyawan['alamat']): ?>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Alamat:</strong></div>
                                    <div class="col-sm-8"><?= nl2br($karyawan['alamat']) ?></div>
                                </div>
                                <?php endif; ?>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Dibuat:</strong></div>
                                    <div class="col-sm-8"><?= date('d F Y H:i', strtotime($karyawan['created_at'])) ?></div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Diupdate:</strong></div>
                                    <div class="col-sm-8"><?= date('d F Y H:i', strtotime($karyawan['updated_at'])) ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="/karyawan/edit/<?= $karyawan['id'] ?>" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-danger" onclick="showDeleteConfirm('<?= $karyawan['nama'] ?>', '<?= $karyawan['id'] ?>')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        let deleteModal;
        let employeeIdToDelete;
        
        // Initialize modal when page loads
        document.addEventListener('DOMContentLoaded', function() {
            deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        });
        
        function showDeleteConfirm(employeeName, employeeId) {
            // Set employee name in modal
            document.getElementById('employeeName').textContent = employeeName;
            employeeIdToDelete = employeeId;
            
            // Show modal
            deleteModal.show();
        }
        
        // Handle delete confirmation
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (employeeIdToDelete) {
                // Add loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menghapus...';
                this.disabled = true;
                
                // Redirect to delete URL after short delay for UX
                setTimeout(() => {
                    window.location.href = `/karyawan/delete/${employeeIdToDelete}`;
                }, 800);
            }
        });
        
        // Reset button state when modal is hidden
        document.getElementById('deleteConfirmModal').addEventListener('hidden.bs.modal', function() {
            const deleteBtn = document.getElementById('confirmDeleteBtn');
            deleteBtn.innerHTML = '<i class="fas fa-trash me-1"></i> Ya, Hapus!';
            deleteBtn.disabled = false;
            employeeIdToDelete = null;
        });
    </script>
</body>
</html>