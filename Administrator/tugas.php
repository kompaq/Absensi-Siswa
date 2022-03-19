<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=tugas" class="w3-bar-item w3-disabled"><i>Data Tugas</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <?php
                if(isset($_GET['Tambah'])){
                ?>
                    <h4>Formulit Input Data Tugas</h4>
                    <form name="simpan" method="post" enctype="multipart/form-data">
                        <input type="text" name="judul_tugas" placeholder="Judul Tugas" required class="w3-input w3-margin-bottom">
                        <select name="id_materi" id="mapel" class="w3-input w3-margin-bottom" required>
                            <option value="">Pilih Materi</option>
                            <?php 
                            $cari_tugas=mysqli_query($conn,"SELECT * FROM tbl_materi");
                            while($tugas_array=mysqli_fetch_array($cari_tugas)){
                            ?>
                            <option value="<?php echo $tugas_array['id_materi'];?>"><?php echo $tugas_array['nama_materi'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <small>Ketik Tugas Dibawah Ini</small>
                        <i><textarea name="text_tugas" class="w3-input w3-border-grey w3-margin-bottom" required cols="30" rows="2"></textarea></i>
                        <span class="w3-text-red"><i>* Upload Dokumen Tugas Anda (Format .docx .pdf .ppt .mp4 .mov)</i></span>
                        <input type="file" name="file_tugas" class="w3-input w3-margin-bottom">
                        <small>Deskripsi Tugas</small>
                        <i><textarea name="deskripsi_tugas" class="w3-input w3-border-grey w3-margin-bottom" cols="30" rows="2"></textarea></i>                      
                        <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan</button>
                        <a href="?page=tugas" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>               
                    </form>
                    <?php 
                    if(isset($_POST['simpan'])){
                        $judul_tugas        = $_POST['judul_tugas']; 
                        $id_materi          = $_POST['id_materi'];
                        $text_tugas         = $_POST['text_tugas'];
                        $deskripsi_tugas    = $_POST['deskripsi_tugas'];                     

                        // upload photo
                        $file_upload        = $_FILES['file_tugas']['name'];
                        $tmp                = $_FILES['file_tugas']['tmp_name'];
                        $file_upload_baru   = date('dmYHis').$file_upload;
                        $path               = "upload_tugas/".$file_upload_baru;

                        if($tmp=="" or $file_upload==""){
                            $simpan=mysqli_query($conn,"INSERT INTO tbl_tugas VALUES('','$judul_tugas','$id_materi','$text_tugas','','$deskripsi_tugas')");
                            if($simpan){
                                ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                  <h3>Terima Kasih!</h3>
                                  <p>Proses Simpan Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=tugas")',2000);
                                </script>
                                <?php
                            }else{
                                ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                  <h3>Maaf!</h3>
                                  <p>Proses Simpan Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=tugas")',2000);
                                </script>
                                <?php
                            }  
                        }else{
                            if(move_uploaded_file($tmp, $path)){ 
                                $simpan=mysqli_query($conn,"INSERT INTO tbl_tugas VALUES('','$judul_tugas','$id_materi','$text_tugas','$file_upload_baru','$deskripsi_tugas')");
                                if($simpan){
                                    ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Simpan Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Simpan Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                                    <?php
                                }
                            }else{
                                ?>
                                    <div class="w3-panel w3-blue w3-container animate__animated animate__zoomIn">
                                        <h3>Maaf!</h3>
                                        <p>Tidak Ada File Yang Diupload</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                            <?php
                            }
                        }
                    }

                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_tugas WHERE id_tugas='$id'");
                    $data=mysqli_fetch_array($cari);
                    ?>
                    <h4>Formulit Edit Data Tugas</h4>
                    <form name="simpan" method="post" enctype="multipart/form-data">
                        <input type="text" name="judul_tugas" value="<?php echo $data['judul_tugas'];?>" placeholder="Judul Tugas" required class="w3-input w3-margin-bottom">
                        <select name="id_materi" id="mapel" class="w3-input w3-margin-bottom" required>
                            <?php 
                                $id_materi=$data['id_materi'];
                                $cari=mysqli_query($conn,"SELECT * FROM tbl_materi where id_materi='$id_materi'");
                                $data_materi=mysqli_fetch_array($cari);
                            ?>
                            <option value="<?php echo $data_materi['id_materi'];?>"><?php echo $data_materi['nama_materi'];?></option>
                            <?php 
                            $cari_tugas=mysqli_query($conn,"SELECT * FROM tbl_materi");
                            while($tugas_array=mysqli_fetch_array($cari_tugas)){
                            ?>
                            <option value="<?php echo $tugas_array['id_materi'];?>"><?php echo $tugas_array['nama_materi'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <small>Ketik Tugas Dibawah Ini</small>
                        <i><textarea name="text_tugas" class="w3-input w3-border-grey w3-margin-bottom" required cols="30" rows="2"><?php echo $data['text_tugas'];?></textarea></i>
                        <span class="w3-text-red"><i>* Upload Dokumen Tugas Anda (Format .docx .pdf .ppt .mp4 .mov)</i></span>
                        <input type="file" name="file_tugas" class="w3-input">
                        <?php 
                            if($data['file_tugas']==""){
                                ?>
                                <small class="w3-text-red w3-margin-bottom">* Belum Ada Dokumen Tugas Yang Diunggah</small>
                                <?php
                            }else{
                                ?>
                                <small class="w3-text-green w3-margin-bottom"><?php echo $data['file_tugas'];?></small>
                                <?php
                            }
                        ?>
                        <br>
                        <small>Deskripsi Tugas</small>
                        <i><textarea name="deskripsi_tugas" class="w3-input w3-border-grey w3-margin-bottom" cols="30" rows="2"><?php echo $data['deskripsi_tugas'];?></textarea></i>                      
                        <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan</button>
                        <a href="?page=tugas" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>               
                    </form>
                    <?php 
                    if(isset($_POST['simpan'])){
                        $judul_tugas        = $_POST['judul_tugas']; 
                        $id_materi          = $_POST['id_materi'];
                        $text_tugas         = $_POST['text_tugas'];
                        $deskripsi_tugas    = $_POST['deskripsi_tugas'];                     

                        // upload photo
                        $file_upload        = $_FILES['file_tugas']['name'];
                        $tmp                = $_FILES['file_tugas']['tmp_name'];
                        $file_upload_baru   = date('dmYHis').$file_upload;
                        $path               = "upload_tugas/".$file_upload_baru;

                        if($tmp=="" or $file_upload==""){
                            $simpan=mysqli_query($conn,"UPDATE tbl_tugas SET judul_tugas='$judul_tugas',id_materi='$id_materi',text_tugas='$text_tugas',deskripsi_tugas='$deskripsi_tugas' WHERE id_tugas='$id'");
                            if($simpan){
                                ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                  <h3>Terima Kasih!</h3>
                                  <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=tugas")',2000);
                                </script>
                                <?php
                            }else{
                                ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                  <h3>Maaf!</h3>
                                  <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=tugas")',2000);
                                </script>
                                <?php
                            }  
                        }else{
                            if(move_uploaded_file($tmp, $path)){ 
                                $simpan=mysqli_query($conn,"UPDATE tbl_tugas SET judul_tugas='$judul_tugas',id_materi='$id_materi',text_tugas='$text_tugas',file_tugas='$file_upload_baru',deskripsi_tugas='$deskripsi_tugas' WHERE id_tugas='$id'");
                                if($simpan){
                                    ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Ubah Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Ubah Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                                    <?php
                                }
                            }else{
                                ?>
                                    <div class="w3-panel w3-blue w3-container animate__animated animate__zoomIn">
                                        <h3>Maaf!</h3>
                                        <p>Tidak Ada File Yang Diupload</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=tugas")',2000);
                                    </script>
                            <?php
                            }
                        }
                    }
                }elseif(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $query = mysqli_query($conn,"SELECT * FROM tbl_tugas WHERE id_tugas='$id'");
                    $data = mysqli_fetch_array($query); 
                    if(is_file("upload_tugas/".$data['file_tugas'])) unlink ("upload_tugas/".$data['file_tugas']);
                    $query2 = "DELETE FROM tbl_tugas WHERE id_tugas='$id'";
                    $sql = mysqli_query($conn, $query2);
                    if($sql){ 
                        ?>
                        <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                            <h3>Terima Kasih!</h3>
                            <p>Proses Hapus Data Berhasil</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=tugas")',2000);
                        </script>
                        <?php 
                    }else{
                        ?>
                        <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                            <h3>Maaf!</h3>
                            <p>Proses Hapus Data Gagal</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=tugas")',2000);
                        </script>
                        <?php 
                    }
                }else{
                ?>
                <h5>Tabel Data Tugas</h5>
                <hr class="w3-clear">
                <a href="?page=tugas&Tambah" class="w3-button w3-teal"><i class="fas fa-user-plus"></i> Tambah Data</a>
                <hr class="w3-clear">
                <table class="w3-table-all">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Tugas</th>
                            <th>Materi</th>
                            <th>Isi Tugas</th>
                            <th>File Tugas</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    $tabel=mysqli_query($conn,"SELECT * FROM tbl_tugas");
                    while($data_tabel=mysqli_fetch_array($tabel)){
                        ?>
                        <tr>
                            <td><?php echo $no++;?></td>
                            <td><?php echo $data_tabel['judul_tugas'];?></td>
                            <td>
                                <?php 
                                $materi=$data_tabel['id_materi'];
                                $cari_materi=mysqli_query($conn,"SELECT * FROM tbl_materi WHERE id_materi='$materi'");
                                $data_materi=mysqli_fetch_array($cari_materi);
                                echo $data_materi['nama_materi'];
                                ?>
                            </td>                            
                            <td><p><?php echo $data_tabel['text_tugas'];?></p></td>
                            <td>
                                <?php 
                                if($data_tabel['file_tugas']==""){

                                }else{
                                ?>
                                    <!-- Trigger/Open the Modal -->
                                    <button onclick="document.getElementById('id<?php echo $data_tabel['id_tugas'];?>').style.display='block'" class="w3-button w3-khaki"><i class="fas fa-eye"></i> Lihat</button>
                                <?php 
                                } 
                                ?>
                                    <!-- The Modal -->
                                    <div id="id<?php echo $data_tabel['id_tugas'];?>" class="w3-modal">
                                    <div class="w3-modal-content  animate__animated animate__fadeInDown" style="width:50vmax;">
                                        <div class="w3-container">
                                        <span onclick="document.getElementById('id<?php echo $data_tabel['id_tugas'];?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <h5><?php echo $data_tabel['judul_tugas'];?></h5>
                                        <hr>
                                        <embed src="upload_tugas/<?php echo $data_tabel['file_tugas'];?>" type="" style="width:100%;height:30vmax;" class="w3-margin-bottom">
                                        </div>
                                    </div>
                                    </div>
                            </td>
                            <td>
                                <a href="?page=tugas&edit=<?php echo $data_tabel['id_tugas'];?>" title="Edit Data" class="w3-text-green"><i class="fas fa-edit"></i></a>&nbsp;
                                <a href="?page=tugas&delete=<?php echo $data_tabel['id_tugas'];?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini...?');" title="Hapus Data" class="w3-text-red"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
</div>