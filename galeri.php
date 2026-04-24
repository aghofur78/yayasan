<?php include 'includes/header.php';
$kat = $_GET['kat'] ?? 'semua';
$where = $kat != 'semua' ? "WHERE kategori='$kat'" : "";
$q = mysqli_query($koneksi, "SELECT * FROM galeri $where ORDER BY id DESC");
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Galeri Kegiatan</h2>
    
    <div class="text-center mb-5">
        <a href="galeri.php" class="btn btn-<?= $kat=='semua'?'success':'outline-success' ?> btn-sm m-1">Semua</a>
        <a href="galeri.php?kat=Kegiatan" class="btn btn-<?= $kat=='Kegiatan'?'success':'outline-success' ?> btn-sm m-1">Kegiatan</a>
        <a href="galeri.php?kat=Pembangunan" class="btn btn-<?= $kat=='Pembangunan'?'success':'outline-success' ?> btn-sm m-1">Pembangunan</a>
        <a href="galeri.php?kat=Sosial" class="btn btn-<?= $kat=='Sosial'?'success':'outline-success' ?> btn-sm m-1">Sosial</a>
        <a href="galeri.php?kat=Kajian" class="btn btn-<?= $kat=='Kajian'?'success':'outline-success' ?> btn-sm m-1">Kajian</a>
    </div>

    <div class="row g-3">
        <?php if(mysqli_num_rows($q) == 0) { ?>
            <div class="col-12"><div class="alert alert-info text-center">Belum ada foto di kategori ini.</div></div>
        <?php } while($g = mysqli_fetch_assoc($q)) { ?>
        <div class="col-md-3 col-6">
            <a href="assets/img/<?= $g['file_foto'] ?>" data-bs-toggle="modal" data-bs-target="#modalImg" data-img="assets/img/<?= $g['file_foto'] ?>" data-judul="<?= $g['judul'] ?>">
                <img src="assets/img/<?= $g['file_foto'] ?>" class="img-fluid rounded shadow-sm" style="height:200px; width:100%; object-fit:cover;" alt="<?= $g['judul'] ?>">
            </a>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="modalImg">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJudul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalGambar" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('modalImg').addEventListener('show.bs.modal', function (e) {
    var b = e.relatedTarget;
    document.getElementById('modalGambar').src = b.getAttribute('data-img');
    document.getElementById('modalJudul').textContent = b.getAttribute('data-judul');
});
</script>

<?php include 'includes/footer.php'; ?>