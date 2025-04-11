<?php

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

            $id = $_GET['id_shift'];
            $queryHapus = mysqli_query($koneksi,"DELETE FROM shift_kerja WHERE id_shift='$id'");
            if ($queryHapus) {
                echo "<script> alert('Data Shift Kerja berhasil Dihapus'); window.location = '../../sudimin.php?module=data_shift';</script>";
            } else {
                echo "<script> alert('Data Shift Kerja Gagal Dihapus'); window.location = '../../sudimin.php?module=data_shift';</script>";
            }
	

}
?>
