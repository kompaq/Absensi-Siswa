<?php
$host_server    = "localhost";
$name_server    = "root";
$pass_server    = "";
$db_server      = "db_sekolah";

$conn   = mysqli_connect($host_server,$name_server,$pass_server,$db_server);
if($conn){

}else{
    echo"Database Error";
}
?>