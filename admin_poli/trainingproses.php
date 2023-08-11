<?php
	include 'headerpoli.php';

// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['proses'])) {
	if ($_GET['proses'] == 'prosestambah') {
		$kode_alternatif = $_POST['kode_alternatif'];
		$keterangan = $_POST['keterangan'];

		$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");
		while ($baris = mysqli_fetch_array($hasil)) {
			$idk = $baris['kode_kriteria'];
			$ids = $_POST[$idk];

			$query1 = "INSERT INTO training(kode_alternatif, kode_kriteria, kode_subkriteria) VALUES ('$kode_alternatif','$idk','$ids')";
			$result1 = mysqli_query($koneksi, $query1);
		} 

		mysqli_query($koneksi, "UPDATE alternatif SET keterangan='$keterangan' WHERE kode_alternatif='$kode_alternatif'");
		header("location:training.php?kode_alternatif=$_POST[kode_alternatif]");

	} elseif ($_GET['proses'] == 'prosesubah') {
		$kode_training = $_POST['kode_training'];
		$kode_alternatif = $_GET['kode_alternatif'];
		$keterangan = $_POST['keterangan'];

		$query2  = "DELETE FROM training WHERE kode_training='$kode_training'";
		mysqli_query($koneksi, $query2);

		$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");
		while ($baris = mysqli_fetch_array($hasil)) {
			$idk = $baris['kode_kriteria'];
			$ids = $_POST[$idk];

			$query1 = "INSERT INTO training(kode_alternatif, kode_kriteria, kode_subkriteria) VALUES ('$kode_alternatif','$idk','$ids')";
			$result1 = mysqli_query($koneksi, $query1);
		}
		mysqli_query($koneksi, "UPDATE alternatif SET keterangan='$keterangan' WHERE kode_alternatif='$kode_alternatif'");
		header("location:training.php?kode_alternatif=$_POST[kode_alternatif]");

	} elseif ($_GET['proses'] == 'proseshapus') {
		$kode_alternatif = $_GET['kode_alternatif'];
		$kode_training = $_GET['kode_training'];

		$query3 = "DELETE FROM training WHERE kode_alternatif='$kode_alternatif' AND kode_training='$kode_training'";
		mysqli_query($koneksi, $query3);
		header("location:training.php?kode_alternatif=$_GET[kode_alternatif]");
	}
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>