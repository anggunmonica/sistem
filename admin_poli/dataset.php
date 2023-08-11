<?php
	include 'header.php';
?>

<div class="container">
	<div class="row">
		<ol class="breadcrumb">
			<li><h4>DATASET</h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="datasetaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

			<div class="table-responsive">

				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Penyakit</th>
							<th class="text-center">Jumlah Pasien Tahun 2020</th>
							<th class="text-center">Jumlah Pasien Tahun 2021</th>
							<th class="text-center">Jumlah Pasien Tahun 2022</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Opsi</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$no = 1;
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							$query = mysqli_query($koneksi, "SELECT * FROM dataset");
							while ($a = mysqli_fetch_assoc($query)) {
						?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td class="text-center"><?php echo $a['nama_penyakit'] ?></td>
							<td class="text-center"><?php echo $a['jumlah_2020']?>
							<td class="text-center"><?php echo $a['jumlah_2021'] ?></td>
							<td class="text-center"><?php echo $a['jumlah_2022']?>
							<td class="text-center"><?php echo $a['keterangan'] ?></td>
							</td>

							<td class="text-center">
								<a href="datasetaksi.php?kode_datset=<?php echo $a['kode_dataset'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
								<a href="datasetproses.php?kode_dataset=<?php echo $a['kode_dataset'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
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
