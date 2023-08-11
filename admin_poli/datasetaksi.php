<?php
include 'header.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
		?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>DATASET/ Tambah Data</h4></li>
				</ol>
			</div>
		</div>

		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$carikode = mysqli_query($koneksi, "SELECT max(kode_dataset) FROM dataset");
		$datakode = mysqli_fetch_row($carikode);
		if ($datakode[0] != null) {
			$nilaikode = substr($datakode[0], 1);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$kode_otomatis = "D" . str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "D01";
		}
		?>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<form action="datasetproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

					<input type="hidden" name="kode_dataset" class="form-control" value="<?php echo $kode_otomatis ?>">
					<input type="hidden" name="kode_dataset" class="form-control" value="<?php echo $_GET['kode_dataset'] ?>">

					<div class="form-group">
						<label for="nama_penyakit">Nama Penyakit</label>
						<input type="text" name="nama_penyakit" class="form-control" placeholder="nama_penyakit">
					</div>

					<div class="form-group">
						<label for="jumlah_2020">Jumlah Pasien 2020</label>
						<input type="text" name="jumlah_2020" class="form-control" placeholder="jumlah_2020">
					</div>

					<div class="form-group">
						<label for="jumlah_2021">Jumlah Pasien 2021</label>
						<input type="text" name="jumlah_2021" class="form-control" placeholder="jumlah_2021">
					</div>

					<div class="form-group">
						<label for="jumlah_2022">Jumlah Pasien 2022</label>
						<input type="text" name="jumlah_2022" class="form-control" placeholder="jumlah_2022">
					</div>

					<div class="form-group">
						<label for="nama_subkriteria">Keterangan</label>
						<input type="text" name="keterangan" class="form-control" placeholder="keterangan">
					</div>

					<div class="modal-footer">
						<a href="dataset.php?kode_dataset=<?php echo $_GET['kode_dataset']?>" class="btn btn-primary">Kembali</a>
						<input type="submit" class="btn btn-success" value="Simpan">
					</div>

				</form>
			</div>
		</div>

	<?php
	} elseif ($_GET['aksi'] == 'ubah') {
	?>

		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>DATASET/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$data = mysqli_query($koneksi, "SELECT * FROM dataset WHERE kode_datset='$_GET[kode_dataset]'");
				while ($a = mysqli_fetch_array($data)) {
				?>
					<form action="datasetproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

						<input type="hidden" name="kode_dataset" class="form-control" value="<?php echo $a['kode_dataset'] ?>">

						<div class="form-group">
							<label>Nama Penyakit</label>
							<input type="text" name="nama_penyakit" class="form-control" value="<?php echo $a['nama_penyakit'] ?>">
						</div>

						<div class="form-group">
							<label>Jumlah Pasien Tahun 2020</label>
							<input type="text" name="jumlah_2020" class="form-control" value="<?php echo $a['jumlah_2020'] ?>">
						</div>

						<div class="form-group">
							<label>Jumlah Pasien Tahun 2021</label>
							<input type="text" name="jumlah_2021" class="form-control" value="<?php echo $a['jumlah_2021'] ?>">
						</div>

						<div class="form-group">
							<label>Jumlah Pasien Tahun 2022</label>
							<input type="text" name="jumlah_2022" class="form-control" value="<?php echo $a['jumlah_2022'] ?>">
						</div>

						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" name="keterangan" class="form-control" value="<?php echo $a['keterangan'] ?>">
						</div>

						<div class="modal-footer">
							<a href="dataset.php?kode_dataset=<?php echo $_GET['kode_dataset']?>" class="btn btn-primary">Kembali</a>
							<input type="submit" class="btn btn-success" value="Ubah">
						</div>
					</form>
				<?php
				}
				mysqli_close($koneksi);
				?>
			</div>
		</div>

	<?php
	}
}

?>