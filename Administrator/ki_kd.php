<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=ki_kd" class="w3-bar-item w3-disabled"><i>Data Kompetensi Inti - Kompetensi Dasar</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <?php 
                if(isset($_GET['tambah'])){
                    ?>
                        <h5>Formulir Tambah Data kelas</h5>
                        <hr class="w3-clear">
                        <form name="simpan" method="post">
                            <select name="id_mapel" class="w3-input w3-margin-bottom">
                                <option value="">Pilih Mapel</option>
                                <?php 
                                $mapel=mysqli_query($conn,"SELECT DISTINCT nama_mapel FROM tbl_mapel ORDER BY id_mapel");
                                while($data_mapel=mysqli_fetch_array($mapel)){
                                    $cari_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel where nama_mapel='$data_mapel[nama_mapel]'");
                                    $mapel_array=mysqli_fetch_array($cari_mapel);
                                    ?>
                                    <option value="<?php echo $mapel_array['id_mapel'];?>"><?php echo $mapel_array['nama_mapel'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="text" name="kompetensi_inti" placeholder="Kompetensi Inti" class="w3-input w3-margin-bottom">
                            <input type="text" name="kompetensi_dasar" placeholder="Kompetensi Dasar" class="w3-input w3-margin-bottom">
                            <input type="text" name="indikator" placeholder="Indikator" class="w3-input w3-margin-bottom">
                            <input type="text" name="tujuan_pembelajaran" placeholder="Tujuan Pembelajaran" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                            <button type="submit" name="simpan" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan</button>
                            <a href="?page=ki_kd" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $mapel                  = $_POST['id_mapel'];
                        $kompetensi_inti        = $_POST['kompetensi_inti'];
                        $kompetensi_dasar       = $_POST['kompetensi_dasar'];
                        $indikator              = $_POST['indikator'];
                        $tujuan_pembelajaran    = $_POST['tujuan_pembelajaran'];
                        $keterangan             = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"INSERT INTO tbl_kompetensi VALUES('','$mapel','$kompetensi_inti','$kompetensi_dasar','$indikator','$tujuan_pembelajaran','$keterangan')");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Simpan Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=ki_kd")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Simpan Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=ki_kd")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_kompetensi WHERE id_kompetensi='$id'");
                    $data_kompetensi=mysqli_fetch_array($cari);
                    ?>
                        <h5>Formulir Edit Data Kompetensi</h5>
                        <hr class="w3-clear">
                        <form name="ubah" method="post">
                        <select name="id_mapel" class="w3-input w3-margin-bottom">
                                <option value="<?php echo $data_kompetensi['id_mapel'];?>">
                                    <?php
                                    $lihat_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$data_kompetensi[id_mapel]'");
                                    $mapel_array=mysqli_fetch_array($lihat_mapel);
                                    echo $mapel_array['nama_mapel'];
                                    ?>
                                </option>
                                <?php 
                                $mapel=mysqli_query($conn,"SELECT DISTINCT nama_mapel FROM tbl_mapel ORDER BY id_mapel");
                                while($data_mapel=mysqli_fetch_array($mapel)){
                                    $cari_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel where nama_mapel='$data_mapel[nama_mapel]'");
                                    $mapel_array=mysqli_fetch_array($cari_mapel);
                                    ?>
                                    <option value="<?php echo $mapel_array['id_mapel'];?>"><?php echo $mapel_array['nama_mapel'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="text" name="kompetensi_inti" value="<?php echo $data_kompetensi['kompetensi_inti'];?>" placeholder="Kompetensi Inti" class="w3-input w3-margin-bottom">
                            <input type="text" name="kompetensi_dasar" value="<?php echo $data_kompetensi['kompetensi_dasar'];?>" placeholder="Kompetensi Dasar" class="w3-input w3-margin-bottom">
                            <input type="text" name="indikator" value="<?php echo $data_kompetensi['indikator'];?>" placeholder="Indikator" class="w3-input w3-margin-bottom">
                            <input type="text" name="tujuan_pembelajaran" value="<?php echo $data_kompetensi['tujuan_pembelajaran'];?>" placeholder="Tujuan Pembelajaran" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" value="<?php echo $data_kompetensi['keterangan'];?>" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                                
                            <button type="submit" name="ubah" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            <a href="?page=ki_kd" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['ubah'])){
                        $mapel                  = $_POST['id_mapel'];
                        $kompetensi_inti        = $_POST['kompetensi_inti'];
                        $kompetensi_dasar       = $_POST['kompetensi_dasar'];
                        $indikator              = $_POST['indikator'];
                        $tujuan_pembelajaran    = $_POST['tujuan_pembelajaran'];
                        $keterangan             = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"UPDATE tbl_kompetensi SET id_mapel='$mapel',kompetensi_inti='$kompetensi_inti',kompetensi_dasar='$kompetensi_dasar',indikator='$indikator',tujuan_pembelajaran='$tujuan_pembelajaran',keterangan='$keterangan' WHERE id_kompetensi='$id'");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=ki_kd")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=ki_kd")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['delete'])){
                    $id=$_GET['delete'];
                    $hapus=mysqli_query($conn,"DELETE FROM tbl_kompetensi WHERE id_kompetensi='$id'");
                    if($hapus){
                        ?>
                            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                <h3>Terima Kasih!</h3>
                                <p>Proses Hapus Data Berhasil</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=ki_kd")',2000);
                            </script>
                        <?php 
                    }else{
                        ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Proses Hapus Data Gagal</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=ki_kd")',2000);
                            </script>
                        <?php 
                    }
                }else{
                    ?>
                        <div class="w3-responsive w3-margin-bottom">
                            <a href="?page=ki_kd&tambah" class="w3-button w3-blue"><i class="fas fa-plus"></i> Tambah Data</a>
                            <hr class="w3-clear">
                            <table class="w3-table-all">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mapel</th>
                                        <th>Kompetensi Inti</th>
                                        <th>Kompetensi Dasar</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no=1;
                                    $tabel_sql=mysqli_query($conn,"SELECT * FROM tbl_kompetensi");
                                    while($data_tabel=mysqli_fetch_array($tabel_sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td>
                                                <?php 
                                                $lihat_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$data_tabel[id_mapel]'");
                                                $mapel_array=mysqli_fetch_array($lihat_mapel);
                                                echo $mapel_array['nama_mapel'];
                                                ?>
                                            </td>
                                            <td><?php echo $data_tabel['kompetensi_inti'];?></td>
                                            <td><?php echo $data_tabel['kompetensi_dasar'];?></td>
                                            <td>
                                                <a href="?page=ki_kd&edit=<?php echo $data_tabel['id_kompetensi'];?>" class="w3-text-green w3-margin-right" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="?page=ki_kd&delete=<?php echo $data_tabel['id_kompetensi'];?>" class="w3-text-red" onclick="return confirm('Apakah Anda Akan Menghapus Data ini...?');" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php 
                }
                ?>
            </div>
        </div>
    </div>
</div>