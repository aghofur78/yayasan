<?php include 'includes/header.php';

// Hapus
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT file_foto FROM galeri WHERE id=$id"))['file_foto'];
    if(file_exists("../assets/img/".$foto)) unlink("../assets/img/".$foto);
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id=$id");
    echo "<script>window.location='galeri.php'</script>";
}

// Upload
if(isset($_POST['upload'])) {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    
    if($_FILES['file_foto']['name'] != "") {
        $ext = pathinfo($_FILES['file_foto']['name'], PATHINFO_EXTENSION);
        $nama_file = 'galeri-'.time().'.'.$ext;
        move_uploaded_file($_FILES['file_foto']['tmp_name'], '../assets/img/'.$nama_file);
        mysqli_query($koneksi, "INSERT INTO galeri (judul,file_foto,kategori) VALUES ('$judul','$nama_file','$kategori')");
    }
    echo "<script>window.location='galeri.php'</script>";
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-images"></i> Dashboard Galeri</h3>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGaleri"><i class="bi bi-plus-circle"></i> Tambah Foto</button>
</div>

<div class="row g-3">
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
    while($g = mysqli_fetch_assoc($q)) { ?>
    <div class="col-md-3">
        <div class="card">
            <img src="../assets/img/<?= $g['file_foto'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h6 class="card-title"><?= $g['judul'] ?></h6>
                <span class="badge bg-secondary mb-2"><?= $g['kategori'] ?></span>
                <a href="?hapus=<?= $g['id'] ?>" class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus foto?')"><i class="bi bi-trash"></i> Hapus</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="modalGaleri">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header"><h5 class="modal-title">Upload Foto Galeri</h5></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul Foto</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Pembangunan">Pembangunan</option>
                            <option value="Sosial">Sosial</option>
                            <option value="Kajian">Kajian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>File Foto</label>
                        <input type="file" name="file_foto" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="upload" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>