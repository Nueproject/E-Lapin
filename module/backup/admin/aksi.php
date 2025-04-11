<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

		//OPSI CUTI	ACC
		if(isset($_GET['saveAccCuti'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_cuti = $_GET['id_cuti'];
				
			$updateCuti = mysqli_query($koneksi, "update cuti SET 				
			status_cuti='Di Setujui'
			where id_cuti ='".$id_cuti."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Cuti Berhasil di Setujui!');
				window.location.href='../../ngadimin.php?module=home';
				</script>";	      	
		} 

		//OPSI CUTI	
		if(isset($_POST['saveTolakCuti'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_cuti = $_POST['id_cuti'];
			$tolak = $_POST['alasan_tolak'];

				
			$updateCuti = mysqli_query($koneksi, "update cuti SET 				
			status_cuti='Di Tolak',
			alasan_tolak='".$tolak."'
			where id_cuti ='".$id_cuti."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Cuti Berhasil di Tolak!');
				window.location.href='../../ngadimin.php?module=home';
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


	






	
