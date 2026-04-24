<?php include 'includes/header.php';

$setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM setting_website WHERE id=1"));

if(isset($_POST['simpan'])) {
    $judul = $_POST['banner_judul'];
    $subjudul = $_POST['banner_subjudul'];
    $tombol1 = $_POST['tombol_donasi_teks'];
    $tombol2 = $_POST['tombol_program_teks'];
    
    // Upload banner baru kalau ada
    $banner_foto = $setting['banner_foto'];
    if($_FILES['banner_foto']['name'] != "") {
        $ext = pathinfo($_FILES['banner_foto']['name'], PATHINFO_EXTENSION);
        $banner_foto = 'hero-'.time().'.'.$ext;
        move_uploaded_file($_FILES['banner_foto']['tmp_name'], '../assets/img/'.$banner_foto);
    }
    
    mysqli_query($koneksi, "UPDATE setting_website SET 
        banner_judul='$judul', 
        banner_subjudul='$subjudul', 
        banner_foto='$banner_foto',
        tombol_donasi_teks='$tombol1',
        tombol_program_teks='$tombol2' 
        WHERE id=1");
    echo "<script>alert('Berhasil disimpan!'); window.location='beranda.php'</script>";
}
?>

<h3 class="mb-4"><i class="bi bi-house-door"></i> Dashboard Beranda</h3>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Atur Tampilan Hero Section Halaman Utama</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Judul Utama Banner</label>
                        <input type="text" name="banner_judul" class="form-control" value="<?= $setting['banner_judul'] ?>" placeholder="Yayasan Masjid Al-Ikhlas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teks Sambutan / Slogan</label>
                        <textarea name="banner_subjudul" class="form-control" rows="2" required><?= $setting['banner_subjudul'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teks Tombol Donasi</label>
                            <input type="text" name="tombol_donasi_teks" class="form-control" value="<?= $setting['tombol_donasi_teks'] ?? 'Donasi Sekarang' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teks Tombol Program</label>
                            <input type="text" name="tombol_program_teks" class="form-control" value="<?= $setting['tombol_program_teks'] ?? 'Info Kegiatan' ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Foto Banner Saat Ini</label>
                    <img src="../assets/img/<?= $setting['banner_foto'] ?: 'hero-masjid.jpg' ?>" class="img-fluid rounded mb-2" alt="Banner">
                    <input type="file" name="banner_foto" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ganti foto. Ukuran ideal 1920x800px</small>
                </div>
            </div>
            <hr>
            <button type="submit" name="simpan" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>