<?php include 'includes/header.php';

// Hapus data
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM program WHERE id=$id");
    echo "<script>window.location='program.php?msg=hapus'</script>";
}

// Tambah/Edit data
if(isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    
    if($id == "") {
        mysqli_query($koneksi, "INSERT INTO program (judul,deskripsi,kategori) VALUES ('$judul','$deskripsi','$kategori')");
    } else {
        mysqli_query($koneksi, "UPDATE program SET judul='$judul', deskripsi='$deskripsi', kategori='$kategori' WHERE id=$id");
    }
    echo "<script>window.location='program.php?msg=sukses'</script>";
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-journal-bookmark"></i> Dashboard Program & Kegiatan</h3>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProgram"><i class="bi bi-plus-circle"></i> Tambah Program</button>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-success">
        <tr><th>Judul Program</th><th>Kategori</th><th width="150">Aksi</th></tr>
    </thead>
    <tbody>
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM program ORDER BY id DESC");
        while($d = mysqli_fetch_assoc($q)) { ?>
        <tr>
            <td><?= $d['judul'] ?></td>
            <td><span class="badge bg-secondary"><?= $d['kategori'] ?></span></td>
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalProgram" 
                    data-id="<?= $d['id'] ?>" data-judul="<?= $d['judul'] ?>" data-deskripsi="<?= $d['deskripsi'] ?>" data-kategori="<?= $d['kategori'] ?>">
                    <i class="bi bi-pencil"></i> Edit
                </button>
                <a href="?hapus=<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i> Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalProgram" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Form Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label>Judul Program</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="Dakwah">Dakwah & Kajian</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Sosial">Sosial</option>
                            <option value="Pembangunan">Pembangunan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Isi modal saat edit
document.getElementById('modalProgram').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    document.getElementById('id').value = button.getAttribute('data-id') || '';
    document.getElementById('judul').value = button.getAttribute('data-judul') || '';
    document.getElementById('deskripsi').value = button.getAttribute('data-deskripsi') || '';
    document.getElementById('kategori').value = button.getAttribute('data-kategori') || 'Dakwah';
});
</script>

<?php include 'includes/footer.php'; ?>