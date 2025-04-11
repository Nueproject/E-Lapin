<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";


	
	//AKSI_EDIT_TAMU	
	if(isset($_POST['saveEditProfil'])){
		
		$_SESSION['formDataUpdate'] = $_POST;
		$user_id = $_POST['id'];
		$nama = $_POST['nama'];
		$nik = $_POST['nik'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$jabatan = $_POST['jabatan'];
		$nippnpn = $_POST['nippnpn'];
		$spk = $_POST['spk'];
		$tglspk = $_POST['tglspk'];
		$tglspk = $_POST['tglspk'];
		$tglspk = $_POST['tglspk'];		
		$nama_atasan= $_POST['nama_atasan']; 	
		$nip_atasan= $_POST['nip_atasan']; 	
		$jabatan_atasan= $_POST['jabatan_atasan']; 	

		$edit_nama = strtolower($nama);
		$new_nama = ucwords($edit_nama);
		echo $new_nama;

		date_default_timezone_set('Asia/Jakarta');
		$updateLaporan = mysqli_query($koneksi, "update user SET
				nama_pegawai='".$new_nama."',
				nik='".$nik."',
				jenis_kelamin='".$jenis_kelamin."',
				jabatan='".$jabatan."',
				nippnpn='".$nippnpn."',
				spk='".$spk."',
				tgl_spk='".$tglspk."',
				nama_atasan='".$nama_atasan."',
				nip_atasan='".$nip_atasan."',
				jabatan_atasan='".$jabatan_atasan."'
				where id = ".$user_id) or die(mysqli_error($koneksi));
        unset($_SESSION['formDataUpdate']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

	}

	
	//AKSI_UBAH_PASSWORD
	if(isset($_POST['saveUbahPasword'])){		
		$_SESSION['formDataUbah'] = $_POST;
		$user_id = $_POST['user_id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		date_default_timezone_set('Asia/Jakarta');
		$updateLaporan = mysqli_query($koneksi, "update user SET
				username='".$username."',
				pass='".$password."'
				where id = ".$user_id) or die(mysqli_error($koneksi));

        unset($_SESSION['formDataUbah']);
		
		session_start();
		session_destroy();

        header('Location: ../../index.php');
	}

	
