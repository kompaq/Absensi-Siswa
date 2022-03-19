<div class="w3-row-padding">
<div class="w3-bar w3-light-grey">
  <a href="?page=home" class="w3-bar-item"><i class="fas fa-tachometer-alt"></i> Beranda</a>
  <a href="?page=histori" class="w3-bar-item w3-disabled"><i>Histori</i></a>
</div>
<br>
<div class="w3-col m12 card-box ">
    <div class="w3-round w3-white">
        <div class="w3-container w3-padding">
            <h5>Histori Absensi</h5>
            <hr class="w3-clear">
            <table class="w3-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Hari/Tanggal</th>
                        <th>Status Kehadiran</th>
                    </tr>
                </thead>                
                <tbody>
                <?php
                $no=1;
                $query = mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$row_data[id_siswa]'");
                while ($row = mysqli_fetch_array($query)) {
                    $id_siswa = $row['0'];
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
                        <td><?php echo $row['hari'].", ".$row['tanggal']; ?></td>
                        <td><?php echo $row['keterangan']; ?></td>
                    </tr>
                <?php 
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
