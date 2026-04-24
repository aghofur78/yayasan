<?php include 'includes/header.php';
$jadwal = getJadwalShalat('Surabaya', 'Indonesia');
$w = $jadwal['data']['timings'];
$tgl = $jadwal['data']['date']['gregorian']['date'];
$hijri = $jadwal['data']['date']['hijri'];
?>

<div class="container py-5">
    <h2 class="text-center mb-2">Jadwal Shalat & Kajian</h2>
    <p class="text-center text-muted mb-5">Wilayah Surabaya & Sekitarnya | <?= $tgl ?> / <?= $hijri['day'].' '.$hijri['month']['en'].' '.$hijri['year'] ?> H</p>
    
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white"><h5 class="mb-0"><i class="bi bi-clock"></i> Waktu Shalat Hari Ini</h5></div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td><i class="bi bi-sunrise text-success"></i> Imsak</td><td class="text-end fw-bold"><?= $w['Imsak'] ?></td></tr>
                        <tr><td><i class="bi bi-sunrise text-success"></i> Shubuh</td><td class="text-end fw-bold"><?= $w['Fajr'] ?></td></tr>
                        <tr><td><i class="bi bi-brightness-high text-success"></i> Terbit</td><td class="text-end fw-bold"><?= $w['Sunrise'] ?></td></tr>
                        <tr><td><i class="bi bi-sun text-success"></i> Dzuhur</td><td class="text-end fw-bold"><?= $w['Dhuhr'] ?></td></tr>
                        <tr><td><i class="bi bi-sunset text-success"></i> Ashar</td><td class="text-end fw-bold"><?= $w['Asr'] ?></td></tr>
                        <tr><td><i class="bi bi-moon text-success"></i> Maghrib</td><td class="text-end fw-bold"><?= $w['Maghrib'] ?></td></tr>
                        <tr><td><i class="bi bi-moon-stars text-success"></i> Isya</td><td class="text-end fw-bold"><?= $w['Isha'] ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white"><h5 class="mb-0"><i class="bi bi-calendar-event"></i> Jadwal Kajian Rutin</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <div><strong>Kajian Tafsir Ahad Pagi</strong><br><small class="text-muted">Ust. Ahmad Fulan, Lc.</small></div>
                            <span class="badge bg-success align-self-center">Ahad, 07:00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div><strong>Kajian Fiqih Wanita</strong><br><small class="text-muted">Ustzh. Fatimah</small></div>
                            <span class="badge bg-success align-self-center">Selasa, 16:00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div><strong>Tahsin & Tahfidz Anak</strong><br><small class="text-muted">Tim TPQ Al-Ikhlas</small></div>
                            <span class="badge bg-success align-self-center">Senin-Kamis, 15:30</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div><strong>Khutbah Jumat</strong><br><small class="text-muted">Jadwal Imam bergilir</small></div>
                            <span class="badge bg-success align-self-center">Jumat, 11:45</span>
                        </li>
                    </ul>
                    <div class="alert alert-warning mt-3 mb-0 small">
                        <i class="bi bi-info-circle"></i> Jadwal dapat berubah sewaktu-waktu. Update terbaru cek di Instagram @masjid_alikhlas
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>