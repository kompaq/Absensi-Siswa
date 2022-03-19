<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=data_kelas" class="w3-bar-item w3-disabled"><i>Data Kelas</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Data Kelas</h4>
                <hr class="w3-clear">
                <?php 
                if(isset($_GET['tambah'])){
                    ?>
                        <h5>Formulir Tambah Data kelas</h5>
                        <hr class="w3-clear">
                        <form name="simpan" method="post">
                            <input type="text" name="nama_kelas" placeholder="Nama kelas" class="w3-input w3-margin-bottom">
                            <select name="id_jurusan" class="w3-input w3-margin-bottom">
                                <option value="">Pilih Jurusan</option>
                                <?php 
                                    $jurusan=mysqli_query($conn,"SELECT * FROM tbl_jurusan");
                                    while($data_jurusan=mysqli_fetch_array($jurusan)){
                                        ?><option value="<?php echo $data_jurusan['id_jurusan'];?>"><?php echo $data_jurusan['nama_jurusan'];?></option><?php
                                    }
                                ?>
                            </select>
                            <input type="text" name="ketua_kelas" placeholder="Ketua kelas" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                            <button type="submit" name="simpan" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan</button>
                            <a href="?page=data_kelas" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $nama_kelas     = $_POST['nama_kelas'];
                        $id_jurusan     = $_POST['id_jurusan'];
                        $ketua_kelas    = $_POST['ketua_kelas'];
                        $keterangan     = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"INSERT INTO tbl_kelas VALUES('','$nama_kelas','$id_jurusan','$ketua_kelas','$keterangan')");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Simpan Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_kelas")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Simpan Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_kelas")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$id'");
                    $data_kelas=mysqli_fetch_array($cari);
                    ?>
                        <h5>Formulir Edit Data kelas</h5>
                        <hr class="w3-clear">
                        <form name="ubah" method="post">
                            <input type="text" name="nama_kelas" value="<?php echo $data_kelas['nama_kelas'] ?>" placeholder="Nama kelas" class="w3-input w3-margin-bottom">
                            <select name="id_jurusan" class="w3-input w3-margin-bottom">                                
                                <?php 
                                    $jur=mysqli_query($conn,"SELECT * FROM tbl_jurusan WHERE id_jurusan='$data_kelas[id_jurusan]'");
                                    $dt_jur=mysqli_fetch_array($jur);
                                    ?>
                                    <option value="<?php echo $dt_jur['id_jurusan'];?>"><?php echo $dt_jur['nama_jurusan'] ?></option>
                                    <?php
                                    $jurusan=mysqli_query($conn,"SELECT * FROM tbl_jurusan");
                                    while($data_jurusan=mysqli_fetch_array($jurusan)){
                                        ?><option value="<?php echo $data_jurusan['id_jurusan'];?>"><?php echo $data_jurusan['nama_jurusan'];?></option><?php
                                    }
                                ?>
                            </select>
                            <input type="text" name="ketua_kelas" value="<?php echo $data_kelas['ketua_kelas'] ?>" placeholder="Kepala kelas" class="w3-input w3-margin-bottom">
                            <input type="text" name="keterangan" value="<?php echo $data_kelas['keterangan'] ?>" placeholder="Keterangan" class="w3-input w3-margin-bottom">
                            <button type="submit" name="ubah" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            <a href="?page=data_kelas" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                        </form>
                    <?php
                    if(isset($_POST['ubah'])){
                        $nama_kelas     = $_POST['nama_kelas'];
                        $id_jurusan     = $_POST['id_jurusan'];
                        $ketua_kelas    = $_POST['ketua_kelas'];
                        $keterangan     = $_POST['keterangan'];
                        $simpan=mysqli_query($conn,"UPDATE tbl_kelas SET nama_kelas='$nama_kelas',id_jurusan='$id_jurusan',ketua_kelas='$ketua_kelas',keterangan='$keterangan' WHERE id_kelas='$id'");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_kelas")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=data_kelas")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['delete'])){
                    $id=$_GET['delete'];
                    $hapus=mysqli_query($conn,"DELETE FROM tbl_kelas WHERE id_kelas='$id'");
                    if($hapus){
                        ?>
                            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                <h3>Terima Kasih!</h3>
                                <p>Proses Hapus Data Berhasil</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=data_kelas")',2000);
                            </script>
                        <?php 
                    }else{
                        ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Proses Hapus Data Gagal</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=data_kelas")',2000);
                            </script>
                        <?php 
                    }
                }else{
                    ?>
                        <div class="w3-responsive w3-margin-bottom">
                            <a href="?page=data_kelas&tambah" class="w3-button w3-blue"><i class="fas fa-plus"></i> Tambah Data</a>
                            <hr class="w3-clear">
                            <table class="w3-table-all">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama kelas</th>
                                        <th>Nama Jurusan</th>
                                        <th>Ketua kelas</th>
                                        <th>Keterangan</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no=1;
                                    $tabel_sql=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                                    while($data_tabel=mysqli_fetch_array($tabel_sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $data_tabel['nama_kelas'];?></td>
                                            <td>
                                                <?php 
                                                $jurusan=mysqli_query($conn,"SELECT * FROM tbl_jurusan WHERE id_jurusan='$data_tabel[id_jurusan]'");
                                                $data_jurusan=mysqli_fetch_array($jurusan);
                                                echo $data_jurusan['nama_jurusan'];
                                                ?>
                                            </td>
                                            <td><?php echo $data_tabel['ketua_kelas'];?></td>
                                            <td><?php echo $data_tabel['keterangan'] ?></td>
                                            <td>
                                                <a href="?page=data_kelas&edit=<?php echo $data_tabel['id_kelas'];?>" class="w3-text-green w3-margin-right" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="?page=data_kelas&delete=<?php echo $data_tabel['id_kelas'];?>" class="w3-text-red" onclick="return confirm('Apakah Anda Akan Menghapus Data ini...?');" title="Hapus Data"><i class="fas fa-trash"></i></a>
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