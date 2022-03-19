<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=jadwal" class="w3-bar-item w3-disabled"><i>Data Jadwal</i></a>
</div>
<br>
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Data Jadwal</h4>
                <hr class="w3-clear">
                <?php 
                if(isset($_GET['tambah'])){
                    ?>
                        <h5>Formulir Tambah Data Jadwal</h5>
                        <hr class="w3-clear">
                        <form name="simpan" method="post">
                            <div class="w3-row">
                                <div class="w3-col s5">
                                    <select name="hari" class="w3-input w3-margin-bottom">
                                        <option value="Pilih">Pilih Hari</option>
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                        <option>Minggu</option>
                                    </select>
                                    <select name="id_mapel" class="w3-input w3-margin-bottom">
                                        <option value="">Pilih Mapel</option>
                                        <?php 
                                        $mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel");
                                        while($data_mapel=mysqli_fetch_array($mapel)){
                                            ?>
                                            <option value="<?php echo $data_mapel['id_mapel'];?>"><?php echo $data_mapel['nama_mapel'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select name="id_kelas" class="w3-input w3-margin-bottom">
                                        <option value="">Pilih Kelas</option>
                                        <?php 
                                        $kelas=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                                        while($data_kelas=mysqli_fetch_array($kelas)){
                                            ?>
                                            <option value="<?php echo $data_kelas['id_kelas'];?>"><?php echo $data_kelas['nama_kelas'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="text" name="tahun_ajaran" class="w3-input w3-margin-bottom" placeholder="Tahun Ajaran">
                                    <select name="semester" class="w3-input w3-margin-bottom">
                                        <option value="Pilih">Semester</option>
                                        <option>Ganjil</option>
                                        <option>Genap</option>
                                    </select>
                                </div>
                                <div class="w3-col s1 w3-padding"></div>
                                <div class="w3-col s4">
                                    <span>Jam Masuk</span>
                                    <input type="text" name="jam_masuk" class="w3-input w3-margin-bottom" placeholder="00.00">
                                    <span>Jam Keluar</span>
                                    <input type="text" name="jam_keluar" class="w3-input w3-margin-bottom" placeholder="00.00">
                                    <button type="submit" name="simpan" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="?page=jadwal" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                                </div>
                            </div>                            
                        </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $hari           = $_POST['hari'];
                        $jam_masuk      = $_POST['jam_masuk'];
                        $jam_keluar     = $_POST['jam_keluar'];
                        $id_mapel       = $_POST['id_mapel'];
                        $id_kelas       = $_POST['id_kelas'];
                        $tahun_ajaran   = $_POST['tahun_ajaran'];
                        $semester       = $_POST['semester'];
                        $simpan=mysqli_query($conn,"INSERT INTO tbl_jadwal VALUES('','$hari','$jam_masuk','$jam_keluar','$id_mapel','$id_kelas','$tahun_ajaran','$semester')");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Simpan Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=jadwal")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Simpan Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=jadwal")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $cari=mysqli_query($conn,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$id'");
                    $jadwal=mysqli_fetch_array($cari);
                    ?>
                        <h5>Formulir Edit Data Jadwal</h5>
                        <hr class="w3-clear">
                        <form name="ubah" method="post">
                            <div class="w3-row">
                                <div class="w3-col s5">
                                    <select name="hari" class="w3-input w3-margin-bottom">
                                        <option value="<?php echo $jadwal['hari'];?>"><?php echo $jadwal['hari'];?></option>
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                        <option>Minggu</option>
                                    </select>
                                    <select name="id_mapel" class="w3-input w3-margin-bottom">
                                        <option value="<?php echo $jadwal['id_mapel'];?>">
                                            <?php
                                            $lihat_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$jadwal[id_mapel]'");
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
                                    <select name="id_kelas" class="w3-input w3-margin-bottom">
                                        <option value="<?php echo $jadwal['id_kelas'];?>">
                                            <?php
                                            $lihat_kelas=mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$jadwal[id_kelas]'");
                                            $kelas_array=mysqli_fetch_array($lihat_kelas);
                                            echo $kelas_array['nama_kelas'];
                                            ?>
                                        </option>
                                        <?php 
                                        $kelas=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                                        while($data_kelas=mysqli_fetch_array($kelas)){?>
                                            <option value="<?php echo $data_kelas['id_kelas'];?>"><?php echo $data_kelas['nama_kelas'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="text" name="tahun_ajaran" value="<?php echo $jadwal['tahun_ajaran'];?>" class="w3-input w3-margin-bottom" placeholder="Tahun Ajaran">
                                    <select name="semester" class="w3-input w3-margin-bottom">
                                        <option value="<?php echo $jadwal['semester'];?>"><?php echo $jadwal['semester'];?></option>
                                        <option>Ganjil</option>
                                        <option>Genap</option>
                                    </select>
                                </div>
                                <div class="w3-col s1 w3-padding"></div>
                                <div class="w3-col s4">
                                    <span>Jam Masuk</span>
                                    <input type="text" name="jam_masuk" value="<?php echo $jadwal['jam_masuk'];?>" class="w3-input w3-margin-bottom" placeholder="00.00">
                                    <span>Jam Keluar</span>
                                    <input type="text" name="jam_keluar" value="<?php echo $jadwal['jam_keluar'];?>" class="w3-input w3-margin-bottom" placeholder="00.00">
                                    <button type="submit" name="ubah" class="w3-button w3-teal w3-margin-bottom"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="?page=jadwal" class="w3-button w3-red w3-margin-bottom"><i class="fas fa-times"></i> Batal</a>
                                </div>
                            </div>    
                        </form>
                    <?php
                    if(isset($_POST['ubah'])){
                        $hari           = $_POST['hari'];
                        $jam_masuk      = $_POST['jam_masuk'];
                        $jam_keluar     = $_POST['jam_keluar'];
                        $id_mapel       = $_POST['id_mapel'];
                        $id_kelas       = $_POST['id_kelas'];
                        $tahun_ajaran   = $_POST['tahun_ajaran'];
                        $semester       = $_POST['semester'];
                        $simpan=mysqli_query($conn,"UPDATE tbl_jadwal SET hari='$hari',jam_masuk='$jam_masuk',jam_keluar='$jam_keluar',id_mapel='$id_mapel',id_kelas='$id_kelas',tahun_ajaran='$tahun_ajaran',semester='$semester' WHERE id_jadwal='$id'");
                        if($simpan){
                            ?>
                                <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                    <h3>Terima Kasih!</h3>
                                    <p>Proses Ubah Data Berhasil</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=jadwal")',2000);
                                </script>
                            <?php 
                        }else{
                            ?>
                                <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                    <h3>Maaf!</h3>
                                    <p>Proses Ubah Data Gagal</p>
                                </div>
                                <script>
                                    setTimeout('location.replace("?page=jadwal")',2000);
                                </script>
                            <?php 
                        }
                    }
                }elseif(isset($_GET['delete'])){
                    $id=$_GET['delete'];
                    $hapus=mysqli_query($conn,"DELETE FROM tbl_jadwal WHERE id_jadwal='$id'");
                    if($hapus){
                        ?>
                            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                                <h3>Terima Kasih!</h3>
                                <p>Proses Hapus Data Berhasil</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=jadwal")',2000);
                            </script>
                        <?php 
                    }else{
                        ?>
                            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                                <h3>Maaf!</h3>
                                <p>Proses Hapus Data Gagal</p>
                            </div>
                            <script>
                                setTimeout('location.replace("?page=jadwal")',2000);
                            </script>
                        <?php 
                    }
                }else{
                    ?>
                        <div class="w3-responsive w3-margin-bottom">
                            <a href="?page=jadwal&tambah" class="w3-button w3-blue"><i class="fas fa-plus"></i> Tambah Data</a>
                            <hr class="w3-clear">
                            <table class="w3-table-all">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Jam Pelajaran</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no=1;
                                    $tabel_sql=mysqli_query($conn,"SELECT * FROM tbl_jadwal");
                                    while($data_tabel=mysqli_fetch_array($tabel_sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $data_tabel['hari'];?></td>
                                            <td><?php echo $data_tabel['jam_masuk']. " - " .$data_tabel['jam_keluar'];?></td>
                                            <td>
                                                <?php 
                                                $lihat_mapel=mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$data_tabel[id_mapel]'");
                                                $mapel_array=mysqli_fetch_array($lihat_mapel);
                                                echo $mapel_array['nama_mapel'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $lihat_kelas=mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$data_tabel[id_kelas]'");
                                                $kelas_array=mysqli_fetch_array($lihat_kelas);
                                                echo $kelas_array['nama_kelas'];
                                                ?>
                                            </td>
                                            <td><?php echo $data_tabel['tahun_ajaran'];?></td>
                                            <td><?php echo $data_tabel['semester'] ?></td>
                                            <td>
                                                <a href="?page=jadwal&edit=<?php echo $data_tabel['id_jadwal'];?>" class="w3-text-green w3-margin-right" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="?page=jadwal&delete=<?php echo $data_tabel['id_jadwal'];?>" class="w3-text-red" onclick="return confirm('Apakah Anda Akan Menghapus Data ini...?');" title="Hapus Data"><i class="fas fa-trash"></i></a>
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