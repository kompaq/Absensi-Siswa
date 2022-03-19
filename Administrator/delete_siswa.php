<?php 
$id=$_GET['id_siswa'];
$siswa=mysqli_query($conn,"select * from tbl_siswa where id_siswa='$id'");
$row=mysqli_fetch_array($siswa); 
?>

<div class="w3-row-padding">
    <div class="w3-col m12 card-box ">
        <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
                <h4>Data Siswa</h4>
                <hr class="w3-clear">
            </div>  
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#id01").show();
});
</script>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content  animate__animated animate__zoomIn" style="width:50vmax;border-radius:10px;">
        <header class="w3-container w3-padding w3-center w3-margin-bottom"> 
            
        </header>
            <div class="w3-container">
                <div class="w3-row">
                    <div class="w3-col s3">
                        <img src="siswa_photo/<?php echo $row['photo'];?>" class="w3-circle" alt="Photo" style="width:100px;height:100px;">
                    </div>
                    <div class="w3-col s3">
                        Nama Lengkap <br>
                        Nomor Induk <br>
                        Jenis Kelamin
                    </div>
                    <div class="w3-col s1">
                        : <br>
                        : <br>
                        :
                    </div>
                    <div class="w3-col s5">
                        <?php echo $row['nama'];?> <br>
                        <?php echo $row['nis'];?> <br>
                        <?php echo $row['jenis_kelamin'];?>
                    </div>
                </div>
            </div>
        <footer class="w3-container w3-margin-top w3-center">
            <hr class="w3-clear">
            <h3>Apakah Anda Yakin Akan Menghapus Data Diatas...?</h3>
            <div class="w3-bar w3-margin-bottom">
                <a href="?page=data_siswa&delete=<?php echo $row['id_siswa'];?>" class="w3-button w3-teal">Ya</a>
                <a href="?page=data_siswa" class="w3-button w3-red">Tidak</a>
            </div>
        </footer>
    </div>
</div>