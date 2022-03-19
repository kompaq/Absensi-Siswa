<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=data_jurusan" class="w3-bar-item w3-disabled"><i>Data Jurusan</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Data Jurusan</h4>
                <hr class="w3-clear">
                <?php 
                if(isset($_GET['tambah'])){
                    ?>
                        <h5>Formulir Tambah Data Jurusan</h5>
                        <hr class="w3-clear">
                        <form name="simpan" method="post">
                            <input type="text" name="nama_jurusan" placeholder="Nama Jurusan" class="w3-input w3-margin-bottom">
                            <input type="text" name="kepala_jurusan" placeholder="Kepala Jurusan" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                            <button type="submit" name="simpan" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan</button>
                            <a href="?page=data_jurusan" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $nama_jurusan   = $_POST['nama_jurusan'];
                        $kepala_jurusan = $_POST['kepala_jurusan'];
                        $keterangan     = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"INSERT INTO tbl_jurusan VALUES('','$nama_jurusan','$kepala_jurusan','$keterangan')");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Simpan Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_jurusan")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Simpan Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_jurusan")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_jurusan WHERE id_jurusan='$id'");
                    $data_jurusan=mysqli_fetch_array($cari);
                    ?>
                        <h5>Formulir Edit Data Jurusan</h5>
                        <hr class="w3-clear">
                        <form name="ubah" method="post">
                            <input type="text" name="nama_jurusan" value="<?php echo $data_jurusan['nama_jurusan'] ?>" placeholder="Nama Jurusan" class="w3-input w3-margin-bottom">
                            <input type="text" name="kepala_jurusan" value="<?php echo $data_jurusan['kepala_jurusan'] ?>" placeholder="Kepala Jurusan" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" value="<?php echo $data_jurusan['keterangan'] ?>" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                            <button type="submit" name="ubah" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            <a href="?page=data_jurusan" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['ubah'])){
                        $nama_jurusan   = $_POST['nama_jurusan'];
                        $kepala_jurusan = $_POST['kepala_jurusan'];
                        $keterangan     = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"UPDATE tbl_jurusan SET nama_jurusan='$nama_jurusan',kepala_jurusan='$kepala_jurusan',keterangan='$keterangan' WHERE id_jurusan='$id'");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_jurusan")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_jurusan")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['delete'])){
                    $id=$_GET['delete'];
                    $hapus=mysqli_query($conn,"DELETE FROM tbl_jurusan WHERE id_jurusan='$id'");
                    if($hapus){
                        ?>
                            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                <h3>Terima Kasih!</h3>
                                <p>Proses Hapus Data Berhasil</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=data_jurusan")',2000);
                            </script>
                        <?php 
                    }else{
                        ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Proses Hapus Data Gagal</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=data_jurusan")',2000);
                            </script>
                        <?php 
                    }
                }else{
                    ?>
                        <div class="w3-responsive w3-margin-bottom">
                            <a href="?page=data_jurusan&tambah" class="w3-button w3-blue"><i class="fas fa-plus"></i> Tambah Data</a>
                            <hr class="w3-clear">
                            <table class="w3-table-all">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <th>Kepala Jurusan</th>
                                        <th>Keterangan</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no=1;
                                    $tabel_sql=mysqli_query($conn,"SELECT * FROM tbl_jurusan");
                                    while($data_tabel=mysqli_fetch_array($tabel_sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $data_tabel['nama_jurusan'];?></td>
                                            <td><?php echo $data_tabel['kepala_jurusan'];?></td>
                                            <td><?php echo $data_tabel['keterangan'] ?></td>
                                            <td>
                                                <a href="?page=data_jurusan&edit=<?php echo $data_tabel['id_jurusan'];?>" class="w3-text-green w3-margin-right" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="?page=data_jurusan&delete=<?php echo $data_tabel['id_jurusan'];?>" class="w3-text-red" onclick="return confirm('Apakah Anda Akan Menghapus Data ini...?');" title="Hapus Data"><i class="fas fa-trash"></i></a>
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