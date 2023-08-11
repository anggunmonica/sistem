<?php
	include 'headerpoli.php';
?>

<div class="container">
	<div class="row">
		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE kode_kriteria='$_GET[kode_kriteria]'");
		$a = mysqli_fetch_assoc($query);
		?>

		<ol class="breadcrumb">
			<li><h4>SUBKRITERIA / <a href="kriteria.php"><?php echo $a['nama_kriteria'] ?></a></h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="subkriteriaaksi.php?aksi=tambah&kode_kriteria=<?php echo $_GET['kode_kriteria'] ?>" class="btn btn-primary">Tambah Data</a>

			<div class="table-responsive">
				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Subkriteria</th>
							<th class="text-center">Nilai</th>
							<th class="text-center">Opsi</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$no = 1;
						$query = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE kode_kriteria='$_GET[kode_kriteria]' ORDER BY kode_subkriteria ASC");
						while ($a = mysqli_fetch_assoc($query)) {
						?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td class="text-center"><?php echo $a['nama_subkriteria'] ?></td>
								<td class="text-center"><?php echo $a['nilai_subkriteria'] ?></td>
								<td class="text-center">
									<a href="subkriteriaaksi.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&kode_subkriteria=<?php echo $a['kode_subkriteria'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
									<a href="subkriteriaproses.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&kode_subkriteria=<?php echo $a['kode_subkriteria'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
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
</div>