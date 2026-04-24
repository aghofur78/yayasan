<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
include '../includes/config.php';

$error = '';
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = $_POST['password'];
    
    $q = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user'");
    if (mysqli_num_rows($q) == 1) {
        $d = mysqli_fetch_assoc($q);
        if (password_verify($pass, $d['password'])) {
            $_SESSION['admin_id'] = $d['id'];
            $_SESSION['admin_nama'] = $d['nama_lengkap'];
            header("Location: index.php");
            exit();
        } else { 
            $error = "Password salah!"; 
        }
    } else { 
        $error = "Username tidak ditemukan!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Masjid Al-Ikhlas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a7a4c 0%, #0f5132 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            border: none;
            border-radius: 15px;
        }
        .login-header {
            background: #1a7a4c;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem 1.5rem;
        }
        .form-control:focus {
            border-color: #1a7a4c;
            box-shadow: 0 0 0 0.25rem rgba(26, 122, 76, 0.25);
        }
        .btn-success {
            background-color: #1a7a4c;
            border-color: #1a7a4c;
        }
        .btn-success:hover {
            background-color: #146c43;
            border-color: #146c43;
        }
        @media (max-width: 576px) {
            .login-header { padding: 1.5rem 1rem; }
            .login-header h4 { font-size: 1.25rem; }
            .card-body { padding: 1.5rem !important; }
        }
    </style>
</head>
<body>
    <div class="card login-card shadow-lg">
        <div class="login-header text-center">
            <i class="bi bi-moon-stars-fill" style="font-size: 3rem;"></i>
            <h4 class="mt-3 mb-1">Admin Panel</h4>
            <p class="mb-0 opacity-75">Yayasan Attaqwa Palem Pertiwi</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <?php if($error) { ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= $error ?></div>
                </div>
            <?php } ?>
            
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" id="password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePass">
                            <i class="bi bi-eye" id="iconPass"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" name="login" class="btn btn-success w-100 py-2 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </button>
                
                <div class="text-center">
                    <a href="../index.php" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left"></i> Kembali ke Website
                    </a>
                </div>
            </form>
        </div>
        
        <div class="card-footer bg-light text-center small text-muted border-0" style="border-radius: 0 0 15px 15px;">
        </div>
    </div>

    <script>
        // Toggle show/hide password
        document.getElementById('togglePass').addEventListener('click', function() {
            const pass = document.getElementById('password');
            const icon = document.getElementById('iconPass');
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                pass.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>