<?php
    if (isset($_GET['aksi'])){
        if ($_GET['aksi']=='login'){
            session_start();
            include 'confiq.php';
            $username = $_POST['username'];
            $password = $_POST['password'];
  
            // Menghubungkan ke database (pastikan konfigurasi koneksi sudah benar)
            $koneksi = mysqli_connect("localhost", "root", "", "metode_knn");

            $query = mysqli_query($koneksi, "SELECT * FROM akun where username='$username' AND password='$password' ");
            $cek = mysqli_num_rows($query);

            if ($cek > 0){
                $data = mysqli_fetch_assoc($query);
                if ($data['level']=='admin'){
                    $SESSION['username']=$username;
                    $SESSION['level']='admin';
                    header("location: admin/index.php");
                }else{
                    header("location:index.php?pesan=gagal");
                }
            }     
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>SISTEM REKOMENDASI ALAT MEDIS RSUD RANTAUPRAPAT</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>

<div class="container">

    <?php
        if (isset($_GET['aksi'])){
        if ($_GET['aksi']=='login'){
           echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
        }
    }
    ?>

    <form action="index.php?aksi=login" method="post" enctype="multipart/form-data">
        <div class="col-md-7 col-offset-4 kotak">

            <div><h1>RSUD RANTAUPRAPAT</h1></div>
            
        <div>
            <label>Username</label>
            <input type="text" name="username" class="form_login" placeholder=""> 
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder=""> 
        </div>
        <div class="form-group">
            <button type="submit">LOGIN</button>
        </div>
        </div>
    </form>
</div>
</body>
</html>