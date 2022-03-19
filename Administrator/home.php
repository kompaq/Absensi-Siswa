<?php 
//data jurusan
$jurusan=mysqli_query($conn,"SELECT * FROM tbl_jurusan");
$jumlah_jurusan=mysqli_num_rows($jurusan);
//data kelas
$kelas=mysqli_query($conn,"SELECT * FROM tbl_kelas");
$jumlah_kelas=mysqli_num_rows($kelas);
//data siswa
$siswa=mysqli_query($conn,"SELECT * FROM tbl_siswa");
$jumlah_siswa=mysqli_num_rows($siswa);
//data mapel
$mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel");
$jumlah_mapel=mysqli_num_rows($mapel);
//data ki kd
$ki_kd=mysqli_query($conn,"SELECT * FROM tbl_kompetensi");
$jumlah_ki_kd=mysqli_num_rows($ki_kd);
//data materi
$materi=mysqli_query($conn,"SELECT * FROM tbl_materi");
$jumlah_materi=mysqli_num_rows($materi);
//data tugas
$tugas=mysqli_query($conn,"SELECT * FROM tbl_tugas");
$jumlah_tugas=mysqli_num_rows($tugas);
?>

<style>
a{
  text-decoration:none;
}
</style>
<div class="w3-row-padding">
  <div class="w3-col m12 card-box ">
    <div class="w3-round w3-white">
      <div class="w3-container w3-padding">
        <h4>Administrasi Guru</h4>
        <hr class="w3-clear">

        <div class="w3-row">
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-orange w3-padding w3-round">
              <a href="?page=data_jurusan">
                <i class="fas fa-book-reader fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_jurusan;?></b>
                <h6>Data Jurusan</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-padding w3-round">
              <a href="?page=data_kelas">
                <i class="fas fa-chalkboard-teacher fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_kelas;?></b>
                <h6>Data Kelas</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-padding w3-round">
              <a href="?page=data_siswa">
                <i class="fas fa-user-plus fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_siswa;?></b>
                <h6>Data Siswa</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-red w3-leftbar w3-border-red w3-padding w3-round">
              <a href="?page=data_mapel">
                <i class="fas fa-book fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_mapel;?></b>
                <h6>Mata Pelajaran</h6>
              </a>              
            </div>
          </div>
        </div>

        <div class="w3-row">
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-orange w3-padding w3-round">
              <a href="?page=ki_kd">
                <i class="fas fa-file-contract fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_ki_kd;?></b>
                <h6>Data KI-KD</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-padding w3-round">
              <a href="?page=materi">
                <i class="fas fa-file-signature fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_materi;?></b>
                <h6>Data Materi</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-padding w3-round">
              <a href="?page=tugas">
                <i class="fab fa-ideal fa-3x"></i> <b class="w3-right" style="font-size:20px"><?php echo $jumlah_tugas;?></b>
                <h6>Data Tugas</h6>
              </a>              
            </div>
          </div>
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-red w3-leftbar w3-border-red w3-padding w3-round">
              <a href="?page=jadwal">
                <i class="fas fa-calendar fa-3x"></i>
                <h6>Jadwal Pelajaran</h6>
              </a>              
            </div>
          </div>
        </div>

        <div class="w3-row">
          <div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-orange w3-padding w3-round">
              <a href="?page=absen">
                <i class="fas fa-user-check fa-3x"></i>
                <h6>Absensi</h6>
              </a>              
            </div>
          </div>
          <!--div class="w3-col m3 w3-row-padding">
            <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-padding w3-round">
              <a href="?page=laporan/laporan">
                <i class="fas fa-chart-pie fa-3x"></i>
                <h6>Laporan</h6>
              </a>              
            </div>
          </div-->
        </div>

      </div>
    </div>
  </div>
</div>