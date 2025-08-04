<?php
// app/Views/karyawan/edit.php
?>
<?= $this->include('layout/header') ?>

<!-- Tampilkan error jika ada -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Karyawan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/karyawan/update/' . $karyawan['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="<?= old('nama', $karyawan['nama']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email', $karyawan['email']) ?>" required>
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
                                <option value="<?= $dept['id'] ?>" 
                                        <?= old('department_id', $karyawan['department_id']) == $dept['id'] ? 'selected' : '' ?>>
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
                                <option value="<?= $jab['id'] ?>" 
                                        <?= old('jabatan_id', $karyawan['jabatan_id']) == $jab['id'] ? 'selected' : '' ?>>
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
                               value="<?= old('tanggal_masuk', $karyawan['tanggal_masuk']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="active" <?= old('status', $karyawan['status']) == 'active' ? 'selected' : '' ?>>Aktif</option>
                            <option value="inactive" <?= old('status', $karyawan['status']) == 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="cuti" <?= old('status', $karyawan['status']) == 'cuti' ? 'selected' : '' ?>>Cuti</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" 
                               value="<?= old('telepon', $karyawan['telepon']) ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" 
                               accept="image/*" onchange="previewImage(this)">
                        <?php if ($karyawan['foto']): ?>
                            <img src="<?= base_url('uploads/karyawan/' . $karyawan['foto']) ?>" 
                                 id="imagePreview" class="mt-2" style="max-width: 200px;">
                        <?php else: ?>
                            <img id="imagePreview" src="#" alt="Preview" class="mt-2" 
                                 style="max-width: 200px; display: none;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= old('alamat', $karyawan['alamat']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/karyawan') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>

<?= $this->include('layout/footer') ?>