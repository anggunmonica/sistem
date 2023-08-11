<?php
	include 'headerpoli.php';
?>

<div class="container">
	<div class="row">
		<?php
		// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
		$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

		$query = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif='$_GET[kode_alternatif]'");
		$a = mysqli_fetch_assoc($query);
		?>

		<ol class="breadcrumb">
			<li><h4>TRAINING / <a href="alternatif.php"><?php echo $a['nama_alternatif'] ?></a></h4></li>
		</ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			<a href="trainingaksi.php?aksi=tambah&kode_alternatif=<?php echo $_GET['kode_alternatif'] ?>" class="btn btn-primary">Tambah Data</a>

			<div class="table-responsive">
				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Alternatif</th>
							
							<?php
							//untuk menampilkan data kriteria
							$data=mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
							while ($a=mysqli_fetch_array($data)) {
								echo "<th class='text-center'>$a[nama_kriteria]</th>";
							}
							?>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Opsi</th>

						</tr>
					</thead>

					<tbody>
						<?php
						//untuk menampilkan data alternatif
						$no = 1;
						$data = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE kode_alternatif='$_GET[kode_alternatif]' ORDER BY kode_alternatif ASC");
						while ($alternatif = mysqli_fetch_assoc($data)) {
							$nomor = $no++;
							$kode = $alternatif['kode_alternatif'];
							$nama = $alternatif['nama_alternatif'];

							echo "<tr>
									<td class='text-center'>$nomor</td>";

							echo "<td class='text-center'>$nama</td>";
							//untuk menampilkan nilai sub berdasarkan kriteria
								$query1 = mysqli_query($koneksi, "SELECT a.nilai_subkriteria as sub FROM subkriteria a, training b WHERE b.kode_alternatif='$kode' AND a.kode_subkriteria=b.kode_subkriteria ORDER BY b.kode_kriteria");

							while ($result1 = mysqli_fetch_array($query1)) {
								echo "<td class='text-center'>$result1[sub]</td>";
							}?>

							<td class="text-center"><?php echo $alternatif['keterangan'] ?></td>

							<td class="text-center">
								<a href="trainingaksi.php?kode_alternatif=<?php echo $alternatif['kode_alternatif'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
								
								<a href="trainingproses.php?kode_alternatif=<?php echo $alternatif['kode_kriteria'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
							</td>
							
							</tr>
						<?php	
							echo "</tr>";
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