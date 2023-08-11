<?php
	include 'headerpoli.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
	?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>KRITERIA/ Tambah Data</h4></li>
				</ol>
			</div>
		</div>

		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$carikode = mysqli_query($koneksi, "SELECT max(kode_kriteria) FROM kriteria");
		$datakode = mysqli_fetch_row($carikode);
		if ($datakode[0] != null) {
			$nilaikode = substr($datakode[0], 1);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$kode_otomatis = "k" . str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "K01";
		}
		?>

		<div class="container">
			<div class="bootstrap-table">
				<form action="kriteriaproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

					<input type="hidden" name="kode_kriteria" class="form-control" value="<?php echo $kode_otomatis ?>">

					<div class="form-group">
						<label for="nama_kriteria">Nama kriteria</label>
						<input type="text" name="nama_kriteria" class="form-control" placeholder="nama_kriteria">
					</div>

					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<select name="keterangan" class="form-control">
								<option selected>Meningkat</option>
								<option>Menurun</option>
							</select>
					</div>

					<div class="modal-footer">
						<a href="kriteria.php" class="btn btn-primary">Kembali</a>
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
					<li><h4>kriteria/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$data = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE kode_kriteria='" . $_GET['kode_kriteria'] . "'");
				while ($a = mysqli_fetch_array($data)) {
				?>
					<form action="kriteriaproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
						<input type="hidden" name="kode_kriteria" class="form-control" value="<?php echo $a['kode_kriteria'] ?>">
						<div class="form-group">
							<label for="nama_kriteria">Nama kriteria</label>
							<input type="text" name="nama_kriteria" class="form-control" value="<?php echo $a['nama_kriteria'] ?>">
						</div>

						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="<?php echo $a['keterangan'] ?>">
						</div>

						<div class="modal-footer">
							<a href="kriteria.php" class="btn btn-primary">Kembali</a>
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