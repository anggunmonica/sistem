<?php
	include 'headerpoli.php';
?>

<div class="container">
	<div class="row">
		<ol class="breadcrumb">
			<li><h4>KRITERIA</h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="kriteriaaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

			<div class="table-responsive">

				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Kriteria</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Subkriteria</th>
							<th class="text-center">Opsi</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$no = 1;
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							$query = mysqli_query($koneksi, "SELECT * FROM kriteria");
							while ($a = mysqli_fetch_assoc($query)) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td class="text-center"><?php echo $a['nama_kriteria'] ?></td>
							<td class="text-center"><?php echo $a['keterangan']?>
							</td>

							<td class="text-center">
								<a href="subkriteria.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?> &aksi=training" class="btn btn-success">Subkriteria</a>
							</td>
							
							<td class="text-center">
								<a href="kriteriaaksi.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
								<a href="kriteriaproses.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
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