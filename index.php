<?php include 'includes/header.php'; 
$jadwal = getJadwalShalat('Surabaya', 'Indonesia');
$waktu = $jadwal['data']['timings'];
?>

<!-- Hero Section -->
<section class="hero-section text-white d-flex align-items-center" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('assets/img/aqsa.jpg') center/cover; height: 80vh;">
    <div class="container">
        <h1 class="display-4 fw-bold">Yayasan Attaqwa Palem Pertiwi</h1>
        <p class="lead mb-4">Menebar Cahaya Islam, Merajut Ukhuwah</p>
        <a href="donasi.php" class="btn btn-warning btn-lg me-2"><i class="bi bi-heart-fill"></i> Donasi Sekarang</a>
        <a href="program.php" class="btn btn-success btn-lg">Info Kegiatan <i class="bi bi-arrow-right"></i></a>
    </div>
</section>

<!-- 3 Program Highlight -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body">
                        <i class="bi bi-book-fill text-success" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Program Dakwah & Sosial</h5>
                        <a href="program.php?kat=Dakwah" class="btn btn-success btn-sm mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body">
                        <i class="bi bi-people-fill text-success" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Santunan Anak Yatim</h5>
                        <a href="program.php?kat=Sosial" class="btn btn-success btn-sm mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div class="card-body">
                        <i class="bi bi-building-fill text-success" style="font-size: 3rem;"></i>
                        <h5 class="card-title mt-3">Pembangunan Masjid</h5>
                        <a href="program.php?kat=Pembangunan" class="btn btn-success btn-sm mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jadwal Shalat & Berita Terbaru -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Jadwal Shalat -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-clock-fill text-success"></i> Jadwal Shalat</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><span><i class="bi bi-sunrise text-success"></i> Shubuh</span> <strong><?= $waktu['Fajr'] ?></strong></li>
                            <li class="list-group-item d-flex justify-content-between"><span><i class="bi bi-sun text-success"></i> Dzuhur</span> <strong><?= $waktu['Dhuhr'] ?></strong></li>
                            <li class="list-group-item d-flex justify-content-between"><span><i class="bi bi-sunset text-success"></i> Ashar</span> <strong><?= $waktu['Asr'] ?></strong></li>
                            <li class="list-group-item d-flex justify-content-between"><span><i class="bi bi-moon text-success"></i> Maghrib</span> <strong><?= $waktu['Maghrib'] ?></strong></li>
                            <li class="list-group-item d-flex justify-content-between"><span><i class="bi bi-moon-stars text-success"></i> Isya</span> <strong><?= $waktu['Isha'] ?></strong></li>
                        </ul>
                        <p class="text-center text-muted small mt-2 mb-0">Waktu di Surabaya</p>
                        <a href="jadwal.php" class="btn btn-success w-100 mt-3">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            
            <!-- Berita Terbaru -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Berita & Kegiatan Terbaru</h5>
                    <a href="berita.php" class="text-success">Lihat Semua</a>
                </div>
                <?php
                $qBerita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 3");
                while($b = mysqli_fetch_assoc($qBerita)) { ?>
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="assets/img/<?= $b['thumbnail'] ?>" class="img-fluid rounded-start h-100 object-fit-cover" alt="<?= $b['judul'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h6 class="card-title"><?= $b['judul'] ?></h6>
                                <p class="card-text small text-muted"><?= substr(strip_tags($b['konten']),0,100) ?>...</p>
                                <a href="berita.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-success">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Kegiatan -->
<section class="py-5">
    <div class="container">
        <h5 class="mb-4">Galeri Kegiatan</h5>
        <div class="row g-3">
            <?php
            $qGaleri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC LIMIT 4");
            while($g = mysqli_fetch_assoc($qGaleri)) { ?>
            <div class="col-6 col-md-3">
                <img src="assets/img/<?= $g['file_foto'] ?>" class="img-fluid rounded shadow-sm" alt="<?= $g['judul'] ?>">
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- CTA Zakat & Relawan -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 bg-warning text-white rounded shadow text-center">
                    <h4><i class="bi bi-cash-coin"></i> Zakat & Infaq</h4>
                    <p>Salurkan Zakat & Sedekah Anda</p>
                    <a href="donasi.php" class="btn btn-light">Donasi Sekarang</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-success text-white rounded shadow text-center">
                    <h4><i class="bi bi-person-hearts"></i> Daftar Relawan</h4>
                    <p>Bergabung Menjadi Relawan Masjid</p>
                    <a href="relawan.php" class="btn btn-light">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>