<?php
// app/Views/jabatan/edit.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Jabatan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/jabatan/update/' . $jabatan['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan *</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" 
                               value="<?= old('nama_jabatan', $jabatan['nama_jabatan']) ?>" 
                               placeholder="Contoh: Software Engineer" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level *</label>
                        <select class="form-select" id="level" name="level" required>
                            <option value="">Pilih Level</option>
                            <option value="1" <?= old('level', $jabatan['level']) == '1' ? 'selected' : '' ?>>Level 1 - Entry Level</option>
                            <option value="2" <?= old('level', $jabatan['level']) == '2' ? 'selected' : '' ?>>Level 2 - Junior</option>
                            <option value="3" <?= old('level', $jabatan['level']) == '3' ? 'selected' : '' ?>>Level 3 - Senior</option>
                            <option value="4" <?= old('level', $jabatan['level']) == '4' ? 'selected' : '' ?>>Level 4 - Lead/Supervisor</option>
                            <option value="5" <?= old('level', $jabatan['level']) == '5' ? 'selected' : '' ?>>Level 5 - Manager</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok *</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" 
                           value="<?= old('gaji_pokok', $jabatan['gaji_pokok']) ?>" 
                           placeholder="5000000" min="0" step="1000" required>
                </div>
                <div class="form-text">Masukkan nominal tanpa titik atau koma</div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                          placeholder="Deskripsi tugas dan tanggung jawab jabatan ini"><?= old('deskripsi', $jabatan['deskripsi']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/jabatan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->include('layout/footer') ?>