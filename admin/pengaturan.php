<?php include 'includes/header.php';

$admin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM admin WHERE id=".$_SESSION['admin_id']));

// Ganti password
if(isset($_POST['ganti_pass'])) {
    $lama = $_POST['pass_lama'];
    $baru = $_POST['pass_baru'];
    $konf = $_POST['pass_konfirmasi'];
    
    if(!password_verify($lama, $admin['password'])) {
        $error = "Password lama salah!";
    } elseif($baru != $konf) {
        $error = "Konfirmasi password tidak sama!";
    } elseif(strlen($baru) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        $hash = password_hash($baru, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE admin SET password='$hash' WHERE id=".$_SESSION['admin_id']);
        $sukses = "Password berhasil diganti!";
    }
}

// Update nama
if(isset($_POST['update_nama'])) {
    $nama = $_POST['nama_lengkap'];
    mysqli_query($koneksi, "UPDATE admin SET nama_lengkap='$nama' WHERE id=".$_SESSION['admin_id']);
    $_SESSION['admin_nama'] = $nama;
    $sukses = "Nama berhasil diupdate!";
}
?>

<h3 class="mb-4"><i class="bi bi-gear"></i> Dashboard Pengaturan</h3>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<?php if(isset($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Ubah Data Admin</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?= $admin['username'] ?>" disabled>
                        <small class="text-muted">Username tidak bisa diubah</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= $admin['nama_lengkap'] ?>" required>
                    </div>
                    <button type="submit" name="update_nama" class="btn btn-success">Update Nama</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Ganti Password</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="pass_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="pass_baru" class="form-control" minlength="6" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="pass_konfirmasi" class="form-control" minlength="6" required>
                    </div>
                    <button type="submit" name="ganti_pass" class="btn btn-warning">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>