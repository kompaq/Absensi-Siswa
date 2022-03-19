
<?php 
include_once "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style2.css" />
    <script src="assets/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <title>Login Siswa</title>
  </head>
  <body>
    <div class="container" id="container">

        <div class="form-container sign-up-container">
            <form name="create" method="post">
                <h1>Registrasi Akun</h1>
                <!--div-- class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </!--div>
                <span>or use your email for registration</span -->
                <input type="text" name="nis" placeholder="Nomor Induk Siswa" />
                <input type="text" name="nama" placeholder="Nama Lengkap" />
                <select name="id_kelas">
                    <option value="">Pilih Kelas</option>
                    <?php 
                        $sql=mysqli_query($conn,"SELECT * FROM tbl_kelas");
                        while($data=mysqli_fetch_array($sql)){
                            ?>
                            <option value="<?php echo $data['id_kelas'];?>"><?php echo $data['nama_kelas'];?></option>
                            <?php
                        }
                    ?>
                </select>
                <input type="text" name="username" placeholder="Nama Pengguna" />
                <input type="text" name="password" placeholder="Kata Sandi" />
                <button type="submit" name="create">Registrasi</button>
                <?php 
                    if(isset($_POST['create'])){
                        $nis            = $_POST['nis'];
                        $nama           = $_POST['nama'];
                        $id_kelas       = $_POST['id_kelas'];
                        $nama_pengguna  = $_POST['username'];
                        $kata_sandi  = $_POST['password'];
                        $simpan=mysqli_query($conn,"INSERT INTO tbl_siswa VALUES('','$nis','$nama','$id_kelas','','','','','$nama_pengguna','$kata_sandi','Siswa')");
                        if($simpan){
                            ?>
                            <script>alert('Selamat Registasi Berhasil, silahkan masuk dengan akun anda');</script>
                            <?php 
                        }else{
                            ?>
                            <div class="alerts">
                                <strong>Maaf</strong> Terjadi Kesalahan Pada Database, coba lagi!
                            </div>
                            <?php
                        }
                    }
                ?>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form name="login" method="post">
                <h1>Masuk</h1>
                <!--div-- class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </-div>
                <span>or use your account</span -->
                <input type="text" name="username" placeholder="Nama Pengguna" required/>
                <input type="text" name="password" placeholder="Kata Sandi" required/>
                <button type="submit" name="login">Lanjut</button>
                <?php 
                    if(isset($_POST['login'])){
                        $nama_pengguna  = $_POST['username'];
                        $kata_sandi  = $_POST['password'];
                        $_SESSION['username'] = $_REQUEST['username'];
                        $query=mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE username='$nama_pengguna' AND password='$kata_sandi'");
                        $cek_login = mysqli_num_rows($query);
                        if($cek_login > 0){
                            header('location:Siswa/index.php?page=home');
                        }else{
                            ?>
                            <div class="alerts">
                                <strong>Maaf</strong> Akun anda salah silahkan, coba lagi!
                            </div>
                            <?php
                        }
                    }
                ?>
            </form>
            
        </div>

        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <h1>Hallo!</h1>
                    <p>Apakah anda sudah memiliki akun...? jika sudah silahkan tekan tombol Masuk dibawah ini</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>Hello!</h1>
                    <p>Apakah anda belum memiliki akun...? jika belum silahkan tekan tombol Registrasi dibawah ini dan lengkapi data anda</p>
                    <button class="ghost" id="signUp">Registrasi</button>
                </div>

            </div>
        </div>
    </div>
    
    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
    </script>

</body>
</html>
