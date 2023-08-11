<?php
// Include the database configuration file
$koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        // Generate the automatic code
        $carikode = mysqli_query($koneksi, "SELECT max(kode_akun) FROM akun");
        $datakode = mysqli_fetch_row($carikode);
        if ($datakode[0] != null) {
            $nilaikode = substr($datakode[0], 3);
            $kode = (int) $nilaikode;
            $kode = $kode + 1;
            $kode_otomatis = "adm" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "adm01";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>  
    <div class="container">
        <div class="bootstrap-table">
            <form action="lupaproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">
                <div><h1>Lupa Password</h1></div>
                <input type="hidden" name="kode_akun" class="form-control" value="<?php echo $kode_otomatis; ?>">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password baru">
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" name="level" class="form-control" placeholder="Masukkan admin poli">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-primary"><label> Kembali </label></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>