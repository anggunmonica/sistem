<?php
	// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
	$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");


	$kode_alternatif=$_POST['kode_alternatif'];
	$nama_alternatif=$_POST['nama_alternatif'];
	$nilaik = $_POST['nilaik'];

	// ambil nomor urut terbesar
	$nomor = mysqli_query($koneksi, "SELECT max(nomor_urut) as max from alternatif where kode_alternatif='$alternatif';");
	$nomormax =mysqli_fetch_array($nomor);
	$maksimum = $nomormax['max'];

	//data uji 
	$testing = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria AND ")
?>