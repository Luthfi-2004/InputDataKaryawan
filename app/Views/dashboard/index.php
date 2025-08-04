<?php
// app/Views/dashboard/index.php
?>
<?= $this->include('layout/header') ?>

<!-- Dashboard Stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Karyawan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $total_cuti_pending ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Karyawan Terbaru</h6>
                <a href="<?= base_url('/karyawan') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i>Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_karyawan)): ?>
                                <?php foreach (array_slice($recent_karyawan, 0, 5) as $karyawan): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if ($karyawan['foto']): ?>
                                                    <img src="<?= base_url('uploads/karyawan/' . $karyawan['foto']) ?>" 
                                                         class="rounded-circle me-2" width="32" height="32">
                                                <?php else: ?>
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 32px; height: 32px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <?= $karyawan['nama'] ?>
                                            </div>
                                        </td>
                                        <td><?= $karyawan['nama_departemen'] ?></td>
                                        <td><?= $karyawan['nama_jabatan'] ?></td>
                                        <td>
                                            <?php if ($karyawan['status'] == 'active'): ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php elseif ($karyawan['status'] == 'inactive'): ?>
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Cuti</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data karyawan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('/karyawan/create') ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Tambah Karyawan
                    </a>
                    <a href="<?= base_url('/department/create') ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Tambah Departemen
                    </a>
                    <a href="<?= base_url('/jabatan/create') ?>" class="btn btn-info">
                        <i class="fas fa-briefcase me-2"></i>Tambah Jabatan
                    </a>
                    <a href="<?= base_url('/cuti/create') ?>" class="btn btn-warning">
                        <i class="fas fa-calendar-plus me-2"></i>Ajukan Cuti
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">System Info</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    AICC HRM System v1.0<br>
                    <i class="fas fa-calendar me-1"></i>
                    <?= date('Y-m-d H:i:s') ?><br>
                    <i class="fas fa-server me-1"></i>
                    CodeIgniter 4
                </small>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?> mb-0 font-weight-bold text-gray-800">
                            <?= $total_karyawan ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Departemen
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $total_department ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sitemap fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Jabatan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $total_jabatan ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Cuti Pending
                        </div>
                        <div class="h5>mb-0 font-weight-bold text-gray-800">
                            <?= $total_cuti_pending ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-times fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>