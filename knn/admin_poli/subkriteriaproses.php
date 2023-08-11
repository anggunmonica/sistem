<?php
	include 'headerpoli.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_subkriteria = $_POST['kode_subkriteria'];
		$nama_subkriteria = $_POST['nama_subkriteria'];
		$kode_kriteria = $_POST['kode_kriteria'];
		$nilai_subkriteria = $_POST['nilai_subkriteria'];

		$query = "INSERT INTO subkriteria (kode_subkriteria, nama_subkriteria, kode_kriteria, nilai_subkriteria) VALUES ('$kode_subkriteria', '$nama_subkriteria', '$kode_kriteria', '$nilai_subkriteria')";
		mysqli_query($koneksi, $query);
		header("location: subkriteria.php?kode_kriteria=$_POST[kode_kriteria]");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_subkriteria = $_POST['kode_subkriteria'];
		$nama_subkriteria = $_POST['nama_subkriteria'];
		$kode_kriteria = $_POST['kode_kriteria'];
		$nilai_subkriteria = $_POST['nilai_subkriteria'];

		$query = "UPDATE subkriteria SET nama_subkriteria='$nama_subkriteria', kode_kriteria='$kode_kriteria', nilai_subkriteria='$nilai_subkriteria' WHERE kode_subkriteria='$kode_subkriteria'";
		mysqli_query($koneksi, $query);
		header("location: subkriteria.php?kode_kriteria=$_POST[kode_kriteria]");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_subkriteria = $_GET['kode_subkriteria'];
		$kode_kriteria = $_GET['kode_kriteria'];
		$query = "DELETE FROM subkriteria WHERE kode_subkriteria='$kode_subkriteria'";
		mysqli_query($koneksi, $query);
		header("location: subkriteria.php?kode_kriteria=$_GET[kode_kriteria]");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>