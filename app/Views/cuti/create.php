<?php
// app/Views/cuti/create.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengajuan Cuti</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/cuti/store') ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="karyawan_id" class="form-label">Karyawan *</label>
                        <select class="form-select" id="karyawan_id" name="karyawan_id" required>
                            <option value="">Pilih Karyawan</option>
                            <?php foreach ($karyawan as $k): ?>
                                <option value="<?= $k['id'] ?>" <?= old('karyawan_id') == $k['id'] ? 'selected' : '' ?>>
                                    <?= $k['nama'] ?> - <?= $k['nama_departemen'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jenis_cuti" class="form-label">Jenis Cuti *</label>
                        <select class="form-select" id="jenis_cuti" name="jenis_cuti" required>
                            <option value="">Pilih Jenis Cuti</option>
                            <option value="tahunan" <?= old('jenis_cuti') == 'tahunan' ? 'selected' : '' ?>>Cuti Tahunan</option>
                            <option value="sakit" <?= old('jenis_cuti') == 'sakit' ? 'selected' : '' ?>>Cuti Sakit</option>
                            <option value="melahirkan" <?= old('jenis_cuti') == 'melahirkan' ? 'selected' : '' ?>>Cuti Melahirkan</option>
                            <option value="darurat" <?= old('jenis_cuti') == 'darurat' ? 'selected' : '' ?>>Cuti Darurat</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai *</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                               value="<?= old('tanggal_mulai') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai *</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" 
                               value="<?= old('tanggal_selesai') ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alasan" class="form-label">Alasan Cuti *</label>
                <textarea class="form-control" id="alasan" name="alasan" rows="4" 
                          placeholder="Jelaskan alasan pengajuan cuti ini" required><?= old('alasan') ?></textarea>
                <div class="form-text">Minimal 10 karakter</div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Pengajuan cuti akan masuk dengan status "Pending" dan menunggu persetujuan dari atasan.
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/cuti') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-1"></i>Ajukan Cuti
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Validasi tanggal
document.getElementById('tanggal_mulai').addEventListener('change', function() {
    const tanggalMulai = this.value;
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    // Set minimum date untuk tanggal selesai
    tanggalSelesai.min = tanggalMulai;
    
    // Reset tanggal selesai jika lebih kecil dari tanggal mulai
    if (tanggalSelesai.value && tanggalSelesai.value < tanggalMulai) {
        tanggalSelesai.value = tanggalMulai;
    }
});

// Set minimum date untuk tanggal mulai (hari ini)
document.getElementById('tanggal_mulai').min = new Date().toISOString().split('T')[0];
</script>

<?= $this->include('layout/footer') ?>
