<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";
	
	//AKSI_UBAH_PASSWORD
	if(isset($_POST['saveCuti'])){		
		$_SESSION['formDataCuti'] = $_POST;

		date_default_timezone_set('Asia/Jakarta');
		$id_peg = $_POST['user_id'];
		$jenis = $_POST['jenis'];
		$alasan = $_POST['alasan'];
		$mulai = $_POST['mulai_cuti'];
		$selesai = $_POST['selesai_cuti'];

		
$tgl1 = strtotime($mulai); 
$tgl2 = strtotime($selesai); 
$jarak = $tgl2 - $tgl1;
$jml = $jarak / 60 / 60 / 24;
$hasil = $jml + 1;

$maxid = "select max(id_cuti) AS idcut from cuti";
			$querymax = mysqli_query($koneksi, $maxid);
			$count = $querymax->fetch_assoc();
			$newid = $count['idcut'] + 1;

	$simpancutitahunan = mysqli_query($koneksi, "insert into cuti 
	(id_cuti, id_peg, jml_cuti, mulai_cuti, selesai_cuti, jenis_cuti, alasan_cuti) values 
	('$newid', '$id_peg', '$hasil', '$mulai', '$selesai', '$jenis', '$alasan')") or die(mysqli_error($koneksi));
	
        unset($_SESSION['formDataCuti']);
        header('Location: ../../adminweb.php?module=cuti');
	}

	
