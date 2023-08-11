<?php
	include 'headerpoli.php';

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
		header("location: user.php");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_akun = $_POST['kode_akun'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$level = $_POST['level'];


		mysqli_query($koneksi, "UPDATE akun SET nama_lengkap='$nama_lengkap', username='$username', password='$password', level='$level' WHERE kode_akun='$kode_akun'");
		header("location: user.php");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_akun = $_GET['kode_akun'];
		mysqli_query($koneksi, "DELETE FROM akun WHERE kode_akun='$kode_akun'");
		header("location: user.php");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>