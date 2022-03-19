<?php 
$a_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
$hari = $a_hari[date("N")];
?>
<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=absen" class="w3-bar-item w3-disabled"><i>Data Absen</i></a>
</div>
<br>
<div class="w3-col m12 card-box ">
    <div class="w3-round w3-white">
        <div class="w3-container w3-padding">        
            <?php 
                if(isset($_GET['absen'])){
                    $cari_jadwal=mysqli_query($conn,"SELECT * FROM tbl_jadwal WHERE hari='$hari'");
                    $cek_jadwal=mysqli_num_rows($cari_jadwal);
                    if($cek_jadwal == 0){
                        ?>
                        <div class="w3-panel w3-container animate__animated animate__fadeIn w3-pale-red w3-leftbar w3-border-red w3-padding w3-round">
                            <h3>Maaf!</h3>
                            <p>Tidak Ada Jadwal Pelajaran Hari Ini</p>
                        </div>  
                        <a href="?page=absen" class="w3-button w3-green">YA</a>  
                        <?php 
                    }else{
                    ?>   
                        <h5>Absensi Siswa</h5>                 
                        <div class="w3-row">
                            <div class="w3-col s3">
                                <select name="id_kelas" id="kelas" class="w3-input">
                                    <option value="">Pilih Jenis Kelas</option>
                                    <?php 
                                        while($data_kelas=mysqli_fetch_array($cari_jadwal)){
                                        $sql=mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$data_kelas[id_kelas]'");
                                        $kelas=mysqli_fetch_array($sql);
                                        echo "<option value=".$kelas['id_kelas'].">".$kelas['nama_kelas']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="w3-col s2">
                                <a href="?page=absen" class="w3-button w3-red w3-right"><i class="fas fa-times"></i> Batal</a>
                            </div>
                        </div>
                    <?php 
                    }
                    ?>   
                    <hr class="w3-clear">
                    <div id="show_siswa"></div>                
                <?php
                }else{
                ?>
                    <h5>Data Rekap Absensi Siswa</h5>
                    <hr class="w3-clear">
                    <a href="?page=absen&absen" class="w3-button w3-green"><i class="fa fa-user-check"></i> Absen Siswa</a>
                    <a href="laporan/absen_masal.php" target="_blank" class="w3-button w3-teal"><i class="fas fa-print"></i> Cetak Absen</a>
                    <hr>
                    <div class="w3-responsive" id="data"></div>  
                    <script>
                        $(document).ready(function(){
                            load_data();
                            function load_data(page){
                                $.ajax({
                                        url:"data_absen.php",
                                        method:"POST",
                                        data:{page:page},
                                        success:function(data){
                                            $('#data').html(data);
                                        }
                                })
                            }
                            $(document).on('click', '.halaman', function(){
                                var page = $(this).attr("id");
                                load_data(page);
                            });
                        });
                    </script>
                <?php
                }
            ?>
        </div>
    </div>
</div>