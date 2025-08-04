<?php
// app/Views/department/edit.php
?>
<?= $this->include('layout/header') ?>

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Departemen</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/department/update/' . $department['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kode_departemen" class="form-label">Kode Departemen *</label>
                        <input type="text" class="form-control" id="kode_departemen" name="kode_departemen" 
                               value="<?= old('kode_departemen', $department['kode_departemen']) ?>" 
                               placeholder="Contoh: IT, HR, FIN" maxlength="10" 
                               style="text-transform: uppercase;" required>
                        <div class="form-text">Maksimal 10 karakter, akan otomatis diubah ke huruf besar</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_departemen" class="form-label">Nama Departemen *</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" 
                               value="<?= old('nama_departemen', $department['nama_departemen']) ?>" 
                               placeholder="Contoh: Information Technology" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                          placeholder="Deskripsi singkat tentang departemen ini"><?= old('deskripsi', $department['deskripsi']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/department') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Updatee
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto uppercase kode departemen
    document.getElementById('kode_departemen').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>

<?= $this->include('layout/footer') ?>