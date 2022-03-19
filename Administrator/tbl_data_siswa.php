<?php include '../koneksi.php'; ?>
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
              $page = (isset($_POST['page']))? $_POST['page'] : 1;
              $limit = 10; 
              $limit_start = ($page - 1) * $limit;
              $no = $limit_start + 1;

              $query = mysqli_query($conn,"SELECT * FROM tbl_siswa ORDER BY nama ASC LIMIT $limit_start, $limit");
              while ($row = mysqli_fetch_array($query)) {
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
                                <a href="?page=edit_siswa&id_siswa=<?php echo $row[0];?>" class="w3-button w3-teal"><i class="fas fa-user-edit"></i> Ubah</a>
                                <a href="?page=delete_siswa&id_siswa=<?php echo $row[0];?>" class="w3-button w3-red"><i class="fas fa-trash"></i> Hapus</a>
                                <button onclick="document.getElementById('id<?php echo $row[0];?>').style.display='none'" class="w3-button w3-blue w3-right"><i class="fas fa-times"></i> Tutup</button>
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
          $query_jumlah = mysqli_query($conn,"SELECT * FROM tbl_siswa");
          $total_records =mysqli_num_rows($query_jumlah);
        ?>
        <!--p>Total baris : <?php //echo $total_records; ?></!--p-->
        <div class="w3-clears">
        <hr class="w3-clear">
        <style>
        a{text-decoration:none;}
        </style>
          <ul class="w3-center">
            <?php
              $jumlah_page = ceil($total_records / $limit);
              $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
              $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
              $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
        
              

              if($page == 1){
                echo '<li class="w3-bar-item w3-button w3-border disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>';
                echo '<li class="w3-bar-item w3-button w3-border disabled"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>';
              } else {
                $link_prev = ($page > 1)? $page - 1 : 1;
                echo '<li class="w3-bar-item w3-button w3-border halaman" id="1"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>';
                echo '<li class="w3-bar-item w3-button w3-border halaman" id="'.$link_prev.'"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>';
              }

              for($i = $start_number; $i <= $end_number; $i++){
                $link_active = ($page == $i)? ' w3-teal' : '';
                echo '<li class="w3-bar-item w3-button w3-border halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
              }

              if($page == $jumlah_page){
                echo '<li class="w3-bar-item w3-button w3-border disabled"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
                echo '<li class="w3-bar-item w3-button w3-border disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
              } else {
                $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                echo '<li class="w3-bar-item w3-button w3-border halaman" id="'.$link_next.'"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
                echo '<li class="w3-bar-item w3-button w3-border halaman" id="'.$jumlah_page.'"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
              }
            ?>
          </ul>
        </div>