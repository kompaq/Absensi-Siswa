<?php 
include '../koneksi.php';
$id_mapel     = $_POST['id_mapel'];
$sql            = mysqli_query($conn,"select * from tbl_kompetensi where id_mapel='$id_mapel'");
?>
<option value="">Pilih KI-KD</option>
<?php 
while($row_data=mysqli_fetch_array($sql)){
?>
    <option value="<?php echo $row_data['id_kompetensi'];?>">
    <?php echo $row_data['kompetensi_inti'];?>&nbsp; \ &nbsp;
    <i><?php echo $row_data['kompetensi_dasar'];?></i>
    </option>
<?php 
}
?>