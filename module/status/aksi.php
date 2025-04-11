<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";


	if(isset($_POST['saveLaporan'])){
		date_default_timezone_set('Asia/Jakarta');
		// data form jg array
		

		$_SESSION['formTambahBaru']= $_POST;
		$id_pegawai = $_SESSION['formTambahBaru']['id'];
		$tanggal = $_SESSION['formTambahBaru']['tanggal'];
		$uraian = $_SESSION['formTambahBaru']['uraian'];
		$output = $_SESSION['formTambahBaru']['output'];
		$satuan = $_SESSION['formTambahBaru']['satuan'];

		$explode=explode("-",$tanggal);  
		$tahun = $explode[0]; //untuk tahun
		$bulan = $explode[1]; //untuk bulan
	
		$maxid = "select max(id_lap) AS idlap from data_laporan";
		$querymax = mysqli_query($koneksi, $maxid);
		$count = $querymax->fetch_assoc();
		$newid = $count['idlap'] + 1;
		
		$simpantamu = mysqli_query($koneksi, "insert into data_laporan (id_lap, id_peg, tgl_lap, bulan, tahun, uraian, output, satuan) 
		values ('$newid', '$id_pegawai', '$tanggal', '$bulan', '$tahun', '$uraian', '$output', '$satuan')") or die(mysqli_error($koneksi));
		
        unset($_SESSION['formTambahBaru']);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

	//AKSI_EDIT_TAMU	
	if(isset($_POST['saveLaporan'])){

		
		$_SESSION['formDataUpdate'] = $_POST;
		$id_lap = $_POST['id'];
		$tanggal = $_POST['tanggal'];
		$uraian = $_POST['uraian'];
		$output = $_POST['output'];
		$satuan = $_POST['satuan'];

		date_default_timezone_set('Asia/Jakarta');
		$updateLaporan = mysqli_query($koneksi, "update data_laporan SET
				tgl_lap='".$tanggal."',
				uraian='".$uraian."',
				output='".$output."',
				satuan='".$satuan."'
				where id_lap = ".$id_lap) or die(mysqli_error($koneksi));


        unset($_SESSION['formDataUpdate']);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

	
	//Aksi Duplicate Tami	
	if(isset($_POST['cloneLaporan'])){
		date_default_timezone_set('Asia/Jakarta');
		$_SESSION['formDataCopy'] = $_POST;
		$user_id = $_POST['user_id'];
		$id_lap = $_POST['id'];
		$tanggal = $_POST['tanggal'];
		$uraian = $_POST['uraian'];
		$output = $_POST['output'];
		$satuan = $_POST['satuan'];

		$explode=explode("-",$tanggal);  
		$tahun = $explode[0]; //untuk tahun
		$bulan = $explode[1]; //untuk bulan
		
		$maxid = "select max(id_lap) AS idlap from data_laporan";
		$querymax = mysqli_query($koneksi, $maxid);
		$count = $querymax->fetch_assoc();
		$newid = $count['idlap'] + 1;
		date_default_timezone_set('Asia/Jakarta');		

		$simpantamuinstansi = mysqli_query($koneksi, "insert into data_laporan 
		(id_lap, id_peg, tgl_lap, bulan, tahun, uraian, output, satuan) values 
		('$newid', '$user_id','$tanggal', '$bulan', '$tahun', '$uraian', '$output', '$satuan')") or die(mysqli_error($koneksi));
	



        unset($_SESSION['formDataCopy']);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

		//Aksi SUBMIT LAPORAN	
		if(isset($_POST['submitLaporan'])){
			date_default_timezone_set('Asia/Jakarta');
			$_SESSION['formDataSubmit'] = $_POST;
			$user_id = $_POST['user_id'];
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			$uraian = $_POST['uraian'];
			$output = $_POST['output'];
			$status1 = "0";
			$status2 = "0";
			
			$maxid = "select max(id_lapbul) AS idlap from lap_bulanan";
			$querymax = mysqli_query($koneksi, $maxid);
			$count = $querymax->fetch_assoc();
			$newid = $count['idlap'] + 1;
			date_default_timezone_set('Asia/Jakarta');		
	
			$simpantamuinstansi = mysqli_query($koneksi, "insert into lap_bulanan 
			(id_lapbul, id_peg, bulan, tahun, jumlah_kegiatan, status1, status2) values 
			('$newid', '$user_id', '$bulan', '$tahun', '$output', '$status1', '$status2')") or die(mysqli_error($koneksi));
		
	
	
	
			unset($_SESSION['formDataSubmit']);
	
			header('Location: ' . $_SERVER['HTTP_REFERER']);
	
		}