<?php 
$id=$_GET['id_siswa'];
$siswa=mysqli_query($conn,"select * from tbl_siswa where id_siswa='$id'");
$data_siswa=mysqli_fetch_array($siswa); 
?>

<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=edit_profil&id_siswa=<?php echo $row_data['id_siswa'];?>" class="w3-bar-item w3-disabled"><i>Profil Siswa</i></a>
</div>
<br>

    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Edit Profil Siswa</h4>
                <hr class="w3-clear">
                <form name="simpan" method="post" enctype="multipart/form-data">  
                    <div class="w3-row">
                        <div class="w3-col m6 w3-row-padding">
                            <input type="text" name="nis" value="<?php echo $data_siswa['nis'];?>" placeholder="Masukkan NIS" class="w3-input w3-margin-bottom">
                            <input type="text" name="nama" value="<?php echo $data_siswa['nama'];?>" placeholder="Masukkan Nama Siswa" class="w3-input w3-margin-bottom">
                            <select name="jenis_kelamin" class="w3-input w3-margin-bottom">
                                <option value="<?php echo $data_siswa['jenis_kelamin'];?>"><?php echo $data_siswa['jenis_kelamin'];?></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <input type="text" name="alamat" value="<?php echo $data_siswa['alamat'];?>" class="w3-input w3-margin-bottom" placeholder="Alamat">
                            <img src="../Administrator/siswa_photo/<?php echo $data_siswa['photo'];?>" class="w3-margin-bottom" alt="Photo" style="width:100px;height:100px;"> 
                            <input type="file" name="photo" class="w3-input w3-margin-bottom">
                            
                        </div>
                        <div class="w3-col m6 w3-row-padding">
                            <select name="id_kelas" class="w3-input w3-margin-bottom">
                                <?php 
                                    $kelas=mysqli_query($conn,"select * from tbl_kelas where id_kelas='$data_siswa[id_kelas]'");
                                    $data_kelas=mysqli_fetch_array($kelas);
                                ?>
                                <option value="<?php echo $data_kelas['id_kelas'];?>"><?php echo $data_kelas['nama_kelas'];?></option>
                                <?php 
                                        $sql=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                                        while($data=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $data['id_kelas'];?>"><?php echo $data['nama_kelas'];?></option>
                                            <?php
                                        }
                                ?>
                            </select>
                            <input type="text" name="username" value="<?php echo $data_siswa['username'];?>" placeholder="Nama Pengguna" class="w3-input w3-margin-bottom">
                            <input type="text" name="password" value="<?php echo $data_siswa['password'];?>" placeholder="Kata Sandi" class="w3-input w3-margin-bottom">
                            <input type="text" name="no_telepon" value="<?php echo $data_siswa['no_telepon'];?>" class="w3-input w3-margin-bottom" placeholder="No. Telepon/Hp" class="w3-input">
                            
                            <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            <a href="?page=home" class="w3-button w3-red"><i class="fas fa-times    "></i> Batal</a>
                        </div>
                    </div>                   
                </form>
                <?php
                if(isset($_POST['simpan'])){
                    $nis            = $_POST['nis']; 
                    $nama           = $_POST['nama'];
                    $jenis_kelamin  = $_POST['jenis_kelamin'];
                    $id_kelas       = $_POST['id_kelas'];
                    $alamat         = $_POST['alamat'];
                    $no_telepon     = $_POST['no_telepon'];
                    $username       = $_POST['username'];
                    $password       = $_POST['password'];
                        
                    // upload photo
                    $file_upload        = $_FILES['photo']['name'];
                    $tmp                = $_FILES['photo']['tmp_name'];
                    $file_upload_baru   = date('dmYHis').$file_upload;
                    $path               = "../Administrator/siswa_photo/".$file_upload_baru;

                    if($tmp=="" and $file_upload==""){
                        $simpan=mysqli_query($conn,"UPDATE tbl_siswa SET nis='$nis',nama='$nama',id_kelas='$id_kelas',jenis_kelamin='$jenis_kelamin',alamat='$alamat',no_telepon='$no_telepon',username='$username',password='$password' where id_siswa='$id'");
                        if($simpan){
                            ?>
                            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                <h3>Terima Kasih!</h3>
                                <p>Proses Ubah Data Berhasil</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=home")',2000);
                            </script>
                            <?php
                        }else{
                            ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Proses Ubah Data Gagal</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=home")',2000);
                            </script>
                            <?php
                        }
                    }else{
                        if(move_uploaded_file($tmp, $path)){ 
                            $query = "SELECT * FROM tbl_siswa WHERE id_siswa='$id'";
                            $q = mysqli_query($conn, $query);
                            $dt = mysqli_fetch_array($q); 
                            if(is_file("../Administrator/siswa_photo/".$dt['photo'])) unlink("../Administrator/siswa_photo/".$dt['photo']);
                            $simpan=mysqli_query($conn,"UPDATE tbl_siswa SET nis='$nis',nama='$nama',id_kelas='$id_kelas',jenis_kelamin='$jenis_kelamin',alamat='$alamat',no_telepon='$no_telepon',photo='$file_upload_baru',username='$username',password='$password' where id_siswa='$id'");
                            if($simpan){
                                ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=home")',2000);
                                </script>
                                <?php
                            }else{
                                ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=home")',2000);
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="w3-panel w3-blue w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Tidak Ada Photo Yang Diupload</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=home")',2000);
                            </script>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>