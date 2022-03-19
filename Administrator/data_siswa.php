<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=data_siswa" class="w3-bar-item w3-disabled"><i>Data Siswa</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Tabel Data Siswa</h4>                    
                    <hr class="w3-clear">
                    <form method="post" name="cari" class="w3-row-padding">
                        <div class="w3-col s3">
                            <a href="?page=data_siswa&Tambah" class="w3-button w3-teal"><i class="fas fa-user-plus"></i> Tambah Data</a>
                        </div>
                        <div class="w3-col s5">
                            <input type="text" name="cari_nama" placeholder="Tulis Nama Untuk Mencari" class="w3-input">
                        </div>
                        <div class="w3-col s4">
                            <button type="submit" name="cari" class="w3-button w3-blue"><i class="fas fa-search"></i> Cari</button>
                            <a href="?page=data_siswa" class="w3-button w3-green"><i class="fas fa-clone"></i> Segarkan</a>
                        </div>
                    </form>
                <hr class="w3-clear">

                <?php
                if(isset($_POST['cari'])){
                    $cari_nama=$_POST['cari_nama'];
                    $sql_query=mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE nama LIKE '%$cari_nama%'");
                    $cek_data=mysqli_num_rows($sql_query);                    
                    if($cek_data == 0){
                        ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__fadeIn">
                                <h3>Maaf!</h3>
                                <p>Data Yang Anda Cari Tidak Ditemukan</p>
                            </div>
                        <?php
                    }else{
                        ?>
                        <table class="w3-table-all">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Menu</th>
                                </tr>  
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                while($row=mysqli_fetch_array($sql_query)){
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row["nis"]; ?></td>
                                    <td><?php echo $row["nama"]; ?></td>
                                    <td><?php echo $row["jenis_kelamin"]; ?></td>
                                    <td>
                                        <?php 
                                            $kelas=mysqli_query($conn,"select * from tbl_kelas where id_kelas=$row[id_kelas]");
                                            $data_kelas=mysqli_fetch_array($kelas);
                                            echo $data_kelas['nama_kelas'];
                                        ?>
                                    </td>
                                    <td>
                                        <button onclick="document.getElementById('id<?php echo $row[0];?>').style.display='block'" class="w3-button w3-teal"><i class="fas fa-street-view"></i></button>
                                        <!-- The Modal -->
                                        <div id="id<?php echo $row[0];?>" class="w3-modal">
                                            <div class="w3-modal-content  animate__animated animate__fadeInDown" style="width:30vmax;border-radius:10px;">
                                            <header class="w3-container w3-padding w3-center w3-margin-bottom"> 
                                                <img src="siswa_photo/<?php echo $row['photo'];?>" class="w3-circle" alt="Photo" style="width:150px;height:150px;">
                                            </header>
                                            <div class="w3-container">
                                                <div class="w3-row">
                                                    <div class="w3-col s5">
                                                        Nama Lengkap <br>
                                                        Nomor Induk <br>
                                                        Jenis Kelamin
                                                    </div>
                                                    <div class="w3-col s1">
                                                        : <br>
                                                        : <br>
                                                        :
                                                    </div>
                                                    <div class="w3-col s6">
                                                        <?php echo $row['nama'];?> <br>
                                                        <?php echo $row['nis'];?> <br>
                                                        <?php echo $row['jenis_kelamin'];?>
                                                    </div>
                                                </div>
                                            </div>
                                            <footer class="w3-container w3-margin-top">
                                                <div class="w3-bar w3-margin-bottom">
                                                    <a href="?page=edit_siswa&id_siswa=<?php echo $row[0];?>" class="w3-button w3-teal">Ubah</a>
                                                    <a href="?page=delete_siswa&id_siswa=<?php echo $row[0];?>" class="w3-button w3-red">Hapus</a>
                                                    <button onclick="document.getElementById('id<?php echo $row[0];?>').style.display='none'" class="w3-button w3-blue w3-right">Tutup</button>
                                                </div>
                                            </footer>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php
                    }
                }elseif(isset($_GET['Tambah'])){
                ?>
                    <h4>Data Siswa</h4>
                    <hr class="w3-clear">
                    <form name="simpan" method="post" enctype="multipart/form-data">  
                        <div class="w3-row">
                            <div class="w3-col m6 w3-row-padding">
                                <input type="text" name="nis" placeholder="Masukkan NIS" class="w3-input w3-margin-bottom">
                                <input type="text" name="nama" placeholder="Masukkan Nama Siswa" class="w3-input w3-margin-bottom">
                                <select name="jenis_kelamin" class="w3-input w3-margin-bottom">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <input type="text" name="alamat" class="w3-input w3-margin-bottom" placeholder="Alamat">
                                <input type="text" name="no_telepon" class="w3-input w3-margin-bottom" placeholder="No. Telepon/Hp" class="w3-input">
                                <input type="file" name="photo" class="w3-input w3-margin-bottom">
                            </div>
                            <div class="w3-col m6 w3-row-padding">                                
                                <select name="id_kelas" class="w3-input w3-margin-bottom">
                                    <option value="">Pilih Kelas</option>
                                    <?php 
                                        $sql=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                                        while($data=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $data['id_kelas'];?>"><?php echo $data['nama_kelas'];?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <input type="text" name="username" placeholder="Nama Pengguna" class="w3-input w3-margin-bottom">
                                <input type="text" name="password" placeholder="Kata Sandi" class="w3-input w3-margin-bottom">

                                <button type="submit" name="simpan" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan</button>
                                <a href="?page=data_siswa" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>
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
                        $path               = "siswa_photo/".$file_upload_baru;

                        if($tmp=="" and $file_upload==""){
                            $simpan=mysqli_query($conn,"INSERT INTO tbl_siswa VALUES('','$nis','$nama','$id_kelas','$jenis_kelamin','$alamat','$no_telepon','','$username','$password','Siswa')");
                            if($simpan){
                                ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                        <h3>Terima Kasih!</h3>
                                        <p>Proses Simpan Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=data_siswa")',2000);
                                    </script>
                                <?php
                            }else{
                                ?>
                                  <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Simpan Data Gagal</p>
                                  </div>
                                  <script>
                                        setTimeout('location.replace("?page=data_siswa")',2000);
                                    </script>
                                <?php
                            }
                          }else{
                            if(move_uploaded_file($tmp, $path)){ 
                                $simpan=mysqli_query($conn,"INSERT INTO tbl_siswa VALUES('','$nis','$nama','$id_kelas','$jenis_kelamin','$alamat','$no_telepon','$file_upload_baru','$username','$password','Siswa')");
                                if($simpan){
                                    ?>
                                    <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                      <h3>Terima Kasih!</h3>
                                      <p>Proses Ubah Data Berhasil</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=data_siswa")',2000);
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                      <h3>Maaf!</h3>
                                      <p>Proses Ubah Data Gagal</p>
                                    </div>
                                    <script>
                                        setTimeout('location.replace("?page=data_siswa")',2000);
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
                                        setTimeout('location.replace("?page=data_siswa")',2000);
                                    </script>
                            <?php
                            }
                          }

                    }

                }elseif(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $query = mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE id_siswa='$id'");
                    $data = mysqli_fetch_array($query); 
                    if(is_file("siswa_photo/".$data['photo'])) unlink ("siswa_photo/".$data['photo']);
                    $query2 = "DELETE FROM tbl_siswa WHERE id_siswa='$id'";
                    $sql = mysqli_query($conn, $query2);
                    if($sql){ 
                        ?>
                        <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                            <h3>Terima Kasih!</h3>
                            <p>Proses Hapus Data Berhasil</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=data_siswa")',2000);
                        </script>
                        <?php 
                    }else{
                        ?>
                        <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                            <h3>Maaf!</h3>
                            <p>Proses Hapus Data Gagal</p>
                        </div>
                        <script>
                            setTimeout('location.replace("?page=data_siswa")',2000);
                        </script>
                        <?php 
                    }
                }else{
                ?>                    
                    <div class="w3-responsive" id="data"></div>  
                    <script>
                        $(document).ready(function(){
                            load_data();
                            function load_data(page){
                                $.ajax({
                                        url:"tbl_data_siswa.php",
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
</div>