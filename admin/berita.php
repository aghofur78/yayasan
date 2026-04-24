<?php include 'includes/header.php';

// Hapus berita
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT thumbnail FROM berita WHERE id=$id"))['thumbnail'];
    if($foto && file_exists("../assets/img/".$foto)) unlink("../assets/img/".$foto);
    mysqli_query($koneksi, "DELETE FROM berita WHERE id=$id");
    echo "<script>window.location='berita.php'</script>";
}

// Simpan berita
if(isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
    $penulis = $_POST['penulis'];
    $tanggal = $_POST['tanggal_publish'];
    
    $thumbnail = $_POST['thumbnail_lama'];
    if($_FILES['thumbnail']['name'] != "") {
        $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
        $thumbnail = 'berita-'.time().'.'.$ext;
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../assets/img/'.$thumbnail);
    }
    
    if($id == "") {
        mysqli_query($koneksi, "INSERT INTO berita (judul,konten,thumbnail,penulis,tanggal_publish) VALUES ('$judul','$konten','$thumbnail','$penulis','$tanggal')");
    } else {
        mysqli_query($koneksi, "UPDATE berita SET judul='$judul', konten='$konten', thumbnail='$thumbnail', penulis='$penulis', tanggal_publish='$tanggal' WHERE id=$id");
    }
    echo "<script>window.location='berita.php'</script>";
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-newspaper"></i> Dashboard Berita & Artikel</h3>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBerita"><i class="bi bi-plus-circle"></i> Tambah Berita</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-success">
                <tr><th width="80">Gambar</th><th>Judul</th><th>Penulis</th><th>Tanggal</th><th width="150">Aksi</th></tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal_publish DESC");
                while($b = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><img src="../assets/img/<?= $b['thumbnail'] ?>" width="60" class="rounded"></td>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['penulis'] ?></td>
                    <td><?= date('d/m/Y', strtotime($b['tanggal_publish'])) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalBerita" 
                            data-id="<?= $b['id'] ?>" data-judul="<?= htmlspecialchars($b['judul']) ?>" 
                            data-konten="<?= htmlspecialchars($b['konten']) ?>" data-penulis="<?= $b['penulis'] ?>" 
                            data-tanggal="<?= $b['tanggal_publish'] ?>" data-thumb="<?= $b['thumbnail'] ?>">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <a href="?hapus=<?= $b['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Berita -->
<div class="modal fade" id="modalBerita" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header"><h5 class="modal-title">Form Berita</h5></div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_berita">
                    <input type="hidden" name="thumbnail_lama" id="thumbnail_lama">
                    <div class="mb-3">
                        <label>Judul Berita</label>
                        <input type="text" name="judul" id="judul_berita" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Publish</label>
                            <input type="date" name="tanggal_publish" id="tanggal_publish" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Thumbnail / Gambar Utama</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <img id="preview_thumb" src="" width="100" class="mt-2 rounded d-none">
                    </div>
                    <div class="mb-3">
                        <label>Isi Konten</label>
                        <textarea name="konten" id="konten_berita" class="form-control" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('modalBerita').addEventListener('show.bs.modal', function (e) {
    var b = e.relatedTarget;
    document.getElementById('id_berita').value = b.getAttribute('data-id') || '';
    document.getElementById('judul_berita').value = b.getAttribute('data-judul') || '';
    document.getElementById('konten_berita').value = b.getAttribute('data-konten') || '';
    document.getElementById('penulis').value = b.getAttribute('data-penulis') || '';
    document.getElementById('tanggal_publish').value = b.getAttribute('data-tanggal') || '<?= date('Y-m-d') ?>';
    document.getElementById('thumbnail_lama').value = b.getAttribute('data-thumb') || '';
    
    var thumb = b.getAttribute('data-thumb');
    var preview = document.getElementById('preview_thumb');
    if(thumb) {
        preview.src = '../assets/img/' + thumb;
        preview.classList.remove('d-none');
    } else {
        preview.classList.add('d-none');
    }
});
</script>

<?php include 'includes/footer.php'; ?>