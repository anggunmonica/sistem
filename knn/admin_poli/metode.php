<?php
	include 'headerpoli.php';
	// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
	$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");


	if (isset($_GET['aksi'])) {
		if ($_GET['aksi']=='tambah') {
		$kode_alternatif=$_POST['kode_alternatif'];
		$nama_alternatif=$_POST['nama_alternatif'];

		if (empty($_POST['kode_alternatif'])) {
		$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");
		while ($baris = mysqli_fetch_array($hasil)) {
			$idk = $baris['kode_kriteria'];
			$ids = $_POST[$idk];

			$query1 = "INSERT INTO testing(kode_alternatif, nama_alternatif, kode_kriteria, nilai_testing) VALUES ('".$kode_alternatif."','".$nama_alternatif."','".$idk."','".$ids."')";
			$result1 = mysqli_query($koneksi, $query1);
		} 

		header("location:metode.php?kode_alternatif=$_POST[kode_alternatif]&nama_alternatif=$_POST[nama_alternatif]");

		}else{
			$kode_alternatif = $_POST['kode_alternatif'];
			$nama_alternatif = $_POST['nama_alternatif'];
 
 			$query2  = "DELETE FROM testing WHERE kode_alternatif='".$_POST['$kode_alternatif']."'";
			$result2 = mysqli_query($koneksi, $query2);

			$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");
			while ($baris = mysqli_fetch_array($hasil)) {
			$idk = $baris['kode_kriteria'];
			$ids = $_POST[$idk];

			$query1 = "INSERT INTO testing(kode_alternatif, nama_alternatif, kode_kriteria, nilai_testing) VALUES ('".$kode_alternatif."','".$nama_alternatif."','".$idk."','".$ids."')";
			$result1 = mysqli_query($koneksi, $query1);
		} 
		header("location:metode.php?kode_alternatif=$_POST[kode_alternatif]&nama_alternatif=$_POST[nama_alternatif]");

		}
	}elseif ($_GET['aksi']=='simpanhasil') {
		$nama_alternatif = $_POST['nama_alternatif'];
		$keterangan = $_POST['keterangan'];

		$query1 = "INSERT INTO hasil(nama_alternatif, keterangan) VALUES ('".$nama_alternatif."','".$keterangan."')";
		$result1 = mysqli_query($koneksi, $query1);

		header("location:hasil.php");
	}
}
?>

