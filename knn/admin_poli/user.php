<?php
	include 'headerpoli.php';
?>

<div class="container">
	<div class="row">
		<ol class="breadcrumb">
			<li><h4>MANAJEMEN USER</h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="useraksi.php?aksi=tambah" class="btn btn-primary">Tambah User</a>


		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Username</th>
						<th class="text-center">password</th>
						<th class="text-center">Level</th>
						<th class="text-center">Opsi</th>
					</tr>
				</thead>

				<tbody>

					<?php
							$no = 1;
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							$query = mysqli_query($koneksi, "SELECT * FROM akun");
							while ($a = mysqli_fetch_assoc($query)) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td class="text-center"><?php echo $a['nama_lengkap'] ?></td>
							<td class="text-center"><?php echo $a['username'] ?></td>
							<td class="text-center"><?php echo $a['password']?></td>
							<td class="text-center"><?php echo $a['level'] ?></td>

							<td class="text-center">
								<a href="useraksi.php?kode_akun=<?php echo $a['kode_akun'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
								<a href="userproses.php?kode_akun=<?php echo $a['kode_akun'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
							</td>
						</tr>
						<?php
							}
							// Menutup koneksi ke database
							mysqli_close($koneksi);
						?>

				</tbody>
			</table>
		</div>
	</div>

</div>