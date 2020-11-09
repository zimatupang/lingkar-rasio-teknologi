<?php
$host = mysqli_connect("localhost", "root", "");

// if($host){
//     echo "koneksi host BERHASIL. <br/>";
// }else{
//     echo "koneksi host GAGAL";
// }

$db = mysqli_select_db($host, "lingkar_rasio_teknologi");

// if($db){
//     echo "koneksi database BERHASIL.";
// }else{
//     echo "koneksi database GAGAL.";
// }
?>