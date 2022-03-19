<?php 
include_once "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/w3schools.css">    
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/animate.css/animate.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="modal-dialog modal-sm mt-5 animate__animated animate__fadeInDown">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="images/tutwuri.png" class="animate__animated animate__zoomIn" alt="" srcset="">
        <div class="break"></div>
        <form action="" name="login" method="post">
          <input type="text" name="nama_pengguna" id="" class="w3-input" placeholder="Nama Pengguna">
          <div class="break"></div>
          <input type="password" name="kata_sandi" id="" class="w3-input" placeholder="Kata Sandi">
          <div class="break"></div>
          <button type="submit" name="login" class="w3-btn tombol w3-block">Masuk</button>
          <?php 
            if(isset($_POST['login'])){
              $nama_pengguna  = $_POST['nama_pengguna'];
              $kata_pengguna  = $_POST['kata_sandi'];
              $_SESSION['nama_pengguna'] = $_REQUEST['nama_pengguna'];
              $query=mysqli_query($conn,"SELECT * FROM tbl_guru WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_pengguna'");
              $cek_login = mysqli_num_rows($query);
              if($cek_login > 0){
                  header('location:Administrator/index.php?page=home');
              }else{
                ?>
                <div class="w3-panel w3-pale-red w3-border">
                  <h3>Maaf!</h3>
                  <p>Akun Yang Anda Masukkan Salah.</p>
                </div>
                <?php
              }
            }
          ?>
          <div class="break"></div>
          Atau
          <div class="break"></div>
          Belum Memiliki Akun...? <a href="http://" target="_blank" rel="noopener noreferrer">Daftar</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>