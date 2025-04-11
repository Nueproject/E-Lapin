<?php

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

    $id_lap = $_GET['id'];
    $queryHapus = mysqli_query($koneksi,"DELETE FROM data_laporan WHERE id_lap='$id_lap'");
    if ($queryHapus) {
        echo "<script> alert('Data Laporan Berhasil Dihapus'); window.location = '../../adminweb.php?module=kinerja';</script>";
    } else {
        echo "<script> alert('Data Laporan Gagal Dihapus'); window.location = '../../adminweb.php?module=kinerja';</script>";
    }
}
?>
