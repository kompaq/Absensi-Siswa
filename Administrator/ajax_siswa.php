<?php 
include '../koneksi.php';
$id_kelas   = $_GET['id_kelas'];
$sql        = mysqli_query($conn,"select * from tbl_siswa where id_kelas='$id_kelas'");


date_default_timezone_set("Asia/Makassar");
$jam        =date("h:i:s");
//membuat hari tanggal
$a_hari     = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
$hari       = $a_hari[date("N")];
$tanggal    = date ("j");
$a_bulan    = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
$bulan      = $a_bulan[date("n")];
$tahun      = date("Y");
$tgl        = $tanggal. " - " .$bulan. " - " .$tahun;

//cari jadwal
$jadwal     =mysqli_query($conn,"SELECT * FROM tbl_jadwal WHERE hari='$hari' AND id_kelas='$id_kelas'");
$data_jadwal=mysqli_fetch_array($jadwal);
$id_mapel   =$data_jadwal['id_mapel'];
$cari_mapel =mysqli_query($conn,"SELECT * FROM tbl_mapel WHERE id_mapel='$id_mapel'");
$data_mapel =mysqli_fetch_array($cari_mapel);

//cari absen hari ini
$absen_valid_hari   =mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE hari='$hari' AND tanggal='$tgl' AND id_kelas='$id_kelas'");
$cek_absen          =mysqli_num_rows($absen_valid_hari);
if($cek_absen > 0){
?>
    <div class="row w3-bar w3-blue w3-padding">
            <?php echo $hari.", ".$tgl." / ".$data_mapel['nama_mapel'];?>
    </div>
    <hr>
    <ul class="w3-ul">
        <?php     
        $a=0;
        while ($data=mysqli_fetch_array($absen_valid_hari)){
            $siswa=mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE id_siswa='$data[id_siswa]'");
            $data_siswa=mysqli_fetch_array($siswa);
        ?>
        <a href="http://">
        <li style="padding-bottom: 15px;" class="w3-panel w3-pale-bue w3-leftbar w3-border-blue">
            <img src="siswa_photo/<?php echo $data_siswa['photo'];?>" class="w3-left w3-margin-right" style="width:60px;height:60px;">
            <span class="w3-label" style="font-size: 18px;"> <?php echo $data_siswa['nama'];?></span><br>
            <p>Status Kehadiran : <?php echo $data['keterangan']; ?></p>
        </li>
        </a>
        <?php 
        $a++;
        }
        ?>        
    </ul>
<?php 
}else{
?>
    <form name="simpan" action="?page=ajax_siswa&id_kelas=<?php echo $id_kelas;?>" method="post">
        <div class="row w3-bar w3-teal w3-padding">
            <?php echo $hari.", ".$tgl." / ".$data_mapel['nama_mapel'];?>
        </div>
        <hr>
        <ul class="w3-ul">
        <?php     
        $a=0;
        while ($data=mysqli_fetch_array($sql)){
        ?>
            <li style="padding-bottom: 15px;" class="w3-panel w3-pale-green w3-leftbar w3-border-green ">
                <input type="text" name="id_siswa[]" class="w3-hide"  value="<?php echo $data['id_siswa']?>" />
                <img src="siswa_photo/<?php echo $data['photo'];?>" class="w3-left w3-margin-right" style="width:60px;height:60px;">
                <span class="w3-label" style="font-size: 18px;"> <?php echo $data['nama'];?></span><br>
                <input class="w3-radio" type="radio" name="keterangan[]<?php echo $a;?>" value="Hadir" required=""> Hadir
                <input class="w3-radio" type="radio" name="keterangan[]<?php echo $a;?>" value="Alpa" required=""> Alpa
                <input class="w3-radio" type="radio" name="keterangan[]<?php echo $a;?>" value="Sakit" required=""> Sakit
                <input class="w3-radio" type="radio" name="keterangan[]<?php echo $a;?>" value="Izin" required=""> Izin
                <?php 
                $a++;
                }
                ?>
            </li>
        </ul>
        <hr>
        <button class="w3-button w3-teal" type="submit" name="simpan" onclick="return confirm('Apakah Anda Sudah Mengabsen Semua Siswa...?');">
            <i class="fas fa-save"></i> Simpan Absensi 
        </button>
    </form>
<?php 
}
?>
<?php
//simpan absen
if(isset($_POST['simpan'])){
    $id_siswa   = $_POST['id_siswa'];
    $ket        = $_POST['keterangan'];
    $id_mapel   = $data_mapel['id_mapel'];
    $a_hari     = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
    $hari       = $a_hari[date("N")];
    $tanggal    = date ("j");
    $a_bulan    = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
    $bulan      = $a_bulan[date("n")];
    $tahun      = date("Y");
    $tgl        = $tanggal. " - " .$bulan. " - " .$tahun;
    $count      = count($id_siswa);
    $sql        = "INSERT INTO tbl_absensi (id_absen,id_siswa,id_kelas,id_mapel,hari,tanggal,keterangan) VALUES";
    for( $i=0; $i < $count; $i++ )
    {
        $sql .= "('','{$id_siswa[$i]}','$id_kelas','$id_mapel','$hari','$tgl','{$ket[$i]}')";
        $sql .= ",";
    } 
    $sql = rtrim($sql,",");
    //$insert = $conn->query($sql);
    $insert=mysqli_query($conn,$sql);

    if($insert)
    {
        ?>
            <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
                <h3>Terima Kasih!</h3>
                <p>Proses Absensi Berhasil</p>
            </div>
            <script>
                setTimeout('location.replace("?page=absen")',2000);
            </script>            
        <?php 
    }else{
        ?>
            <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
                <h3>Maaf!</h3>
                <p>Proses Absensi Gagal</p>
            </div>
            <script>
                setTimeout('location.replace("?page=absen")',2000);
            </script>
        <?php
    }
}
?>