<?php include 'includes/header.php';
$id = $_GET['id'] ?? '';

if($id) {
    $b = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM berita WHERE id=$id"));
    ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-3"><?= $b['judul'] ?></h2>
                <p class="text-muted"><i class="bi bi-person"></i> <?= $b['penulis'] ?> | <i class="bi bi-calendar"></i> <?= date('d F Y', strtotime($b['tanggal_publish'])) ?></p>
                <img src="assets/img/<?= $b['thumbnail'] ?>" class="img-fluid rounded mb-4">
                <div class="content"><?= nl2br($b['konten']) ?></div>
                <a href="berita.php" class="btn btn-success mt-4"><i class="bi bi-arrow-left"></i> Kembali ke Berita</a>
            </div>
        </div>
    </div>
    <?php
} else {
    $q = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal_publish DESC");
    ?>
    <div class="container py-5">
        <h2 class="text-center mb-5">Berita & Artikel Islami</h2>
        <div class="row g-4">
            <?php while($b = mysqli_fetch_assoc($q)) { ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="assets/img/<?= $b['thumbnail'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $b['judul'] ?></h5>
                        <p class="card-text small text-muted"><?= substr(strip_tags($b['konten']),0,100) ?>...</p>
                        <a href="berita.php?id=<?= $b['id'] ?>" class="btn btn-outline-success btn-sm">Baca Selengkapnya</a>
                    </div>
                    <div class="card-footer bg-white">
                        <small class="text-muted"><?= date('d M Y', strtotime($b['tanggal_publish'])) ?></small>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}
include 'includes/footer.php'; ?>