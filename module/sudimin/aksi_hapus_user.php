<?php

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

            $id = $_GET['id'];
            $queryHapus = mysqli_query($koneksi,"DELETE FROM user WHERE id='$id'");
            if ($queryHapus) {
                echo "<script> alert('Data User berhasil Dihapus'); window.location = '../../sudimin.php?module=data_user';</script>";
            } else {
                echo "<script> alert('Data User Gagal Dihapus'); window.location = '../../sudimin.php?module=data_user';</script>";
            }
	

}
?>
