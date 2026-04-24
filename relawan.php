<?php include 'includes/header.php';

if(isset($_POST['daftar'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $wa = $_POST['no_wa'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $bidang = $_POST['bidang_minat'];
    
    mysqli_query($koneksi, "INSERT INTO relawan (nama,no_wa,alamat,bidang_minat) VALUES ('$nama','$wa','$alamat','$bidang')");
    $sukses = "Jazakallah khair! Pendaftaran Anda sudah kami terima. Admin akan menghubungi via WhatsApp.";
}
?>

<div class="container py-5">
    <h2 class="text-center mb-2">Pendaftaran Relawan Masjid</h2>
    <p class="text-center text-muted mb-5">Mari bersama memakmurkan masjid & membantu sesama</p>
    
    <?php if(isset($sukses)) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white"><h5 class="mb-0">Formulir Pendaftaran</h5></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>No. WhatsApp Aktif</label>
                            <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat Domisili</label>
                            <textarea name="alamat" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Bidang Minat</label>
                            <select name="bidang_minat" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Dakwah & Takmir">Dakwah & Takmir</option>
                                <option value="Pendidikan TPQ">Pendidikan TPQ</option>
                                <option value="Sosial & Santunan">Sosial & Santunan</option>
                                <option value="Kebersihan & Keamanan">Kebersihan & Keamanan</option>
                                <option value="Media & Dokumentasi">Media & Dokumentasi</option>
                                <option value="Logistik Acara">Logistik Acara</option>
                            </select>
                        </div>
                        <button type="submit" name="daftar" class="btn btn-success w-100">Daftar Jadi Relawan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning"><h5 class="mb-0">Info Relawan</h5></div>
                <div class="card-body">
                    <h6>Kenapa Jadi Relawan?</h6>
                    <ul>
                        <li>Menambah pahala jariyah</li>
                        <li>Menambah teman & jaringan kebaikan</li>
                        <li>Belajar skill baru: publik speaking, event, dll</li>
                        <li>Ikut memakmurkan rumah Allah</li>
                    </ul>
                    <hr>
                    <h6>Syarat:</h6>
                    <ul>
                        <li>Muslim/Muslimah, usia 17+</li>
                        <li>Berkomitmen & bisa kerja tim</li>
                        <li>Domisili Gresik & sekitarnya</li>
                    </ul>
                    <hr>
                    <p class="mb-0 small"><i class="bi bi-whatsapp text-success"></i> Info grup relawan akan dishare setelah pendaftaran dikonfirmasi admin.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>