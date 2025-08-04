<?php
// app/Views/cuti/show.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Cuti</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <td width="200"><strong>Nama Karyawan</strong></td>
                        <td>: <?= $cuti['nama_karyawan'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Departemen</strong></td>
                        <td>: <?= $cuti['nama_departemen'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Cuti</strong></td>
                        <td>: 
                            <?php
                            $jenis_badges = [
                                'tahunan' => 'bg-primary',
                                'sakit' => 'bg-warning',
                                'melahirkan' => 'bg-success',
                                'darurat' => 'bg-danger'
                            ];
                            ?>
                            <span class="badge <?= $jenis_badges[$cuti['jenis_cuti']] ?>">
                                <?= ucfirst($cuti['jenis_cuti']) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Mulai</strong></td>
                        <td>: <?= date('d F Y', strtotime($cuti['tanggal_mulai'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Selesai</strong></td>
                        <td>: <?= date('d F Y', strtotime($cuti['tanggal_selesai'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Durasi</strong></td>
                        <td>: <?= (strtotime($cuti['tanggal_selesai']) - strtotime($cuti['tanggal_mulai'])) / 86400 + 1 ?> hari</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>: 
                            <?php if ($cuti['status'] == 'pending'): ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php elseif ($cuti['status'] == 'approved'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pengajuan</strong></td>
                        <td>: <?= date('d F Y H:i', strtotime($cuti['created_at'])) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title">Alasan Cuti</h6>
                        <p class="card-text"><?= nl2br($cuti['alasan']) ?></p>
                        
                        <?php if ($cuti['catatan_approval']): ?>
                            <hr>
                            <h6 class="card-title">Catatan Approval</h6>
                            <p class="card-text"><?= nl2br($cuti['catatan_approval']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= base_url('/cuti') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <?php if ($cuti['status'] == 'pending'): ?>
                <div>
                    <a href="<?= base_url('/cuti/edit/' . $cuti['id']) ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <button onclick="approveReject(<?= $cuti['id'] ?>, 'approve')" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Setujui
                    </button>
                    <button onclick="approveReject(<?= $cuti['id'] ?>, 'reject')" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Tolak
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal for Approve/Reject -->
<div class="modal fade" id="approveRejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="approveRejectForm" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="catatan_approval" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="catatan_approval" name="catatan_approval" rows="3"
                                  placeholder="Berikan catatan untuk keputusan ini"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" id="submitBtn">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function approveReject(cutiId, action) {
    const modal = new bootstrap.Modal(document.getElementById('approveRejectModal'));
    const form = document.getElementById('approveRejectForm');
    const title = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitBtn');
    
    if (action === 'approve') {
        title.textContent = 'Setujui Cuti';
        submitBtn.textContent = 'Setujui';
        submitBtn.className = 'btn btn-success';
        form.action = '<?= base_url('/cuti/approve/') ?>' + cutiId;
    } else {
        title.textContent = 'Tolak Cuti';
        submitBtn.textContent = 'Tolak';
        submitBtn.className = 'btn btn-danger';
        form.action = '<?= base_url('/cuti/reject/') ?>' + cutiId;
    }
    
    modal.show();
}
</script>

<?= $this->include('layout/footer') ?>