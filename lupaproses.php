<?php
	include 'index.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_akun = $_POST['kode_akun'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$level = $_POST['level'];


		mysqli_query($koneksi, "INSERT INTO akun (kode_akun, nama_lengkap, username, password, level) VALUES ('$kode_akun', '$nama_lengkap', '$username', '$password', '$level')");
		header("location: index.php");

	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>