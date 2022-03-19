<?php include '../koneksi.php'; ?>
<table class="w3-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Hadir</th>
            <th>Alpa</th>
            <th>Sakit</th>
            <th>Izin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $page = (isset($_POST['page']))? $_POST['page'] : 1;
        $limit = 25; 
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;
        $query = mysqli_query($conn,"SELECT * FROM tbl_siswa ORDER BY id_siswa ASC LIMIT $limit_start, $limit");
        while ($row = mysqli_fetch_array($query)) {
            $id_siswa = $row['0'];
            //nama siswa dari tabel siswa
            $siswa=mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE id_siswa='$id_siswa'");
            $data_siswa=mysqli_fetch_array($siswa);
            $nis    = $data_siswa['nis'];
            $nama   = $data_siswa['nama'];
            //kelas siswa dari tabel kelas
            $id_kelas= $data_siswa['id_kelas'];
            $kelas = mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$id_kelas'");
            $data_kelas=mysqli_fetch_array($kelas);
            $nama_kelas=$data_kelas['nama_kelas'];
            //jumlah hadir
            $hadir=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Hadir'");
            $jumlah_hadir=mysqli_num_rows($hadir);
            //jumlah sakit
            $sakit=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Sakit'");
            $jumlah_sakit=mysqli_num_rows($sakit);
            //jumlah izin
            $izin=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Izin'");
            $jumlah_izin=mysqli_num_rows($izin);
            //jumlah alpa
            $alpa=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Alpa'");
            $jumlah_alpa=mysqli_num_rows($alpa);
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nis; ?></td>
            <td><?php echo $nama; ?></td>
            <td><?php echo $nama_kelas; ?></td>
            <td><?php echo $jumlah_hadir; ?></td>
            <td><?php echo $jumlah_alpa; ?></td>
            <td><?php echo $jumlah_sakit; ?></td>
            <td><?php echo $jumlah_izin; ?></td>
        </tr>
        <?php 
        } 
        ?>
    </tbody>
</table>

                    <?php
                    $query_jumlah = mysqli_query($conn,"SELECT * FROM tbl_absensi");
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