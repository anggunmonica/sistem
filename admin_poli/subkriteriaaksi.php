<?php
	include 'headerpoli.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
		?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>SUBKRITERIA/ Tambah Data</h4></li>
				</ol>
			</div>
		</div>

		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$carikode = mysqli_query($koneksi, "SELECT max(kode_subkriteria) FROM subkriteria");
		$datakode = mysqli_fetch_row($carikode);
		if ($datakode[0] != null) {
			$nilaikode = substr($datakode[0], 1);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$kode_otomatis = "S" . str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "S01";
		}
		?>

		<div class="container">
			<div class="bootstrap-table">
				<form action="subkriteriaproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

					<input type="hidden" name="kode_subkriteria" class="form-control" value="<?php echo $kode_otomatis ?>">
					<input type="hidden" name="kode_kriteria" class="form-control" value="<?php echo $_GET['kode_kriteria'] ?>">

					<div class="form-group">
						<label for="nama_subkriteria">Nama subkriteria</label>
						<input type="text" name="nama_subkriteria" class="form-control" placeholder="nama_subkriteria">
					</div>

					<div class="form-group">
						<label for="nilai_subkriteria">Nilai</label>
						<input type="text" name="nilai_subkriteria" class="form-control" placeholder="nilai">
					</div>

					<div class="modal-footer">
						<a href="subkriteria.php?kode_kriteria=<?php echo $_GET['kode_kriteria']?>" class="btn btn-primary">Kembali</a>
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
					<li><h4>Subkriteria/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$data = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE kode_subkriteria='$_GET[kode_subkriteria]'");
				while ($a = mysqli_fetch_array($data)) {
				?>
					<form action="subkriteriaproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

						<input type="hidden" name="kode_subkriteria" class="form-control" value="<?php echo $a['kode_subkriteria'] ?>">

						<input type="hidden" name="kode_kriteria" class="form-control" value="<?php echo $a['kode_kriteria'] ?>">

						<div class="form-group">
							<label>Nama subkriteria</label>
							<input type="text" name="nama_subkriteria" class="form-control" value="<?php echo $a['nama_subkriteria'] ?>">
						</div>

						<div class="form-group">
							<label>Nilai</label>
							<input type="text" name="nilai_subkriteria" class="form-control" value="<?php echo $a['nilai_subkriteria'] ?>">
						</div>

						<div class="modal-footer">
							<a href="subkriteria.php?kode_kriteria=<?php echo $_GET['kode_kriteria']?>" class="btn btn-primary">Kembali</a>
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