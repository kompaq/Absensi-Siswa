<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
            <?php
            if($row_data['jenis_kelamin']=="" OR $row_data['alamat']=="" OR $row_data['no_telepon']=="" OR $row_data['photo']==""){
                ?>
                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                    <h3>Maaf!</h3>
                    <p>Identitas Anda Belum Lengkap, Silahkan Lengkapi <a href="?page=edit_profil&id_siswa=<?php echo $row_data['id_siswa']; ?>" class="w3-button w3-blue">Lengkapi</a></p>
                </div>
                <?php
            }else{
                ?>
                <div class="w3-row">
                    <div class="w3-col m3 w3-row-padding">
                        <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-orange w3-padding w3-round">
                        <a href="?page=jadwal">
                            <i class="fas fa-calendar fa-3x"></i> <b class="w3-right" style="font-size:20px"></b>
                            <h6>Jadwal</h6>
                        </a>              
                        </div>
                    </div>
                    <div class="w3-col m3 w3-row-padding">
                        <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-padding w3-round">
                        <a href="?page=materi">
                            <i class="fas fa-book fa-3x"></i> <b class="w3-right" style="font-size:20px"></b>
                            <h6>Materi</h6>
                        </a>              
                        </div>
                    </div>
                    <div class="w3-col m3 w3-row-padding">
                        <div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-padding w3-round">
                        <a href="?page=tugas">
                            <i class="fas fa-user-graduate fa-3x"></i> <b class="w3-right" style="font-size:20px"></b>
                            <h6>Tugas</h6>
                        </a>              
                        </div>
                    </div>
                    <div class="w3-col m3 w3-row-padding">
                        <div class="w3-panel w3-pale-red w3-leftbar w3-border-red w3-padding w3-round">
                        <a href="?page=histori">
                            <i class="fas fa-history fa-3x"></i> <b class="w3-right" style="font-size:20px"></b>
                            <h6>Histori</h6>
                        </a>              
                        </div>
                    </div>
                </div>
                <?php 
            }
            ?>
            </div>
        </div>
    </div>