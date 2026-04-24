<?php include 'includes/header.php'; 

$total_donasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM donasi WHERE status='Terkonfirmasi'"))['total'] ?? 0;
$jml_berita = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM berita"));
$jml_relawan = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM relawan WHERE status='Pending'"));
$jml_pesan = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan_kontak"));
?>

<h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Beranda</h3>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6>Total Donasi Masuk</h6>
                <h3>Rp <?= number_format($total_donasi) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h6>Total Berita</h6>
                <h3><?= $jml_berita ?> Artikel</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6>Relawan Pending</h6>
                <h3><?= $jml_relawan ?> Orang</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h6>Pesan Masuk</h6>
                <h3><?= $jml_pesan ?> Pesan</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>5 Donasi Terbaru</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead><tr><th>Nama</th><th>Jumlah</th><th>Jenis</th><th>Tanggal</th><th>Status</th></tr></thead>
            <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM donasi ORDER BY tanggal DESC LIMIT 5");
                while($d = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= $d['nama_donatur'] ?></td>
                    <td>Rp <?= number_format($d['jumlah']) ?></td>
                    <td><?= $d['jenis'] ?></td>
                    <td><?= date('d/m/Y', strtotime($d['tanggal'])) ?></td>
                    <td><span class="badge bg-<?= $d['status']=='Terkonfirmasi'?'success':'warning' ?>"><?= $d['status'] ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>