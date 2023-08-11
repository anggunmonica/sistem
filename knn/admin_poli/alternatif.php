<?php
	include 'headerpoli.php';
?>

<div class="container">
	<div class="row">
		<ol class="breadcrumb">
			<li><h4>ALTERNATIF</h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="alternatifaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

			<div class="table-responsive">

				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Alternatif</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Training</th>
							<th class="text-center">Opsi</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$no = 1;
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							$query = mysqli_query($koneksi, "SELECT * FROM alternatif");
							while ($a = mysqli_fetch_assoc($query)) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td class="text-center"><?php echo $a['nama_alternatif'] ?></td>
							<td class="text-center"><?php echo $a['keterangan']?>
							</td>

							<td class="text-center">
								<a href="training.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?> &aksi=training" class="btn btn-success">Training</a>
							</td>
							
							<td class="text-center">
								<a href="alternatifaksi.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
								<a href="alternatifproses.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
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