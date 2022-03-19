<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=materi" class="w3-bar-item w3-disabled"><i>Materi</i></a>
</div>
<br>
<div class="w3-col m12 card-box ">
    <div class="w3-round w3-white">
        <div class="w3-container w3-padding">
            <?php 
            $a_hari     = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
            $hari       = $a_hari[date("N")];
            $jadwal=mysqli_query($conn,"SELECT * FROM tbl_jadwal where id_kelas='$row_data[id_kelas]' and hari='$hari'");
            while($data_jadwal=mysqli_fetch_array($jadwal)){
                $materi=mysqli_query($conn,"SELECT * FROM tbl_materi WHERE id_mapel='$data_jadwal[id_mapel]' AND status='Aktif'");
                while($data_materi=mysqli_fetch_array($materi)){
                ?>
                <div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-padding w3-round">
                    <div class="w3-row">
                        <div class="w3-col m4">
                            <p><?php echo $data_materi['nama_materi'];?></p>
                        </div>
                        <div class="w3-col m6">
                            <?php 
                            $kompetensi=$data_materi['id_kompetensi'];
                            $sql=mysqli_query($conn,"SELECT * FROM tbl_kompetensi WHERE id_kompetensi='$kompetensi'");
                            $data_kom=mysqli_fetch_array($sql);
                            echo "<p>".$data_kom['kompetensi_inti']."</p>";
                            echo "<p>".$data_kom['kompetensi_dasar']."</p>";
                            ?>
                        </div>
                        <div class="w3-col m2">
                            <!-- Trigger/Open the Modal -->
                            <button onclick="document.getElementById('id<?php echo $data_materi['id_materi'];?>').style.display='block'" class="w3-button w3-khaki"><i class="fas fa-eye"></i>Lihat Materi</button>
                                <!-- The Modal -->
                            <div id="id<?php echo $data_materi['id_materi'];?>" class="w3-modal">
                                <div class="w3-modal-content  animate__animated animate__fadeInDown" style="width:70vmax;">
                                    <div class="w3-container">
                                    <span onclick="document.getElementById('id<?php echo $data_materi['id_materi'];?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h5><?php echo $data_materi['nama_materi'];?></h5>
                                    <hr>
                                    <embed src="../Administrator/upload_materi/<?php echo $data_materi['upload'];?>" type="" style="width:100%;height:30vmax;" class="w3-margin-bottom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                
                </div>
                <?php 
                }
            }
            ?>
        </div>
    </div>
</div>