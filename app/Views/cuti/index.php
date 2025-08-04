<?php
// app/Views/cuti/index.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Cuti</h6>
        <a href="<?= base_url('/cuti/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Pengajuan Cuti
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Departemen</th>
                        <th>Tanggal Cuti</th>
                        <th>Jenis Cuti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cuti)): ?>
                        <?php foreach ($cuti as $index => $c): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $c['nama_karyawan'] ?></td>
                                <td><?= $c['nama_departemen'] ?></td>
                                <td>
                                    <?= date('d/m/Y', strtotime($c['tanggal_mulai'])) ?> - 
                                    <?= date('d/m/Y', strtotime($c['tanggal_selesai'])) ?>
                                    <br>
                                    <small class="text-muted">
                                        (<?= (strtotime($c['tanggal_selesai']) - strtotime($c['tanggal_mulai'])) / 86400 + 1 ?> hari)
                                    </small>
                                </td>
                                <td>
                                    <?php
                                    $jenis_badges = [
                                        'tahunan' => 'bg-primary',
                                        'sakit' => 'bg-warning',
                                        'melahirkan' => 'bg-success',
                                        'darurat' => 'bg-danger'
                                    ];
                                    ?>
                                    <span class="badge <?= $jenis_badges[$c['jenis_cuti']] ?>">
                                        <?= ucfirst($c['jenis_cuti']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($c['status'] == 'pending'): ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php elseif ($c['status'] == 'approved'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/cuti/show/' . $c['id']) ?>" 
                                           class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($c['status'] == 'pending'): ?>
                                            <a href="<?= base_url('/cuti/edit/' . $c['id']) ?>" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button onclick="approveReject(<?= $c['id'] ?>, 'approve')" 
                                                    class="btn btn-success btn-sm" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button onclick="approveReject(<?= $c['id'] ?>, 'reject')" 
                                                    class="btn btn-danger btn-sm" title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button onclick="confirmDelete('<?= base_url('/cuti/delete/' . $c['id']) ?>', 'data cuti')" 
                                                class="btn btn-outline-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data cuti</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
