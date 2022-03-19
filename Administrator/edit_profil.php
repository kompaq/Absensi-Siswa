<style>
img{
  width:50%;
}
</style>
<div class="w3-row-padding">
  <div class="w3-col m12 card-box ">

  <?php 
$id_guru = $_GET['id_guru'];
$cariakun =  mysqli_query($conn, "SELECT * FROM tbl_guru WHERE id_guru='$id_guru'");
$data_array =  mysqli_fetch_array($cariakun);
if(isset($_POST['edit'])){
  $nama           = $_POST['nama'];
  $nama_pengguna  = $_POST['nama_pengguna'];
  $kata_sandi     = $_POST['kata_sandi'];
  // upload photo
  $file_upload        = $_FILES['photo']['name'];
  $tmp                = $_FILES['photo']['tmp_name'];
  $file_upload_baru   = date('dmYHis').$file_upload;
  $path               = "guru_photo/".$file_upload_baru;

  if($tmp=="" and $file_upload==""){
    $simpan=mysqli_query($conn,"UPDATE tbl_guru SET nama='$nama', nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi' where id_guru='$id_guru'");
    if($simpan){
      ?>
      <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
        <h3>Terima Kasih!</h3>
        <p>Proses Ubah Data Berhasil</p>
      </div>
      <?php
    }else{
      ?>
      <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
        <h3>Maaf!</h3>
        <p>Proses Ubah Data Gagal</p>
      </div>
      <?php
    }
  }else{
    if(move_uploaded_file($tmp, $path)){ 
      $query = "SELECT * FROM tbl_guru WHERE id_guru='$id_guru'";
      $q = mysqli_query($conn, $query);
      $dt = mysqli_fetch_array($q); 
      if(is_file("guru_photo/".$dt['photo'])) unlink("guru_photo/".$dt['photo']);                   
      $simpan=mysqli_query($conn,"UPDATE tbl_guru SET nama='$nama', nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi', photo='$file_upload_baru' where id_guru='$id_guru'");
      if($simpan){
        ?>
        <div class="w3-panel w3-green w3-container animate__animated animate__zoomIn">
          <h3>Terima Kasih!</h3>
          <p>Proses Ubah Data Berhasil</p>
        </div>
        <?php
      }else{
        ?>
        <div class="w3-panel w3-red w3-container animate__animated animate__zoomIn">
          <h3>Maaf!</h3>
          <p>Proses Ubah Data Gagal</p>
        </div>
        <?php
      }
    }else{
      ?>
      <div class="w3-panel w3-blue w3-container animate__animated animate__zoomIn">
        <h3>Maaf!</h3>
        <p>Tidak Ada Photo Yang Diupload</p>
      </div>
      <?php
    }
  }
}
?>

    <div class="w3-round w3-white">
      <div class="w3-container w3-padding">
        <h4>Profil Pengguna</h4>
        <hr class="w3-clear">
        <div class="w3-row">
            <div class="w3-col m3 w3-center w3-margin-bottom">
            <?php 
              if($data_array['photo']==""){
            ?>
              <img src="guru_photo/defauld.png" alt="" srcset="">
            <?php }else{ ?>
              <img src="guru_photo/<?php echo $data_array['photo']; ?>" alt="" srcset="">
            <?php } ?>
            </div>
            <div class="w3-col m9">
              <form name="edit" method="post" enctype="multipart/form-data">
                <input type="text" name="nama" required placeholder="Nama Admin" id="" value="<?php echo $data_array['nama'];?>" class="w3-input w3-margin-bottom">
                <input type="text" name="nama_pengguna" required placeholder="Nama Pengguna" value="<?php echo $data_array['nama_pengguna']; ?>" class="w3-input w3-margin-bottom">
                <input type="text" name="kata_sandi" required placeholder="Kata Sandi" value="<?php echo $data_array['kata_sandi']; ?>" class="w3-input w3-margin-bottom">
                <input type="file" name="photo" class="w3-input w3-animate-input w3-margin-bottom">
                <button type="submit" name="edit" class="w3-button w3-teal"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="?page=home" class="w3-button w3-red"><i class="fas fa-times"></i> Batal</a>
              </form>
            </div>
        </div>
        <hr class="w3-clear">
        
      </div>
    </div>
  </div>
</div>