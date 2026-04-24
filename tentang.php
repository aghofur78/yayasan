<?php include 'includes/header.php'; 
$pengurus = mysqli_query($koneksi, "SELECT * FROM pengurus ORDER BY id ASC");
$setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM setting_website WHERE id=1"));
?>

<div class="container py-5">
    <h2 class="text-center mb-5">Tentang Yayasan Attaqwa Palem Pertiwi</h2>
    
    <!-- Sejarah -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="assets/img/hero-masjid.jpg" class="img-fluid rounded shadow" alt="Masjid Al-Ikhlas">
        </div>
        <div class="col-md-6">
            <h4 class="text-success">Sejarah Berdiri</h4>
            <p>Yayasan Attaqwa Palem Pertiwi didirikan pada tahun 2017 oleh jamaah dan tokoh masyarakat sekitar dengan tujuan membangun sarana ibadah sekaligus pusat kegiatan keislaman. Berawal dari musholla kecil, kini Alhamdulillah sudah menjadi masjid yang makmur dengan berbagai program dakwah, pendidikan, dan sosial.</p>
            <p>Kami berkomitmen menjadi masjid yang ramah, terbuka, dan bermanfaat untuk seluruh lapisan masyarakat.</p>
        </div>
    </div>

    <!-- Visi Misi -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white"><h5 class="mb-0">Visi</h5></div>
                <div class="card-body">
                    <p>Menjadi pusat peradaban Islam yang melahirkan generasi Qurani, berakhlak mulia, dan bermanfaat bagi umat.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white"><h5 class="mb-0">Misi</h5></div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Menyelenggarakan ibadah dan syiar Islam</li>
                        <li>Membina pendidikan Al-Quran dan keislaman</li>
                        <li>Menjalankan program sosial kemasyarakatan</li>
                        <li>Memberdayakan ekonomi jamaah berbasis masjid</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur Pengurus -->
    <h4 class="text-center mb-4 text-success">Struktur Pengurus Yayasan</h4>
    <div class="row g-4 justify-content-center">
        <?php if(mysqli_num_rows($pengurus) == 0) { ?>
            <p class="text-center text-muted">Data pengurus belum diisi. Silakan input di dashboard admin.</p>
        <?php } while($p = mysqli_fetch_assoc($pengurus)) { ?>
        <div class="col-md-3 col-6">
            <div class="card text-center shadow-sm">
                <img src="assets/img/pengurus/<?= $p['foto'] ?: 'default.png' ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1"><?= $p['nama'] ?></h6>
                    <p class="card-text small text-muted"><?= $p['jabatan'] ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>