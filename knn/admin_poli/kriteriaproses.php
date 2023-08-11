<?php
	include 'headerpoli.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_kriteria = $_POST['kode_kriteria'];
		$nama_kriteria = $_POST['nama_kriteria'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "INSERT INTO kriteria (kode_kriteria, nama_kriteria, keterangan) VALUES ('$kode_kriteria', '$nama_kriteria', '$keterangan')");
		header("location: kriteria.php");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_kriteria = $_POST['kode_kriteria'];
		$nama_kriteria = $_POST['nama_kriteria'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "UPDATE kriteria SET nama_kriteria='$nama_kriteria', keterangan='$keterangan' WHERE kode_kriteria='$kode_kriteria'");
		header("location: kriteria.php");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_kriteria = $_GET['kode_kriteria'];
		mysqli_query($koneksi, "DELETE FROM kriteria WHERE kode_kriteria='$kode_kriteria'");
		mysqli_query($koneksi, "DELETE FROM subkriteria WHERE kode_kriteria='$kode_kriteria'");
		header("location: kriteria.php");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>