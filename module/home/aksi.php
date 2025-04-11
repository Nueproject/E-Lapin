<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";


	if(isset($_POST['saveTamuBaru'])){
		date_default_timezone_set('Asia/Jakarta');
		// data form jg array
		

		$_SESSION['formTambahBaru']= $_POST;
		$nama = $_SESSION['formTambahBaru']['namaLengkap'];
		$nip = $_SESSION['formTambahBaru']['nip'];
		$tujuan = $_SESSION['formTambahBaru']['tujuan'];
		$keterangan = $_SESSION['formTambahBaru']['keterangan'];
		$tgl_ijin = date('Y-m-d');
		//$jam_berangkat = date('H-i-s');

		$maxsid = mysqli_query($koneksi, "select max(id_ijin) AS idijin from data_ijin");
		$count = $maxsid->fetch_assoc();
		$newid = $count['idijin'] + 1;
		
		
		//$cekdata="select nip from data_ijin where nip='$nip'";
		//$ada= mysqli_query($koneksi, $cekdata) or die(mysqli_error($koneksi));

		$simpanijin = mysqli_query($koneksi, "insert into data_ijin (id_ijin, tgl_ijin, nama, nip, tujuan, keterangan, jam_keluar) values ('$newid', '$tgl_ijin','$nama', '$nip', '$tujuan', '$keterangan', CURRENT_TIME())") or die(mysqli_error($koneksi));
	
	

        unset($_SESSION['formTambahBaru']);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}




	//AKSI_EDIT_TAMU	
	if(isset($_POST['saveBalikKantor'])){

		
		date_default_timezone_set('Asia/Jakarta');
		// data form jg array
		

		

		function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);
		   
			if ($unit == "K") {
				return ($miles * 1.609344);
			} else if ($unit == "N") {
				return ($miles * 0.8684);
			} else {
				return $miles;
			}
		  }
		$_SESSION['formDataUpdate']= $_POST;
		$nip = $_POST['nip'];
		$lat = $_POST['latitude_pegawai'];
		$long = $_POST['longitude_pegawai'];

		if (empty($lat)){
			echo "<script>
			alert('GPS Anda Tidak Terdeteksi');
			window.location.href='../../adminweb.php?module=home';
			</script>";
		} else {

		  //lokasi Kantor
		  $a = -7.7388636;
		  $b = 110.3640464;
		  $hasil = distance($a, $b, $lat, $long, "K");		  
		$maxsid = mysqli_query($koneksi, "select max(id_ijin) AS idijin from data_ijin where nip='".$nip."'");
		$count = $maxsid->fetch_assoc();
		$idakhir = $count['idijin'];	

		if($hasil>2)
		{ 
			echo "<script>
			alert('GPS Anda terdeteksi diluar Zona Kantor!');
			window.location.href='../../adminweb.php?module=home';
			</script>";
			
		}
		else
		{		
			
		$updateDataIjin = mysqli_query($koneksi, "update data_ijin SET 				
		jam_kembali=CURRENT_TIME()
		where id_ijin ='".$idakhir."'") or die(mysqli_error($koneksi));

		echo "<script>
			alert('Selamat datang kembali di Kantor!');
			window.location.href='../../adminweb.php?module=home';
			</script>";

		unset($_SESSION['formDataUpdate']);
		} 

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
			
		} //else atas





        

	}

	
	//Aksi Duplicate Tami	
	if(isset($_POST['copyDataTamu'])){

		
		$_SESSION['formDataCopy'] = $_POST;
		$nip = $_POST['nip_copy'];
		$instansi =$_POST['instansiCopy'];
		$bidang = $_POST['bidangCopy'];
		$keperluan = $_POST['keperluan'];
		$keterangan = $_POST['keterangan'];

		$status = "1";
		$tgl_datang = date('Y-m-d');
		$idtgl = date('dYm');
		$nambid = "select nama_bidang from data_bidang where id= '$bidang'";

		$maxid = "select max(id_tamu_instansi) AS idtamu from data_tamu_instansi";
		$querymax = mysqli_query($koneksi, $maxid);
		$count = $querymax->fetch_assoc();
		$newid = $count['idtamu'] + 1;
		$idbid = substr($nambid, 0, 3);
		$idtamu = "$idbid-$idtgl-$newid";
		date_default_timezone_set('Asia/Jakarta');		

		$simpantamuinstansi = mysqli_query($koneksi, "insert into data_tamu_instansi 
		(id_tamu_instansi, kode_tamu, nip, bidang, keperluan, keterangan, status, tgl_datang, jam_datang) values 
		('$newid', '$idtamu','$nip', '$bidang', '$keperluan', '$keterangan', '$status', '$tgl_datang', CURRENT_TIME())") or die(mysqli_error($koneksi));
	



        unset($_SESSION['formDataCopy']);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}