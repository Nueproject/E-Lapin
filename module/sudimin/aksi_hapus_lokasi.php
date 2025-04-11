<?php

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

            $id = $_GET['id_lokasi'];
            $queryHapus = mysqli_query($koneksi,"DELETE FROM kantor WHERE id_kantor='$id'");
            if ($queryHapus) {
                echo "<script> alert('Data Lokasi berhasil Dihapus'); window.location = '../../sudimin.php?module=data_lokasi';</script>";
            } else {
                echo "<script> alert('Data Lokasi Gagal Dihapus'); window.location = '../../sudimin.php?module=data_lokasi';</script>";
            }
	

}
?>
