<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_masjid";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set timezone Surabaya
date_default_timezone_set('Asia/Jakarta');

// Fungsi ambil jadwal shalat dari API Aladhan
function getJadwalShalat($city = 'Surabaya', $country = 'Indonesia') {
    $url = "https://api.aladhan.com/v1/timingsByCity?city=$city&country=$country&method=20";
    $data = @file_get_contents($url);
    return json_decode($data, true);
}
?>