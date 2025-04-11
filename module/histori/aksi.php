<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

	
		//SAVE KETERANGAN	
		if(isset($_POST['saveKeterangan'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_absen = $_POST['id_absen'];
			$ket = $_POST['keterangan'];
				
			$updateAbsen = mysqli_query($koneksi, "update absensi SET 				
			keterangan='$ket'
			where id_absen ='".$id_absen."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Keterangan Berhasil di Tambahkan!');
				window.location.href='../../absensi.php?module=histori';
				</script>";
	    
	
		}

		//OPSI ACC LAPORAN
		if(isset($_POST['saveAccLapbul'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_lapbul = $_POST['id_lapbul'];
				
			$updateLapbul = mysqli_query($koneksi, "update lap_bulanan SET 				
			status1='di Setujui'
			where id_lapbul ='".$id_lapbul."'") or die(mysqli_error($koneksi));
			
			echo "<script>
				alert('Laporan Berhasil di Setujui!');
				window.location.href='../../ngadimin.php?module=home';
				</script>";
	      
	
		}

		//OPSI TOLAK LAPORAN	
		if(isset($_POST['saveTolakLapbul'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_lapbul = $_POST['id_lapbul'];
				
			$updateLapbul = mysqli_query($koneksi, "update lap_bulanan SET 				
			status1='di Tolak'
			where id_lapbul ='".$id_lapbul."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Laporan Berhasil di Tolak!');
				window.location.href='../../ngadimin.php?module=home';
				</script>";
	      
	    
	
		}


	






	
