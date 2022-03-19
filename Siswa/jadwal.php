<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=jadwal" class="w3-bar-item w3-disabled"><i>Jadwal</i></a>
</div>
<br>
<div class="w3-col m12 card-box ">
    <div class="w3-round w3-white">
        <div class="w3-container w3-padding">
            <?php
            date_default_timezone_set("Asia/Makassar");
            $jam        =date("h:i:s");
            //membuat hari tanggal
            $a_hari     = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
            $hari       = $a_hari[date("N")];
            $jadwal=mysqli_query($conn,"SELECT * FROM tbl_jadwal where id_kelas='$row_data[id_kelas]' and hari='$hari'");
            while($data_jadwal=mysqli_fetch_array($jadwal)){
            ?>
                <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-orange w3-padding w3-round">
                    <div class="w3-row">
                        <div class="w3-col m1">
                            <a href="?page=jadwal">
                                <i class="fas fa-calendar fa-3x"></i> <b class="w3-right" style="font-size:20px"></b>
                                <h6><?php echo $data_jadwal['hari'];?></h6>
                            </a>     
                        </div>
                        <div class="w3-col m3">
                            <h3><?php echo $data_jadwal['jam_masuk']." - ".$data_jadwal['jam_keluar'];?></h3>
                        </div>
                        <div class="w3-col m4">
                            <h3>
                                <?php
                                $id_mapel=$data_jadwal['id_mapel'];
                                $sql=mysqli_query($conn,"SELECT * FROM tbl_mapel where id_mapel='$id_mapel'");
                                $data_mapel=mysqli_fetch_array($sql);
                                echo $data_mapel['nama_mapel'];
                                ?>
                            </h3>
                        </div>
                    </div>                             
                </div>
                <?php
            }            
            ?>
        </div>
    </div>
</div>