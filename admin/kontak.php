<?php include 'includes/header.php';

$setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM setting_website WHERE id=1"));

// Update profil yayasan
if(isset($_POST['simpan_profil'])) {
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $email = $_POST['email'];
    $telp = $_POST['no_telp'];
    $rekening = mysqli_real_escape_string($koneksi, $_POST['rekening_bank']);
    
    $qris = $setting['qris_img'];
    if($_FILES['qris_img']['name'] != "") {
        $ext = pathinfo($_FILES['qris_img']['name'], PATHINFO_EXTENSION);
        $qris = 'qris-'.time().'.'.$ext;
        move_uploaded_file($_FILES['qris_img']['tmp_name'], '../assets/img/'.$qris);
    }
    
    mysqli_query($koneksi, "UPDATE setting_website SET 
        alamat='$alamat', email='$email', no_telp='$telp', 
        rekening_bank='$rekening', qris_img='$qris' WHERE id=1");
    echo "<script>alert('Profil berhasil diupdate!'); window.location='kontak.php'</script>";
}

// Hapus pesan
if(isset($_GET['hapus_pesan'])) {
    $id = $_GET['hapus_pesan'];
    mysqli_query($koneksi, "DELETE FROM pesan_kontak WHERE id=$id");
    echo "<script>window.location='kontak.php?tab=pesan'</script>";
}

$tab = $_GET['tab'] ?? 'profil';
?>

<h3 class="mb-4"><i class="bi bi-telephone"></i> Dashboard Kontak & Tentang Kami</h3>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link <?= $tab=='profil'?'active':'' ?>" href="?tab=profil">Profil Yayasan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $tab=='pesan'?'active':'' ?>" href="?tab=pesan">
            Pesan Masuk 
            <?php 
            $jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan_kontak")); 
            if($jml > 0) echo "<span class='badge bg-danger'>$jml</span>";
            ?>
        </a>
    </li>
</ul>

<?php if($tab == 'profil') { ?>
<!-- TAB PROFIL YAYASAN -->
<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Kelola Informasi Kontak & Rekening Donasi</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap Masjid</label>
                        <textarea name="alamat" class="form-control" rows="3" required><?= $setting['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Resmi</label>
                        <input type="email" name="email" class="form-control" value="<?= $setting['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon/WA</label>
                        <input type="text" name="no_telp" class="form-control" value="<?= $setting['no_telp'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Info Rekening Bank</label>
                        <textarea name="rekening_bank" class="form-control" rows="4" placeholder="Contoh:&#10;BSI 7123456789 a.n Yayasan Masjid Al-Ikhlas&#10;BCA 1234567890 a.n Yayasan Masjid Al-Ikhlas"><?= $setting['rekening_bank'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">QRIS Donasi</label>
                        <?php if($setting['qris_img']) { ?>
                        <img src="../assets/img/<?= $setting['qris_img'] ?>" width="150" class="d-block mb-2 rounded">
                        <?php } ?>
                        <input type="file" name="qris_img" class="form-control" accept="image/*">
                        <small class="text-muted">Upload gambar QRIS baru jika ingin ganti</small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" name="simpan_profil" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php } else { ?>
<!-- TAB PESAN MASUK -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pesan dari Pengunjung Website</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-success">
                <tr><th>Tanggal</th><th>Nama</th><th>Email</th><th>Pesan</th><th width="80">Aksi</th></tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM pesan_kontak ORDER BY tanggal DESC");
                if(mysqli_num_rows($q) == 0) {
                    echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada pesan masuk</td></tr>";
                }
                while($p = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($p['tanggal'])) ?></td>
                    <td><?= htmlspecialchars($p['nama']) ?></td>
                    <td><a href="mailto:<?= $p['email'] ?>"><?= $p['email'] ?></a></td>
                    <td><?= nl2br(htmlspecialchars(substr($p['pesan'],0,100))) ?>...</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalPesan" 
                            data-nama="<?= htmlspecialchars($p['nama']) ?>" 
                            data-email="<?= $p['email'] ?>" 
                            data-pesan="<?= htmlspecialchars($p['pesan']) ?>">
                            <i class="bi bi-eye"></i>
                        </button>
                        <a href="?hapus_pesan=<?= $p['id'] ?>&tab=pesan" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pesan ini?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Lihat Pesan -->
<div class="modal fade" id="modalPesan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Dari:</strong> <span id="modal_nama"></span></p>
                <p><strong>Email:</strong> <span id="modal_email"></span></p>
                <hr>
                <p id="modal_pesan"></p>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('modalPesan').addEventListener('show.bs.modal', function (e) {
    var b = e.relatedTarget;
    document.getElementById('modal_nama').textContent = b.getAttribute('data-nama');
    document.getElementById('modal_email').textContent = b.getAttribute('data-email');
    document.getElementById('modal_pesan').textContent = b.getAttribute('data-pesan');
});
</script>
<?php } ?>

<?php include 'includes/footer.php'; ?>