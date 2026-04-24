<?php include 'includes/header.php';

if(isset($_POST['kirim_pesan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = $_POST['email'];
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);
    
    mysqli_query($koneksi, "INSERT INTO pesan_kontak (nama,email,pesan) VALUES ('$nama','$email','$pesan')");
    $sukses = "Pesan Anda berhasil dikirim! Kami akan segera merespon.";
}

$setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM setting_website WHERE id=1"));
?>

<div class="container py-5">
    <h2 class="text-center mb-5">Hubungi Kami</h2>
    <?php if(isset($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-4">Kirim Pesan</h5>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Pesan Anda</label>
                            <textarea name="pesan" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" name="kirim_pesan" class="btn btn-success w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-4">Info Kontak</h5>
                    <p><i class="bi bi-geo-alt-fill text-success"></i> <?= nl2br($setting['alamat']) ?></p>
                    <p><i class="bi bi-envelope-fill text-success"></i> <?= $setting['email'] ?></p>
                    <p><i class="bi bi-telephone-fill text-success"></i> <?= $setting['no_telp'] ?></p>
                    <hr>
                    <h6>Rekening Donasi</h6>
                    <pre class="bg-light p-3 rounded small"><?= $setting['rekening_bank'] ?></pre>
                    <?php if($setting['qris_img']) { ?>
                    <img src="assets/img/<?= $setting['qris_img'] ?>" class="img-fluid rounded" alt="QRIS">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>