<div class="container">
	<div class="row">
		<ol class="breadcrumb"><h4>Metode KNN</h4></ol>
	</div>

	<div class="panel panel-container">
		<div class="bootstrap-table">
			
		<form action="metode.php?aksi=tambah" method="post" enctype="multipart/form-data">

			<input type="hidden" class="form-control" name="kode_alternatif" value="A01">


				<label><h4>Masukkan Data Testing</h4></label>
			<div class="form-group">
				<label>Nama Alternatif</label>
				<input type="text" class="form-control" name="nama_alternatif" placeholder="Nama Alternatif"
				>
			</div>

			<?php
				$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");
				$hasil = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria");

				while ($baris = mysqli_fetch_array($hasil)) {
				$idk = $baris['kode_kriteria'];
				$labelk = $baris['nama_kriteria'];

				echo "<div class='form-group'>
					<label>$labelk</label>
					<select name='$idk' class='form-control'>";

				$hasil2 = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE kode_kriteria='$idk' ORDER BY nilai_subkriteria DESC");
							while ($baris2 = mysqli_fetch_array($hasil2)) {
								echo "<option selected value='".$baris2['nilai_subkriteria']."'>".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
							}
							echo "</select></div>";
						}
						?>

						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" name="proses" value="Proses Metode">
						</div>
			</form>	

			<hr>
			<br>

			<h4>Data Training</h4>
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
							

						</tr>
					</thead>

					<tbody>
						<?php
						//untuk menampilkan data alternatif
						$no = 1;
						$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY kode_alternatif ASC");
						while ($alternatif = mysqli_fetch_assoc($data)) {
							$nomor = $no++;
							$kode = $alternatif['kode_alternatif'];
							$nama = $alternatif['nama_alternatif'];

							echo "<tr>
									<td class='text-center'>$nomor</td>";

							echo "<td>$nama</td>";
							//untuk menampilkan nilai sub berdasarkan kriteria
								$query1 = mysqli_query($koneksi, "SELECT a.nilai_subkriteria as sub FROM subkriteria a, training b WHERE b.kode_alternatif='$kode' AND a.kode_subkriteria=b.kode_subkriteria ORDER BY b.kode_kriteria");

							while ($result1 = mysqli_fetch_array($query1)) {
								echo "<td class='text-center'>$result1[sub]</td>";
							}?>

							<td class="text-center"><?php echo $alternatif['keterangan'] ?></td>

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
			<br>


			<h4>Data Testing</h4>
			<div class="table-responsive">
				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Alternatif</th>
							
							<?php
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							//untuk menampilkan data kriteria
							$data=mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
							while ($alternatif=mysqli_fetch_array($data)) {
							echo "<th class='text-center'>$alternatif[nama_kriteria]</th>";
								}
							?>
							<th class="text-center">Keterangan</th>
							
					</thead>
					<tbody>
						<?php
						// Menghubungkan ke database 
						$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

						//untuk menampilkan data alternatif
						$no = 1;
						$data = mysqli_query($koneksi, "SELECT * FROM testing WHERE kode_alternatif='$_GET[kode_alternatif]' limit 1");
						while ($alternatif = mysqli_fetch_array($data)) {
							$nomor = $no++;
							$kode = $alternatif['kode_alternatif'];
							$nama = $alternatif['nama_alternatif'];

							echo "<tr>
									<td class='text-center'>$nomor</td>";

							echo "<td>$nama</td>";
							//untuk menampilkan nilai sub berdasarkan kriteria
								$query1 = mysqli_query($koneksi, "SELECT nilai_testing as sub FROM testing WHERE kode_alternatif='$kode' ORDER BY kode_kriteria");

							while ($result1 = mysqli_fetch_array($query1)) {
								echo "<td class='text-center'>$result1[sub]</td>";
							}?>

							<td class="text-center">?</td>

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
			<br>


			<h4>Eucliden Distance</h4>
			<div class="table-responsive">
				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Alternatif</th>
							
							<?php
							// Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
							$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

							//untuk menampilkan data kriteria
							$data=mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode_kriteria ASC");
							while ($a=mysqli_fetch_array($data)) {
								echo "<th class='text-center'>$a[nama_kriteria]</th>";
							}
							?>
							<th class="text-center">Distance</th>
							

						</tr>
					</thead>

					<tbody>
						<?php
						//untuk menampilkan data alternatif
						$no = 1;
						$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY kode_alternatif ASC");
						while ($alternatif = mysqli_fetch_assoc($data)) {
							$sum = 0.0;
							$nomor = $no++;
							$kode = $alternatif['kode_alternatif'];
							$nama = $alternatif['nama_alternatif'];

							echo "<tr>
									<td class='text-center'>$nomor</td>";

							echo "<td>$nama</td>";
							//untuk menampilkan nilai subtraining berdasarkan kriteria
							$query1 = mysqli_query($koneksi, "SELECT a.nilai_subkriteria as subtraining FROM subkriteria a, training b WHERE b.kode_alternatif='$kode' AND a.kode_subkriteria=b.kode_subkriteria ORDER BY b.kode_kriteria");
							while ($result1 = mysqli_fetch_array($query1)) {
								$val1 = $result1['subtraining'];

							//untuk menampilkan nilai subtesting berdasarkan kriteria
							$query2 = mysqli_query($koneksi, "SELECT nilai_testing as subtesting FROM testing WHERE kode_alternatif='$kode' ORDER BY kode_kriteria");
							while ($result2 = mysqli_fetch_array($query2)) {
								$val2 = $result2['subtesting'];
							}	

							//perhitungan rumus euclidean distance
							$val = pow(($val2-$val1),2);
							$sum += ($val);
							$akr = sqrt($sum);
							$akar = number_format($akr,2);
							echo "<td class='text-center'>$val</td>";

						}

							echo "<td class='text-center'>$akar</td>";

							mysqli_query($koneksi, "UPDATE alternatif SET distance='$akr' WHERE kode_alternatif='$alternatif[kode_alternatif]'");
		
					?>

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
			<br>

			<?php
			// Rangking
			$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

				$rank = 1;
				$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY distance ASC");
				while ($alternatif = mysqli_fetch_array($data)) {

				mysqli_query($koneksi, "UPDATE alternatif SET rangking='$rank' WHERE kode_alternatif='$alternatif[kode_alternatif]'");
				$rank++;

				}
			?>

			<?php
			// Pengelompokan
			$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

				$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY distance ASC");
				while ($alternatif = mysqli_fetch_array($data)) {

				if ($alternatif['rangking']<=10){
					mysqli_query($koneksi, "UPDATE alternatif SET pilihan='Ya' WHERE kode_alternatif='$alternatif[kode_alternatif]'");
				}else{
					mysqli_query($koneksi, "UPDATE alternatif SET rangking='Tidak' WHERE kode_alternatif='$alternatif[kode_alternatif]'");
				}
				
			}
		?>



			<h4>Klasifikasi K-Nearest Neightbor</h4>
			<div class="table-responsive">
				<table class="table tabel-bordered" border="1">
					<thead>
						<tr>
							<th class="text-center">Kode</th>
							<th class="text-center">Nama Alternatif</th>							
							<th class="text-center">Distance</th>
							<th class="text-center">Rangking</th>
							<th class="text-center">Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<?php
						//untuk menampilkan data alternatif
						$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY rangking ASC");
						while ($alternatif = mysqli_fetch_assoc($data)) {
						?>
						<td class="text-center"><?php echo $alternatif['kode_alternatif'] ?></td>
						<td class="text-center"><?php echo $alternatif['nama_alternatif'] ?></td>
						<td class="text-center"><?php echo number_format($alternatif['distance'],2) ?></td>
						<td class="text-center"><?php echo $alternatif['rangking'] ?></td>
						<td class="text-center"><?php echo $alternatif['keterangan'] ?></td>


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
			<br>


		</div>
	</div>
</div>