<?php
include 'header.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_dataset = $_POST['kode_dataset'];
		$nama_penyakit = $_POST['nama_penyakit'];
		$jumlah_2020 = $_POST['jumlah_2020'];
		$jumlah_2021 = $_POST['jumlah_2021'];
		$jumlah_2022 = $_POST['jumlah_2022'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "INSERT INTO dataset (kode_dataset, nama_penyakit, jumlah_2020, jumlah_2021, jumlah_2022, keterangan) VALUES ('$kode_dataset', '$nama_penyakit', '$jumlah_2020', '$jumlah_2021', '$jumlah_2022', '$keterangan'))");
		header("location: dataset.php");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_dataset = $_POST['kode_dataset'];
		$nama_penyakit = $_POST['nama_penyakit'];
		$jumlah_2020 = $_POST['jumlah_2020'];
		$jumlah_2021 = $_POST['jumlah_2021'];
		$jumlah_2022 = $_POST['jumlah_2022'];
		$keterangan = $_POST['keterangan'];

		mysqli_query($koneksi, "UPDATE dataset SET nama_penyakit='$nama_penyakit', jumlah_2020='$jumlah_2020', jumlah_2021='$jumlah_2021', jumlah_2022='$jumlah_2022', keterangan='$keterangan' WHERE kode_dataset='$kode_dataset'");
		header("location: dataset.php");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_dataset = $_GET['kode_dataset'];
		mysqli_query($koneksi, "DELETE FROM dataset WHERE kode_dataset='$kode_dataset'");
		header("location: dataset.php");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>