<?php
    include 'headerpoli.php';
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><h4>REKOMENDASI ALAT MEDIS</h4></li>
        </ol>
    </div>

<div class="table-responsive">

<?php
      $koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Initialize $nilaik with a default value if not set
$nilaik = 0;

if (isset($_POST['proses'])) {
    // Get the selected value of K
    $nilaik = (int)$_POST['nilaik'];

    // Validate the input to ensure it is within the desired range
    if ($nilaik < 0 || $nilaik > 10) {
        // For simplicity, set the default value to 1 if the input is invalid.
        $nilaik = 0;
    }
}
?>

<h4>Pilih Nilai K</h4>
<form method="post">
    <div class="table-responsive">
        <select class="form-control select2" name="nilaik" required="">
            <option value="" disabled selected>Pilih Nilai K</option>
            <option <?php if ($nilaik == 1) echo 'selected'; ?>>1</option>
            <option <?php if ($nilaik == 2) echo 'selected'; ?>>2</option>
            <option <?php if ($nilaik == 3) echo 'selected'; ?>>3</option>
            <option <?php if ($nilaik == 4) echo 'selected'; ?>>4</option>
            <option <?php if ($nilaik == 5) echo 'selected'; ?>>5</option>
            <option <?php if ($nilaik == 6) echo 'selected'; ?>>6</option>
            <option <?php if ($nilaik == 7) echo 'selected'; ?>>7</option>
            <option <?php if ($nilaik == 8) echo 'selected'; ?>>8</option>
            <option <?php if ($nilaik == 9) echo 'selected'; ?>>9</option>
            <option <?php if ($nilaik == 10) echo 'selected'; ?>>10</option>
        </select>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="proses" value="Proses Metode">
        </div>
    </div>

<h4>Hasil Rekomendasi</h4>
<table class="table tabel-bordered" border="1">
    <thead>
        <tr>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama Penyakit</th>
            <th class="text-center">Tindakan</th>
            <th class="text-center">Alat</th>
            <th class="text-center">Distance</th>
            <th class="text-center">Rangking</th>
            <th class="text-center">Keterangan Alat</th>
        </tr>
    </thead>
    </form>

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
                echo "<td class='text-center'>" . $alternatif['tindakan'] . "</td>";
                echo "<td class='text-center'>" . $alternatif['alat'] . "</td>";
                echo "<td class='text-center'>" . number_format($alternatif['distance'], 2) . "</td>";
                echo "<td class='text-center'>" . $alternatif['rangking'] . "</td>";
                echo "<td class='text-center'>" . $alternatif['keterangan_alat'] . "</td>";
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
