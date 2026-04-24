<?php include 'includes/header.php';

// Konfirmasi donasi
if(isset($_GET['konfirmasi'])) {
    $id = $_GET['konfirmasi'];
    mysqli_query($koneksi, "UPDATE donasi SET status='Terkonfirmasi' WHERE id=$id");
    echo "<script>window.location='donasi.php?tab=laporan'</script>";
}

// Hapus donasi
if(isset($_GET['hapus_donasi'])) {
    $id = $_GET['hapus_donasi'];
    mysqli_query($koneksi, "DELETE FROM donasi WHERE id=$id");
    echo "<script>window.location='donasi.php?tab=laporan'</script>";
}

// Tambah/Edit Metode Bayar
if(isset($_POST['simpan_metode'])) {
    $id = $_POST['id_metode'];
    $nama = $_POST['nama_metode'];
    $norek = $_POST['no_rek_akun'];
    $an = $_POST['atas_nama'];
    
    if($id == "") {
        mysqli_query($koneksi, "INSERT INTO metode_donasi (nama_metode,no_rek_akun,atas_nama) VALUES ('$nama','$norek','$an')");
    } else {
        mysqli_query($koneksi, "UPDATE metode_donasi SET nama_metode='$nama', no_rek_akun='$norek', atas_nama='$an' WHERE id=$id");
    }
    echo "<script>window.location='donasi.php?tab=metode'</script>";
}

// Hapus metode
if(isset($_GET['hapus_metode'])) {
    $id = $_GET['hapus_metode'];
    mysqli_query($koneksi, "DELETE FROM metode_donasi WHERE id=$id");
    echo "<script>window.location='donasi.php?tab=metode'</script>";
}

$tab = $_GET['tab'] ?? 'laporan';
?>

<h3 class="mb-4"><i class="bi bi-cash-coin"></i> Dashboard Donasi & Zakat</h3>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link <?= $tab=='laporan'?'active':'' ?>" href="?tab=laporan">Laporan Donasi Masuk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $tab=='metode'?'active':'' ?>" href="?tab=metode">Metode Pembayaran</a>
    </li>
</ul>

<?php if($tab == 'laporan') { ?>
<!-- TAB LAPORAN DONASI -->
<div class="card">
    <div class="card-body">
	
	<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Laporan Donasi Masuk</h5>
    <div>
        <a href="laporan-donasi.php?filter=bulan_ini" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> PDF Bulan Ini</a>
        <a href="laporan-donasi.php?filter=semua" target="_blank" class="btn btn-outline-danger btn-sm"><i class="bi bi-file-pdf"></i> PDF Semua</a>
    </div>
</div>
	
        <table class="table table-hover">
            <thead class="table-success">
                <tr><th>Tanggal</th><th>Nama Donatur</th><th>Jumlah</th><th>Jenis</th><th>Bukti</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM donasi ORDER BY tanggal DESC");
                while($d = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($d['tanggal'])) ?></td>
                    <td><?= $d['nama_donatur'] ?></td>
                    <td><strong>Rp <?= number_format($d['jumlah']) ?></strong></td>
                    <td><span class="badge bg-info"><?= $d['jenis'] ?></span></td>
                    <td>
                        <?php if($d['bukti_tf']) { ?>
                        <a href="../assets/img/bukti/<?= $d['bukti_tf'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                        <?php } else { echo '-'; } ?>
                    </td>
                    <td><span class="badge bg-<?= $d['status']=='Terkonfirmasi'?'success':'warning' ?>"><?= $d['status'] ?></span></td>
                    <td>
                        <?php if($d['status']=='Pending') { ?>
                        <a href="?konfirmasi=<?= $d['id'] ?>" class="btn btn-sm btn-success"><i class="bi bi-check"></i></a>
                        <?php } ?>
                        <a href="?hapus_donasi=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php } else { ?>
<!-- TAB METODE PEMBAYARAN -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Kelola Rekening & E-Wallet</h5>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMetode"><i class="bi bi-plus-circle"></i> Tambah Metode</button>
</div>

<div class="row g-3">
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM metode_donasi");
    while($m = mysqli_fetch_assoc($q)) { ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6><?= $m['nama_metode'] ?></h6>
                <p class="mb-1"><strong><?= $m['no_rek_akun'] ?></strong></p>
                <p class="text-muted small mb-2">a.n <?= $m['atas_nama'] ?></p>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalMetode" 
                    data-id="<?= $m['id'] ?>" data-nama="<?= $m['nama_metode'] ?>" data-norek="<?= $m['no_rek_akun'] ?>" data-an="<?= $m['atas_nama'] ?>">
                    <i class="bi bi-pencil"></i> Edit
                </button>
                <a href="?hapus_metode=<?= $m['id'] ?>&tab=metode" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<!-- Modal Metode -->
<div class="modal fade" id="modalMetode">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header"><h5 class="modal-title">Form Metode Pembayaran</h5></div>
                <div class="modal-body">
                    <input type="hidden" name="id_metode" id="id_metode">
                    <div class="mb-3">
                        <label>Nama Bank / E-Wallet</label>
                        <input type="text" name="nama_metode" id="nama_metode" class="form-control" placeholder="Contoh: BSI, DANA" required>
                    </div>
                    <div class="mb-3">
                        <label>No. Rekening / No. HP</label>
                        <input type="text" name="no_rek_akun" id="no_rek_akun" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" id="atas_nama" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan_metode" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('modalMetode').addEventListener('show.bs.modal', function (e) {
    var b = e.relatedTarget;
    document.getElementById('id_metode').value = b.getAttribute('data-id') || '';
    document.getElementById('nama_metode').value = b.getAttribute('data-nama') || '';
    document.getElementById('no_rek_akun').value = b.getAttribute('data-norek') || '';
    document.getElementById('atas_nama').value = b.getAttribute('data-an') || '';
});
</script>
<?php } ?>

<?php include 'includes/footer.php'; ?>