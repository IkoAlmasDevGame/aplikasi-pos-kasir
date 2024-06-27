<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$dbname = "pos-kasir";
try {
    $configs = mysqli_connect("localhost", "root", "", $dbname); // sistem biasa
    $konfigs = new PDO("mysql:host=localhost;dbname=$dbname;", "root", ""); // sistem koneksi ke kasir
} catch(Exception $e){
    die("Database gagal terhubung : ".$e->getMessage());
}
?>