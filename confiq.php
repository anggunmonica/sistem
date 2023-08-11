<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$database = "metode_knn";
 
$koneksi = mysqli_connect($server, $user, $pass, $database);
 
if (!$koneksi) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
 
?>