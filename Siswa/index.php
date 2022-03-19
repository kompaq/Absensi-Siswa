<?php
include '../koneksi.php';
session_start();
if ($_SESSION['username']) {
  $akun = $_SESSION['username'];
  $cariakun =  mysqli_query($conn, "SELECT * FROM tbl_siswa WHERE username='$akun'");
  $row_data =  mysqli_fetch_array($cariakun);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haloo, <?php echo $row_data['nama'];?></title>
    <link rel="stylesheet" href="../assets/w3schools.css">
    <link rel="stylesheet" href="../assets/animate.css/animate.min.css">    
    <link rel="stylesheet" href="../assets/w3-theme-blue-grey.css">
    <script src="../assets/jquery/dist/jquery.min.js"></script>
    <script src="../assets/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <style>
      a{
        text-decoration:none;
      }
      .akun-card {
        background-color: #ffffff;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
      }

      .active,
      .akun-card:hover {
        background-color: #ffffff;
      }

      .akun-card:after {
        content: "\002B";
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
      }

      .active:after {
        content: "\2212";
      }

      .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
      }
      .card-box{
        border:1px solid #eeeeee;
      }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a href="?page=home" class="w3-bar-item w3-button w3-padding-large">Dashboard Siswa</a>
  <a href="?page=home" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fas fa-tachometer-alt"></i></a>
  <a href="../logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"><i class="fas fa-power-off"></i></a>
 </div>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">

      <!-- Profile -->
      <div class="w3-round card-box">
        <button class="akun-card"><i class="fas fa-user-edit w3-text-green"></i> Profil Pengguna</button>
        <div class="w3-container panel">
          <div class="">
            <p class="w3-center">
            <?php 
                  if($row_data['photo']==""){
                ?>
                  <img src="../Administrator/siswa_photo/defauld.png" alt="Photo" style="width:50%;">
                <?php }else{ ?>
                  <img src="../Administrator/siswa_photo/<?php echo $row_data['photo'];?>" alt="Photo" style="width:50%;">
                <?php } ?>
              </p>
            <hr>
            <p><i class="fas fa-user-graduate fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row_data['nama'];?></p>
            <p><i class="fas fa-chalkboard-teacher fa-fw w3-margin-right w3-text-theme"></i> Status : Online</p>
            <br>
            <a href="../logout.php" onclick="return confirm('Yakin Akan Keluar...?');" class="w3-button w3-white w3-border w3-margin-bottom"><i class="fas fa-power-off"></i> Keluar</a>
            <a href="?page=edit_profil&id_siswa=<?php echo $row_data['id_siswa'];?>" class="w3-button w3-white w3-border w3-margin-bottom w3-right"><i class="fas fa-user-edit"></i> Edit</a>         
          </div>
        </div>
      </div>

      <br class="w3-clear">
    <!-- End Left Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m9">    
      <?php 
        $page=htmlentities($_GET['page']);
        $halaman="$page.php";
        if(!file_exists($halaman)){
          require "home.php";
        }else{
          include "$halaman";
        }
      ?>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<!--footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</!--footer-->

    <script>
      var acc = document.getElementsByClassName("akun-card");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
      }

      //ajax untuk menampilkan data KI-KD Berdasarkan nama mapel
      $(document).ready(function(){
        $('#mapel').change(function(){
          var id_mapel = $(this).val();

          $.ajax({
            type :'POST',
            url : 'ajax_ki_kd.php',
            data: 'id_mapel='+id_mapel,
            success: function(response){
              $('#kompetensi').html(response);
            }
          });
        })
      });

      //ajax untuk menampilkan data siswa Berdasarkan kelas
      $(document).ready(function(){
        $('#kelas').change(function(){
          var id_kelas = $(this).val();

          $.ajax({
            type :'GET',
            url : 'ajax_siswa.php',
            data: 'id_kelas='+id_kelas,
            success: function(response){
              $('#show_siswa').html(response);
            }
          });
        })
      });
    </script>
</body>
</html>

<?php
} else {
  header('location:../index.php');
}
?>