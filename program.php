<?php include 'includes/header.php';
$kat = $_GET['kat'] ?? 'semua';
$where = $kat != 'semua' ? "WHERE kategori='$kat'" : "";
$q = mysqli_query($koneksi, "SELECT * FROM program $where ORDER BY created_at DESC");
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Program & Kegiatan</h2>
    
    <!-- Filter Kategori -->
    <div class="text-center mb-5">
        <a href="program.php" class="btn btn-<?= $kat=='semua'?'success':'outline-success' ?> btn-sm m-1">Semua</a>
        <a href="program.php?kat=Dakwah" class="btn btn-<?= $kat=='Dakwah'?'success':'outline-success' ?> btn-sm m-1">Dakwah & Kajian</a>
        <a href="program.php?kat=Pendidikan" class="btn btn-<?= $kat=='Pendidikan'?'success':'outline-success' ?> btn-sm m-1">Pendidikan</a>
        <a href="program.php?kat=Sosial" class="btn btn-<?= $kat=='Sosial'?'success':'outline-success' ?> btn-sm m-1">Sosial</a>
        <a href="program.php?kat=Pembangunan" class="btn btn-<?= $kat=='Pembangunan'?'success':'outline-success' ?> btn-sm m-1">Pembangunan</a>
    </div>

    <div class="row g-4">
        <?php if(mysqli_num_rows($q) == 0) { ?>
            <div class="col-12"><div class="alert alert-info text-center">Belum ada program di kategori ini.</div></div>
        <?php } while($p = mysqli_fetch_assoc($q)) { ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="assets/img/program/<?= $p['thumbnail'] ?: 'default.jpg' ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <span class="badge bg-success mb-2"><?= $p['kategori'] ?></span>
                    <h5 class="card-title"><?= $p['judul'] ?></h5>
                    <p class="card-text small"><?= substr(strip_tags($p['deskripsi']),0,120) ?>...</p>
                </div>
                <div class="card-footer bg-white">
                    <small class="text-muted"><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($p['created_at'])) ?></small>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>