<?php
// definisikan koneksi ke database
$server = "localhost";
$username = "ldbncnzn_admin";
$password = "Kanreg1!";
$database = "ldbncnzn_elapin";

// Koneksi dan memilih database di server

$koneksi = mysqli_connect($server,$username,$password) or die("Koneksi gagal");
mysqli_select_db($koneksi, $database) or die("Database tidak bisa dibuka");

?>
