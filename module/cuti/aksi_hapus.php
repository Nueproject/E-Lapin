<?php

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

    $id_cuti = $_GET['id'];
    $queryHapus = mysqli_query($koneksi,"DELETE FROM cuti WHERE id_cuti='$id_cuti'");
    if ($queryHapus) {
        echo "<script> alert('Pengajuan Cuti Berhasil Dihapus'); window.location = '../../adminweb.php?module=cuti';</script>";
    } else {
        echo "<script> alert('Pengajuan Cuti Gagal Dihapus'); window.location = '../../adminweb.php?module=cuti';</script>";
    }
}
?>
