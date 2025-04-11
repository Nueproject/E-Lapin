<?php
 
    include "lib/config.php";
    include "lib/koneksi.php";

	if(isset($_POST['submit'])){

 
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		//Validasi kekuatan password
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
 
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
  
    echo "<script> alert('Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter.'); 
			window.location = 'regis_magang.php';</script>";
		} else {

			$nama = $_POST['nama'];
		$nik = $_POST['nik'];
		$spk = $_POST['spk'];
		$tglspk = $_POST['tglspk'];
		$nippnpn = $_POST['nippnpn'];
		$kelamin = $_POST['kelamin'];
		$jabatan = $_POST['jabatan'];
		$nama_atasan = $_POST['nama_atasan'];
		$nip_atasan = $_POST['nip_atasan'];
		$jabatan_atasan = $_POST['jabatan_atasan'];
		$user = $_POST['username'];
		$pass = $_POST['password'];

		$cekuser =mysqli_query($koneksi,"select * from user where nik='$nik' or username ='$user'");
		
		$edit_nama = strtolower($nama);
		$new_nama = ucwords($edit_nama);
		echo $new_nama;
		
		if(mysqli_num_rows($cekuser)>0)
		{ 
			echo "<script> alert('Data USER sudah ada, silahkan hubungi Admin'); 
			window.location = 'index.php';</script>";
			//echo "<h3>Pegawai telah Terdaftar! Silahkan menggunakan mode kunjungan lama.</h3>";
			
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			$maxid = "select max(id) AS iduser from user";
			$querymax = mysqli_query($koneksi, $maxid);
			$count = $querymax->fetch_assoc();
			$newid = $count['iduser'] + 1;
			
			$simpantamu = mysqli_query($koneksi, "insert into user (id, nama_pegawai, nippnpn, nik, spk, tgl_spk, jenis_kelamin, jabatan, nama_atasan, nip_atasan, jabatan_atasan, username, pass) 
			values ('$newid', '$new_nama', '$nippnpn', '$nik', '$spk', '$tglspk', '$kelamin', '$jabatan', '$nama_atasan', '$nip_atasan', '$jabatan_atasan', '$user', '$pass')") or die(mysqli_error($koneksi));
	
			echo "<script> alert('Data USER berhasil di Daftarkan'); 
			window.location = 'index.php';</script>";			
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
		}


		}
	}
	
	

	
		?>