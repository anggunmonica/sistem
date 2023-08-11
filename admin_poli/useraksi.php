<?php
	include 'headerpoli.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == 'tambah') {
	?>
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li><h4>USER/ Tambah Data</h4></li>
				</ol>
			</div>
		</div>

		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$carikode = mysqli_query($koneksi, "SELECT max(kode_akun) FROM akun");
		$datakode = mysqli_fetch_row($carikode);
		if ($datakode[0] != null) {
			$nilaikode = substr($datakode[0], 1);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$kode_otomatis = "adm" . str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "adm01";
		}
		?>

		<div class="container">
			<div class="bootstrap-table">
				<form action="userproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

					<input type="hidden" name="kode_akun" class="form-control" value="<?php echo $kode_otomatis ?>">

					<div class="form-group">
						<label for="nama_lengkap">Nama Lengkap</label>
						<input type="text" name="nama_lengkap" class="form-control" placeholder="nama_lengkap">
					</div>

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" placeholder="username">
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" name="password" class="form-control" placeholder="password">
					</div>

					<div class="form-group">
						<label for="level">Level</label>
						<input type="text" name="level" class="form-control" placeholder="level">
					</div>

					<div class="modal-footer">
						<a href="user.php" class="btn btn-primary">Kembali</a>
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
					<li><h4>USER/ Ubah Data</h4></li>
				</ol>
			</div>
		</div>

		<div class="panel panel-container">
			<div class="bootstrap-table">
				<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$data = mysqli_query($koneksi, "SELECT * FROM akun WHERE kode_akun='" . $_GET['kode_akun'] . "'");
				while ($a = mysqli_fetch_array($data)) {
				?>
					<form action="userproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
						<input type="hidden" name="kode_akun" class="form-control" value="<?php echo $a['kode_akun'] ?>">
						
						<div class="form-group">
							<label for="nama_lengkap">Nama Lengkap</label>
							<input type="text" name="nama_lengkap" class="form-control" value="<?php echo $a['nama_lengkap'] ?>">
						</div>

						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" value="<?php echo $a['username'] ?>">
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" name="password" class="form-control" value="<?php echo $a['password']?>">
						</div>

						<div class="form-group">
							<label for="level">Level</label>
							<input type="text" name="level" class="form-control" value="<?php echo $a['level'] ?>">
						</div>

						<div class="modal-footer">
							<a href="user.php" class="btn btn-primary">Kembali</a>
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