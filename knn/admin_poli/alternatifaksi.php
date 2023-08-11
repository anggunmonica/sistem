<?php
	include 'headerpoli.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
	?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>ALTERNATIF/ Tambah Data</h4></li>
				</ol>
			</div>
		</div>

		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$carikode = mysqli_query($koneksi, "SELECT max(kode_alternatif) FROM alternatif");
		$datakode = mysqli_fetch_row($carikode);
		if ($datakode[0] != null) {
			$nilaikode = substr($datakode[0], 1);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$kode_otomatis = "A" . str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "A01";
		}
		?>

		<div class="container">
			<div class="bootstrap-table">
				<form action="alternatifproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

					<input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $kode_otomatis ?>">

					<div class="form-group">
						<label for="nama_alternatif">Nama Alternatif</label>
						<input type="text" name="nama_alternatif" class="form-control" placeholder="nama_alternatif">
					</div>

					<div class="form-group">
							<label>Keterangan</label>
							<select name="keterangan" class="form-control">
								<option selected>Meningkat</option>
								<option>Menurun</option>
							</select>
					</div>

					<div class="modal-footer">
						<a href="alternatif.php" class="btn btn-primary">Kembali</a>
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
					<li><h4>ALTERNATIF/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$data = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif='" . $_GET['kode_alternatif'] . "'");
				while ($a = mysqli_fetch_array($data)) {
				?>
					<form action="alternatifproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
						<input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $a['kode_alternatif'] ?>">
						<div class="form-group">
							<label for="nama_alternatif">Nama Alternatif</label>
							<input type="text" name="nama_alternatif" class="form-control" value="<?php echo $a['nama_alternatif'] ?>">
						</div>

						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="<?php echo $a['keterangan'] ?>">
						</div>

						<div class="modal-footer">
							<a href="alternatif.php" class="btn btn-primary">Kembali</a>
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