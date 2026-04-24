<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh; position: fixed;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="bi bi-moon-stars-fill fs-4 me-2"></i>
        <span class="fs-5">Admin YAPP</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="beranda.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'beranda.php' ? 'active' : '' ?>">
                <i class="bi bi-house-door me-2"></i> Beranda
            </a>
        </li>
        <li>
            <a href="donasi.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'donasi.php' ? 'active' : '' ?>">
                <i class="bi bi-cash-coin me-2"></i> Donasi & Zakat
            </a>
        </li>
        <li>
            <a href="program.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'program.php' ? 'active' : '' ?>">
                <i class="bi bi-journal-bookmark me-2"></i> Program & Kegiatan
            </a>
        </li>
        <li>
            <a href="berita.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'berita.php' ? 'active' : '' ?>">
                <i class="bi bi-newspaper me-2"></i> Berita
            </a>
        </li>
        <li>
            <a href="galeri.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'galeri.php' ? 'active' : '' ?>">
                <i class="bi bi-images me-2"></i> Galeri
            </a>
        </li>
        <li>
            <a href="kontak.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'kontak.php' ? 'active' : '' ?>">
                <i class="bi bi-telephone me-2"></i> Kontak & Tentang Kami
            </a>
        </li>
        <li>
            <a href="pengaturan.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'pengaturan.php' ? 'active' : '' ?>">
                <i class="bi bi-gear me-2"></i> Pengaturan
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle fs-4 me-2"></i>
            <strong><?= $_SESSION['admin_nama'] ?? 'Admin' ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>