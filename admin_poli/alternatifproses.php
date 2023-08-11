<?php
	include 'headerpoli.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_alternatif = $_POST['kode_alternatif'];
		$nama_alternatif = $_POST['nama_alternatif'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "INSERT INTO alternatif (kode_alternatif, nama_alternatif, keterangan) VALUES ('$kode_alternatif', '$nama_alternatif', '$keterangan')");
		header("location: alternatif.php");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_alternatif = $_POST['kode_alternatif'];
		$nama_alternatif = $_POST['nama_alternatif'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "UPDATE alternatif SET nama_alternatif='$nama_alternatif', keterangan='$keterangan' WHERE kode_alternatif='$kode_alternatif'");
		header("location: alternatif.php");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_alternatif = $_GET['kode_alternatif'];
		mysqli_query($koneksi, "DELETE FROM alternatif WHERE kode_alternatif='$kode_alternatif'");
		mysqli_query($koneksi, "DELETE FROM training WHERE kode_alternatif='$kode_alternatif'");
		header("location: alternatif.php");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>