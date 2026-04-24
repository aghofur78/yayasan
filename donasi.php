<?php include 'includes/header.php';
$metode = mysqli_query($koneksi, "SELECT * FROM metode_donasi");
$setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM setting_website WHERE id=1"));

if(isset($_POST['kirim_donasi'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_donatur']);
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    
    $bukti = '';
    if($_FILES['bukti_tf']['name'] != "") {
        $ext = pathinfo($_FILES['bukti_tf']['name'], PATHINFO_EXTENSION);
        $bukti = 'bukti-'.time().'.'.$ext;
        move_uploaded_file($_FILES['bukti_tf']['tmp_name'], 'assets/img/bukti/'.$bukti);
    }
    
    mysqli_query($koneksi, "INSERT INTO donasi (nama_donatur,jumlah,jenis,bukti_tf) VALUES ('$nama','$jumlah','$jenis','$bukti')");
    $sukses = "Jazakumullah khairan! Donasi Anda sudah kami terima dan akan segera dikonfirmasi admin.";
}
?>

<div class="container py-5">
    <h2 class="text-center mb-5">Donasi & Zakat</h2>
    <?php if(isset($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white"><h5 class="mb-0">Formulir Donasi Online</h5></div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Nama Donatur / Hamba Allah</label>
                            <input type="text" name="nama_donatur" class="form-control" placeholder="Boleh dikosongkan" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Donasi</label>
                            <select name="jenis" class="form-select" required>
                                <option value="Infaq">Infaq</option>
                                <option value="Sedekah">Sedekah</option>
                                <option value="Zakat">Zakat</option>
                                <option value="Wakaf">Wakaf</option>
                                <option value="Pembangunan">Pembangunan Masjid</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nominal Donasi</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 100000" required>
                        </div>
                        <div class="mb-3">
                            <label>Upload Bukti Transfer</label>
                            <input type="file" name="bukti_tf" class="form-control" accept="image/*" required>
                            <small class="text-muted">Wajib upload agar cepat dikonfirmasi</small>
                        </div>
                        <button type="submit" name="kirim_donasi" class="btn btn-success w-100">Kirim Konfirmasi Donasi</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning"><h5 class="mb-0">Transfer ke Rekening</h5></div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded"><?= $setting['rekening_bank'] ?: 'Data rekening belum diisi admin' ?></pre>
                    <?php if($setting['qris_img']) { ?>
                    <p class="text-center mb-1">Atau Scan QRIS:</p>
                    <img src="assets/img/<?= $setting['qris_img'] ?>" class="img-fluid rounded" alt="QRIS">
                    <?php } ?>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white"><h5 class="mb-0">Laporan Transparansi</h5></div>
                <div class="card-body">
                    <p>Total donasi bulan ini: <strong>Rp <?= number_format(mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as t FROM donasi WHERE status='Terkonfirmasi' AND MONTH(tanggal)=MONTH(NOW())"))['t'] ?? 0) ?></strong></p>
                    <a href="laporan-donasi.php?filter=bulan_ini" target="_blank" class="btn btn-outline-danger btn-sm">Download Laporan PDF</a>
                    <hr>
                    <p class="small mb-0">Penyaluran dana diupdate setiap pekan di menu Berita.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>