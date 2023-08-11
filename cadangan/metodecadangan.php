<?php
	include 'header.php';
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

<?php

			$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Initialize $nilaik with a default value if not set
$nilaik = 1;

if (isset($_POST['proses'])) {
    // Get the selected value of K
    $nilaik = (int)$_POST['nilaik'];

    // Validate the input to ensure it is within the desired range
    if ($nilaik < 1 || $nilaik > 5) {
        // For simplicity, set the default value to 1 if the input is invalid.
        $nilaik = 1;
    }
}

?>

<h4>Klasifikasi K-Nearest Neighbor</h4>
<form method="post">
    <div class="table-responsive">
        <select class="form-control select2" name="nilaik" required="">
            <option value="" disabled selected>Pilih Nilai K</option>
            <option <?php if ($nilaik == 1) echo 'selected'; ?>>1</option>
            <option <?php if ($nilaik == 2) echo 'selected'; ?>>2</option>
            <option <?php if ($nilaik == 3) echo 'selected'; ?>>3</option>
            <option <?php if ($nilaik == 4) echo 'selected'; ?>>4</option>
            <option <?php if ($nilaik == 5) echo 'selected'; ?>>5</option>
        </select>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="proses" value="Proses Metode">
        </div>
    </div>
</form>
<br>
<table class="table tabel-bordered" border="1">
    <thead>
        <tr>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama Penyakit</th>
            <th class="text-center">Distance</th>
            <th class="text-center">Rangking</th>
            <th class="text-center">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Assuming you have a column named "rangking" in the "alternatif" table.
        // Assuming you have a column named "keterangan" in the "alternatif" table.
        // Assuming you have a column named "distance" in the "alternatif" table.

        if (isset($_POST['proses'])) {
            // To prevent SQL injection, we'll use prepared statements
            $stmt = mysqli_prepare($koneksi, "SELECT * FROM alternatif ORDER BY rangking ASC LIMIT ?");
            mysqli_stmt_bind_param($stmt, "i", $nilaik);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($alternatif = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='text-center'>" . $alternatif['kode_alternatif'] . "</td>";
                echo "<td class='text-center'>" . $alternatif['nama_alternatif'] . "</td>";
                echo "<td class='text-center'>" . number_format($alternatif['distance'], 2) . "</td>";
                echo "<td class='text-center'>" . $alternatif['rangking'] . "</td>";
                echo "<td class='text-center'>" . $alternatif['keterangan'] . "</td>";
                echo "</tr>";
            }
        }
        // Close the prepared statement
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
        ?>
    </tbody>
</table>

<?php
// Close the database connection
mysqli_close($koneksi);
?>


			<?php
			//Kesimpulan
			$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

				$data = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY kode_alternatif ASC");
				while ($alternatif = mysqli_fetch_array($data)) {

				$data1 = mysqli_query($koneksi, "SELECT count(*) as jmllayak FROM alternatif WHERE pilihan='Ya' and keterangan='Lengkap'");
				$alternatif1 = mysqli_fetch_array($data1);

				$data2 = mysqli_query($koneksi, "SELECT count(*) as jmltidaklayak FROM alternatif WHERE pilihan='Ya' and keterangan='Tidak Lengkap'");
				$alternatif2 = mysqli_fetch_array($data2);

				$jmllayak = $alternatif1['jmllayak'];
				$jmltidaklayak = $alternatif2['jmltidaklayak'];
				if ($jmllayak > $jmltidaklayak) {
					
					$hasil = 'LAYAK';
					$hasil1 = 'kategori mayoritas (LAYAK) lebih banyak dari pada mayoritas (TIDAK LAYAK)';
				}else{
					$hasil = 'TIDAK LAYAK';
					$hasil1 = 'kategori mayoritas (TIDAK LAYAK) lebih banyak dari pada mayoritas (LAYAK)';
				}

			}
		?>

		<h4>Kesimpulan</h4>
		<div class="text-justify" style="border: 1px solid;">
			<h4>Hasil Perhitungan Ini Menggambilkan 3 Data Terbaik Asecending (K=3) Yang Menggunakan <b>Klasifikasi	K-Nearest Neightbor(K-NN)</b>, Adapun Kesimpulanya Dari Metode Klasifikasi	K-Nearest Neightbor(K-NN) Adalah : <b><?php echo $hasil1; ?></b>, LAYAK Berjumlah <b>(<?php echo $jmllayak; ?>)</b> Sedangkan TIDAK LAYAK Berjumlah <b>(<?php echo $jmltidaklayak; ?>)</b>, Sehingga Dapat Disimpulkan Atas Nama <b><?php echo $_GET['nama_alternatif']?></b> Keputusan Kelayakan Sebagai Penerima Bantuan Hasilnya:<b><?php echo $hasil; ?></b> </h4>
		</div>
		<br>

		<form action="metode.php?aksi=simpanhasil" method="post" enctype="multipart/form-data">
			<input type="hidden" class="form-control" name="nama_alternatif" value="<?php echo $_GET['nama_alternatif']?>">
			<input type="hidden" class="form-control" name="keterangan" value="<?php echo $hasil ?>">

			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" name="proses" value="Simpan Hasil Analisa">
			</div>
		</form>
		<br>

		</div>
	</div>
</div>