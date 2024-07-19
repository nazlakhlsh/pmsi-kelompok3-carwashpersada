<?php
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "carwash-persada";

$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);
if(!$koneksi){
    die("Koneksi gagal:".mysqli_connect_error());
}
?>