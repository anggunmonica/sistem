<?php
	include 'headerpoli.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>TRAINING/ Tambah Data</h4></li>
				</ol>
			</div>

			<div class="panel panel-container">
				<div class="bootstrap-table">
					<form action="trainingproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">
						<input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $_GET['kode_alternatif'] ?>">

						<?php
						$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
						$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");

						while ($baris = mysqli_fetch_array($hasil)) {
							$idk = $baris['kode_kriteria'];
							$labelk = $baris['nama_kriteria'];

							echo "<div class='form-group'>
								<label>".$labelk."</label>";
								
							echo "<select name=".$idk." class=form-control>";
							$hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE kode_kriteria='$idk' ORDER BY nilai_subkriteria DESC");
							while ($baris2 = mysqli_fetch_array($hasil2)) {
								echo "<option  selected value='".$baris2['kode_subkriteria']."'>".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
							}
							echo "</select></div>";
						}
						?>

						<div class="form-group">
							<label>Keterangan</label>
							<select name="keterangan" class="form-control">
								<option selected>Meningkat</option>
								<option>Menurun</option>
							</select>
						</div>

						<div class="modal-footer">
							<a href="training.php?kode_alternatif=<?php echo $_GET['kode_alternatif']?>" class="btn btn-primary">Kembali</a>
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
					<li><h4>TRAINING/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">

					<form action="trainingproses.php?proses=prosesubah&aksi=ubah" method="post" enctype="multipart/form-data">
				
					<input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $_GET['kode_alternatif'] ?>">

					<?php
					$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
					$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");

					while ($baris = mysqli_fetch_array($hasil)) {
						$idk = $baris['kode_kriteria'];
						$labelk = $baris['nama_kriteria'];
						$kode_alternatif = $_GET['kode_alternatif'];

						//memanggil data training
						$hasil3 = mysqli_query($koneksi, "SELECT * FROM training WHERE kode_kriteria='$idk' AND kode_alternatif='$kode_alternatif'");
						$result3 = mysqli_fetch_array($hasil3);
						$sub = $result3['kode_subkriteria'];

						echo "<div class='form-group'>
							<label>$labelk</label>
							<select name='$idk' class='form-control'>";

						$hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE kode_kriteria='$idk' ORDER BY nilai_subkriteria DESC");
						while ($baris2 = mysqli_fetch_array($hasil2)) {
							$selected = ($sub == $baris2['kode_subkriteria']) ? 'selected' : '';
							echo "<option value='".$baris2['kode_subkriteria']."' $selected>".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
						}
						echo "</select></div>";
					}

					// Fetching and displaying the existing keterangan value for the selected alternatif
					$hasil = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif='$_GET[kode_alternatif]'");
					$baris = mysqli_fetch_array($hasil);
					$keterangan = $baris['keterangan'];
					?>

					<div class="form-group">
						<label>Keterangan</label>
						<select name="keterangan" class="form-control">
							<option <?php if ($keterangan == 'Meningkat') echo 'selected'; ?>>Meningkat</option>
							<option <?php if ($keterangan == 'Menurun') echo 'selected'; ?>>Menurun</option>
						</select>
					</div>

					<div class="modal-footer">
						<a href="training.php?kode_alternatif=<?php echo $_GET['kode_alternatif']?>" class="btn btn-primary">Kembali</a>
						<input type="submit" class="btn btn-success" value="Ubah">
					</div>
				</form>
				<?php
				mysqli_close($koneksi);
				?>
			</div>
		</div>

<?php
	}
}
?>