<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=materi" class="w3-bar-item w3-disabled"><i>Data Materi</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <?php
                if(isset($_GET['Tambah'])){
                ?>
                    <h4>Formulit Input Data Materi</h4>
                    <hr class="w3-clear">
                    <form name="simpan" method="post" enctype="multipart/form-data">
                        <select name="id_mapel" id="mapel" class="w3-input w3-margin-bottom" required>
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
                        <select name="id_kompetensi" id="kompetensi" class="w3-input w3-margin-bottom" required>
                            <option value="">Pilih KI-KD</option>
                        </select>  
                        <input type="text" name="nama_materi" placeholder="Nama Materi" required class="w3-input w3-margin-bottom">
                        <span class="w3-text-red"><i>* Upload Materi Anda (Format .docx .pdf .ppt .mp4 .mov)</i></span>
                        <input type="file" name="upload" class="w3-input w3-margin-bottom" required>
                        
                        <input type="text" name="keterangan" required placeholder="Keterangan Lainya" class="w3-input w3-margin-bottom">
                        <select name="status" class="w3-input w3-margin-bottom" required>
                            <option value="">Pilih Status Materi</option>
                            <option>Aktif</option>
                            <option>Non Aktif</option>
                        </select>                       
                        <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan</button>
                        <a href="?page=materi" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>               
                    </form>
                    <?php 
                    if(isset($_POST['simpan'])){
                        $nama_materi        = $_POST['nama_materi']; 
                        $id_mapel           = $_POST['id_mapel'];
                        $id_kompetensi      = $_POST['id_kompetensi'];
                        $keterangan         = $_POST['keterangan'];
                        $status             = $_POST['status'];                        

                        // upload photo
                        $file_upload        = $_FILES['upload']['name'];
                        $tmp                = $_FILES['upload']['tmp_name'];
                        $file_upload_baru   = date('dmYHis').$file_upload;
                        $path               = "upload_materi/".$file_upload_baru;

                        if($tmp=="" or $file_upload=="" or $nama_materi=="" or $id_mapel=="" or $id_kompetensi=="" or $keterangan=="" or $status==""){
                        ?>
                        <script>
                            $(document).ready(function(){
                                $("#id001").show();
                            });
                        </script>
                        <div id="id001" class="w3-modal">
                            <div class="w3-modal-content  animate__animated animate__fadeInDown" style="width:30vmax;border-radius:10px;">
                                <div class="w3-container">
                                    <p><b>Perhatian!</b> Maaf Lengkapi data Terlebih dahulu</p>
                                    <button onclick="document.getElementById('id001').style.display='none'" class="w3-button w3-blue w3-margin-bottom">OK</button>
                                </div>    
                            </div>
                        </div>       
                        <?php 
                        }else{
                            if(move_uploaded_file($tmp, $path)){ 
                                $simpan=mysqli_query($conn,"INSERT INTO tbl_materi VALUES('','$nama_materi','$id_mapel','$id_kompetensi','$file_upload_baru','$keterangan','$status')");
                                if($simpan){
                                    ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Simpan Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Simpan Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
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
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                            <?php
                            }
                          }

                    }

                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_materi WHERE id_materi='$id'");
                    $data=mysqli_fetch_array($cari);
                ?>
                    <h4>Formulit Edit Data Materi</h4>
                    <hr class="w3-clear">
                    <form name="simpan" method="post" enctype="multipart/form-data">
                        <select name="id_mapel" id="mapel" class="w3-input w3-margin-bottom" required>
                            <?php 
                            $cari_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel where id_mapel='$data[id_mapel]'");
                            $mapel_array=mysqli_fetch_array($cari_mapel);
                            ?>
                            <option value="<?php echo $mapel_array['id_mapel'];?>">
                                <?php echo $mapel_array['nama_mapel'];?>
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
                        <select name="id_kompetensi" id="kompetensi" class="w3-input w3-margin-bottom" required>
                            <?php 
                            $cari_kompetensi=mysqli_query($conn,"SELECT * FROM tbl_kompetensi where id_kompetensi='$data[id_kompetensi]'");
                            $kompetensi_array=mysqli_fetch_array($cari_kompetensi);
                            ?>
                            <option value="<?php echo $kompetensi_array['id_kompetensi'];?>">
                                <?php echo $kompetensi_array['kompetensi_inti']."&nbsp; \ &nbsp;".$kompetensi_array['kompetensi_dasar'];?>
                            </option>
                        </select>  
                        <input type="text" name="nama_materi" value="<?php echo $data['nama_materi'];?>" placeholder="Nama Materi" required class="w3-input w3-margin-bottom">
                        <span class="w3-text-red"><i>* Upload Perubahan Materi Anda (Format .docx .pdf .ppt .mp4 .mov)</i></span>
                        <input type="file" name="upload" class="w3-input w3-margin-bottom">
                        <small class="w3-text-green"><?php echo $data['upload'];?></small>
                        <input type="text" name="keterangan" value="<?php echo $data['keterangan'];?>" required placeholder="Keterangan Lainya" class="w3-input w3-margin-bottom">
                        <select name="status" class="w3-input w3-margin-bottom" required>
                            <option value="<?php echo $data['status'];?>"><?php echo $data['status'];?></option>
                            <option>Aktif</option>
                            <option>Non Aktif</option>
                        </select>                       
                        <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan</button>
                        <a href="?page=materi" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>               
                    </form>
                    <?php 
                    if(isset($_POST['simpan'])){
                        $nama_materi        = $_POST['nama_materi']; 
                        $id_mapel           = $_POST['id_mapel'];
                        $id_kompetensi      = $_POST['id_kompetensi'];
                        $keterangan         = $_POST['keterangan'];
                        $status             = $_POST['status'];                        

                        // upload photo
                        $file_upload        = $_FILES['upload']['name'];
                        $tmp                = $_FILES['upload']['tmp_name'];
                        $file_upload_baru   = date('dmYHis').$file_upload;
                        $path               = "upload_materi/".$file_upload_baru;

                        if($tmp=="" AND $file_upload==""){
                            $simpan=mysqli_query($conn,"UPDATE tbl_materi SET nama_materi='$nama_materi',id_mapel='$id_mapel',id_kompetensi='$id_kompetensi',keterangan='$keterangan',status='$status' WHERE id_materi='$id'");
                            if($simpan){
                                ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Ubah Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                                <?php
                            }else{
                                ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Ubah Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                                <?php
                            }   
                        }else{
                            if(move_uploaded_file($tmp, $path)){ 
                                $query = "SELECT * FROM tbl_materi WHERE id_materi='$id'";
                                $q = mysqli_query($conn, $query);
                                $dt = mysqli_fetch_array($q); 
                                if(is_file("upload_materi/".$dt['upload'])) unlink("upload_materi/".$dt['upload']);
                                $simpan=mysqli_query($conn,"UPDATE tbl_materi SET nama_materi='$nama_materi',id_mapel='$id_mapel',id_kompetensi='$id_kompetensi',keterangan='$keterangan',status='$status',upload='$file_upload_baru' WHERE id_materi='$id'");
                                if($simpan){
                                    ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Ubah Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Ubah Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=materi")',2000);
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
                                        setTimeout('location.replace("?page=materi")',2000);
                                    </script>
                            <?php
                            }
                        }

                    }
                }elseif(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $query = mysqli_query($conn,"SELECT * FROM tbl_materi WHERE id_materi='$id'");
                    $data = mysqli_fetch_array($query); 
                    if(is_file("upload_materi/".$data['upload'])) unlink ("upload_materi/".$data['upload']);
                    $query2 = "DELETE FROM tbl_materi WHERE id_materi='$id'";
                    $sql = mysqli_query($conn, $query2);
                    if($sql){ 
                        ?>
                        <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                            <h3>Terima Kasih!</h3>
                            <p>Proses Hapus Data Berhasil</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=materi")',2000);
                        </script>
                        <?php 
                    }else{
                        ?>
                        <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                            <h3>Maaf!</h3>
                            <p>Proses Hapus Data Gagal</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=materi")',2000);
                        </script>
                        <?php 
                    }
                }else{
                ?>
                <h5>Tabel Data Materi</h5>
                <hr class="w3-clear">
                <a href="?page=materi&Tambah" class="w3-button w3-teal"><i class="fas fa-user-plus"></i> Tambah Data</a>
                <hr class="w3-clear">
                <table class="w3-table-all">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nama Materi</th>
                            <th>KI-KD</th>
                            <th>File Materi</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=1;
                    $tabel=mysqli_query($conn,"SELECT * FROM tbl_materi");
                    while($data_tabel=mysqli_fetch_array($tabel)){
                        ?>
                        <tr>
                            <td><?php echo $no++;?></td>
                            <td>
                                <?php 
                                $mapel=$data_tabel['id_mapel'];
                                $cari_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$mapel'");
                                $data_mapel=mysqli_fetch_array($cari_mapel);
                                echo $data_mapel['nama_mapel'];
                                ?>
                            </td>                            
                            <td><?php echo $data_tabel['nama_materi'];?></td>
                            <td>
                                <?php 
                                $kikd=$data_tabel['id_kompetensi'];
                                $cari_kompetensi=mysqli_query($conn,"SELECT * FROM tbl_kompetensi WHERE id_kompetensi='$kikd'");
                                $data_kompetensi=mysqli_fetch_array($cari_kompetensi);
                                echo $data_kompetensi['kompetensi_inti']."<br>".$data_kompetensi['kompetensi_dasar'];
                                ?>
                            </td>
                            <td>
                                <!-- Trigger/Open the Modal -->
                                <button onclick="document.getElementById('id<?php echo $data_tabel['id_materi'];?>').style.display='block'" class="w3-button w3-khaki"><i class="fas fa-eye"></i> Lihat</button>
                                <!-- The Modal -->
                                <div id="id<?php echo $data_tabel['id_materi'];?>" class="w3-modal">
                                <div class="w3-modal-content  animate__animated animate__fadeInDown" style="width:50vmax;">
                                    <div class="w3-container">
                                    <span onclick="document.getElementById('id<?php echo $data_tabel['id_materi'];?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h5><?php echo $data_tabel['nama_materi'];?></h5>
                                    <hr>
                                    <embed src="upload_materi/<?php echo $data_tabel['upload'];?>" type="" style="width:100%;height:30vmax;" class="w3-margin-bottom">
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                                <a href="?page=materi&edit=<?php echo $data_tabel['id_materi'];?>" title="Edit Data" class="w3-text-green"><i class="fas fa-edit"></i></a>&nbsp;
                                <a href="?page=materi&delete=<?php echo $data_tabel['id_materi'];?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini...?');" title="Hapus Data" class="w3-text-red"><i class="fas fa-trash"></i></a>
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