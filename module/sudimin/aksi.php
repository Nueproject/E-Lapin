<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";

		//OPSI CUTI	ACC
		if(isset($_POST['saveAccCuti'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_cuti = $_POST['id_cuti'];
				
			$updateCuti = mysqli_query($koneksi, "update cuti SET 				
			status_cuti='Di Setujui'
			where id_cuti ='".$id_cuti."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Cuti Berhasil di Setujui!');
				window.location.href='../../sudimin.php?module=home';
				</script>";
	      
	
		}

		//OPSI CUTI	
		if(isset($_POST['saveTolakCuti'])){

			date_default_timezone_set('Asia/Jakarta');
			$id_cuti = $_POST['id_cuti'];
				
			$updateCuti = mysqli_query($koneksi, "update cuti SET 				
			status_cuti='Di Tolak'
			where id_cuti ='".$id_cuti."'") or die(mysqli_error($koneksi));
	
			echo "<script>
				alert('Cuti Berhasil di Tolak!');
				window.location.href='../../sudimin.php?module=home';
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
				window.location.href='../../sudimin.php?module=home';
				</script>";
	      
	
		}

			//OPSI ACC LAPORAN
			if(isset($_POST['saveEditAbsen'])){

				date_default_timezone_set('Asia/Jakarta');
				$id_abs = $_POST['id_absen'];
				$jam_datang = $_POST['jam_datang'];
				$tgl_datang = $_POST['tgl_datang'];
				$jam_pulang = $_POST['jam_pulang'];
				$tgl_pulang = $_POST['tgl_pulang'];
				$id_shift = $_POST['id_shift'];

				$shiftkerja= mysqli_query($koneksi,"select * from shift_kerja where id_shift='$id_shift'");	 	
				while($shift=mysqli_fetch_array($shiftkerja)){        
				  $jam_masukkerja= $shift['jam_datang_shift'];
				  $jam_pulangkerja= $shift['jam_pulang_shift'];
				}
				   //ALGORITMA HITUNG TELAT DATANG
				   $dat= strtotime($jam_datang);
				   $masuk= strtotime($jam_masukkerja);
				   $selisih = $dat-$masuk;  
				   $menit = 60*($selisih / (60 * 60));
				   $m = number_format($menit,0);
				   if ($menit>0){
					 $status_datang = "Telat $m menit";
				   } else {
					 $status_datang = "Tepat Waktu";
				   }
					

				    //ALGORITMA HITUNG PULANG
					$dat1= strtotime($jam_datang);
					$pulang1= strtotime($jam_pulang);
					$shiftpulang= strtotime($jam_pulangkerja);
					$shiftdatang= strtotime($jam_masukkerja);
					$selisihjam = $pulang1-$dat1;  
					$jam24=date('24:00:00');
					$tambahjam = strtotime($jam24);        
					$pulang2= strtotime($jam_pulangkerja);        
					$dat2= strtotime($jam_pulang);

					$shiftdatang= strtotime($jam_masukkerja);
					$shiftpulang= strtotime($jam_pulangkerja);
					
					if ($jam_pulang == '00:00:00'){

						$status_pulang='';

					} else {

						if ($jadwal_shift=='2' and $jam_pulang > $jam_absenkerja){
							$jamker= $pulang1 - $shiftdatang;
							$totaljamker= $shiftdatang-$shiftpulang;
							$cepat=$totaljamker-$jamker;
							$menittelat = 60*($cepat/ (60 * 60));
							$pulangcepat = number_format($menittelat,0);
							$jam = $pulangcepat/60;
							if ($menittelat>0){
							  $status_pulang = "Pulang lebih cepat $pulangcepat menit";
							} else {
							  $status_pulang = "Tepat Waktu";
							}        
							
						  } else {         
							$selisihtelat = $pulang2-$dat2;  
							$menittelat = 60*($selisihtelat/ (60 * 60));
							$pulangcepat = number_format($menittelat,0);
							$jam = $pulangcepat/60;
							if ($menittelat>0){
							  $status_pulang = "Pulang lebih cepat $pulangcepat menit";
							} else {
							  $status_pulang = "Tepat Waktu";
							}        
							
						  }

					}
					


				$updateAbsen = mysqli_query($koneksi, "update absensi SET 				
				jam_datang='$jam_datang',
				status_datang='$status_datang',
				jam_pulang='$jam_pulang',
				status_pulang='$status_pulang'
				where id_absen ='".$id_abs."'") or die(mysqli_error($koneksi));
				
				echo "<script>
					alert('Absensi Berhasil di Ubah!');
					window.location.href='../../sudimin.php?module=home';
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

			//SAVE TAMBAH ADMIN
			if(isset($_POST['saveTambahAdmin'])){
				$nama = $_POST['nama_pegawai'];
				$nik = "";
				$spk = "";
				$tglspk = "";
				$nippnpn = $_POST['nip'];
				$kelamin = "";
				$jabatan = $_POST['jabatan'];
				$nama_atasan = "";
				$nip_atasan = "";
				$jabatan_atasan = "";
				$user = $_POST['username'];
				$pass = $_POST['password'];
				$maxid = "select max(id) AS iduser from user";
				$querymax = mysqli_query($koneksi, $maxid);
				$count = $querymax->fetch_assoc();
				$newid = $count['iduser'] + 1;

				$edit_nama = strtolower($nama);
				$new_nama = ucwords($edit_nama);
				echo $new_nama;
				
				$simpanAdmin = mysqli_query($koneksi, "insert into user (id, nama_pegawai, nippnpn, nik, spk, tgl_spk, jenis_kelamin, jabatan, nama_atasan, nip_atasan, jabatan_atasan, username, pass) 
				values ('$newid', '$new_nama', '$nippnpn', '$nik', '$spk', '$tglspk', '$kelamin', '$jabatan', '$nama_atasan', '$nip_atasan', '$jabatan_atasan', '$user', '$pass')") or die(mysqli_error($koneksi));
				echo "<script> alert('Data Admin berhasil di Tambahkan'); 
				window.location = '../../sudimin.php?module=data_admin';</script>";	
			}

					//save edit admin
		if(isset($_POST['saveEditAdmin'])){
			date_default_timezone_set('Asia/Jakarta');
			$id_admin = $_POST['id_peg'];
			$nama = $_POST['nama_pegawai'];
			$nippnpn = $_POST['nip'];
			$jabatan = $_POST['jabatan'];
			$user = $_POST['username'];
			$pass = $_POST['password'];
				
			$updateAdmin = mysqli_query($koneksi, "update user SET 				
			nama_pegawai='$nama',
			nippnpn='$nippnpn',
			jabatan='$jabatan',
			username='$user',
			pass='$pass'
			where id ='".$id_admin."'") or die(mysqli_error($koneksi));
			
			echo "<script>
				alert('Data Admin Berhasil di Ubah!');
				window.location.href='../../sudimin.php?module=data_admin';
				</script>";
	      
	
		}

		//SAVE TAMBAH LOKASI
		if(isset($_POST['saveTambahLokasi'])){
			$nama = $_POST['nama_kantor'];
			$alamat = $_POST['alamat'];
			$lat_long = $_POST['lat_long'];
			$radius = $_POST['radius'];

			$maxid = "select max(id_kantor) AS iduser from kantor";
			$querymax = mysqli_query($koneksi, $maxid);
			$count = $querymax->fetch_assoc();
			$newid = $count['iduser'] + 1;

			$edit_nama = strtolower($nama);
			$new_nama = ucwords($edit_nama);
			echo $new_nama;
			
			$simpanAdmin = mysqli_query($koneksi, "insert into kantor (id_kantor, nama_kantor, alamat, lat_long, radius) 
			values ('$newid', '$new_nama', '$alamat', '$lat_long', '$radius')") or die(mysqli_error($koneksi));
			echo "<script> alert('Data Lokasi berhasil di Tambahkan'); 
			window.location = '../../sudimin.php?module=data_lokasi';</script>";	
		}

				//save edit Lokasi
	if(isset($_POST['saveEditLokasi'])){
		date_default_timezone_set('Asia/Jakarta');
		$id_lokasi = $_POST['id_kantor'];
		$nama = $_POST['nama_kantor'];
		$alamat = $_POST['alamat'];
		$lat_long = $_POST['lat_long'];
		$radius = $_POST['radius'];
			
		$updateAdmin = mysqli_query($koneksi, "update kantor SET 				
		nama_kantor='$nama',
		alamat='$alamat',
		lat_long='$lat_long',
		radius='$radius'
		where id_kantor ='".$id_lokasi."'") or die(mysqli_error($koneksi));
		
		echo "<script>
			alert('Data Admin Berhasil di Ubah!');
			window.location.href='../../sudimin.php?module=data_lokasi';
			</script>";
	  

	}

		//SAVE TAMBAH SHIFT
		if(isset($_POST['saveTambahShift'])){
			$nama = $_POST['nama_shift'];
			$jammasuk = $_POST['jam_masuk'];
			$jampulang = $_POST['jam_pulang'];

			$maxid = "select max(id_shift) AS iduser from shift_kerja";
			$querymax = mysqli_query($koneksi, $maxid);
			$count = $querymax->fetch_assoc();
			$newid = $count['iduser'] + 1;

			$edit_nama = strtolower($nama);
			$new_nama = ucwords($edit_nama);
			echo $new_nama;
			
			$simpanAdmin = mysqli_query($koneksi, "insert into shift_kerja (id_shift, nama_shift, jam_datang_shift, jam_pulang_shift) 
			values ('$newid', '$new_nama', '$jammasuk', '$jampulang')") or die(mysqli_error($koneksi));
			echo "<script> alert('Data Shift berhasil di Tambahkan'); 
			window.location = '../../sudimin.php?module=data_shift';</script>";	
		}

				//save edit Shift
	if(isset($_POST['saveEditShift'])){
		date_default_timezone_set('Asia/Jakarta');
		$id_shift = $_POST['id_shift'];
		$nama = $_POST['nama_shift'];
		$masuk = $_POST['jam_masuk'];
		$pulang = $_POST['jam_pulang'];
			
		$updateAdmin = mysqli_query($koneksi, "update shift_kerja SET 				
		nama_shift='$nama',
		jam_datang_shift='$masuk',
		jam_pulang_shift='$pulang'
		where id_shift ='".$id_shift."'") or die(mysqli_error($koneksi));
		
		echo "<script>
			alert('Data Shift Berhasil di Ubah!');
			window.location.href='../../sudimin.php?module=data_shift';
			</script>";
	  

	}
	


//SAVE TAMBAH ADMIN
if(isset($_POST['saveTambahUser'])){
	$nama = $_POST['nama_pegawai'];
	$nik = "";
	$spk = "";
	$tglspk = "";
	$nippnpn = $_POST['nip'];
	$kelamin = "";
	$jabatan = $_POST['jabatan'];
	$nama_atasan = "";
	$nip_atasan = "";
	$jabatan_atasan = "";
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$maxid = "select max(id) AS iduser from user";
	$querymax = mysqli_query($koneksi, $maxid);
	$count = $querymax->fetch_assoc();
	$newid = $count['iduser'] + 1;

	$edit_nama = strtolower($nama);
	$new_nama = ucwords($edit_nama);
	echo $new_nama;
	
	$simpanAdmin = mysqli_query($koneksi, "insert into user (id, nama_pegawai, nippnpn, nik, spk, tgl_spk, jenis_kelamin, jabatan, nama_atasan, nip_atasan, jabatan_atasan, username, pass) 
	values ('$newid', '$new_nama', '$nippnpn', '$nik', '$spk', '$tglspk', '$kelamin', '$jabatan', '$nama_atasan', '$nip_atasan', '$jabatan_atasan', '$user', '$pass')") or die(mysqli_error($koneksi));
	echo "<script> alert('Data User berhasil di Tambahkan'); 
	window.location = '../../sudimin.php?module=data_user';</script>";	
}

		//save edit USER
if(isset($_POST['saveEditUser'])){
date_default_timezone_set('Asia/Jakarta');
$id_admin = $_POST['id_peg'];
$nama = $_POST['nama_pegawai'];
$nippnpn = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$user = $_POST['username'];
$pass = $_POST['password'];
	
$updateAdmin = mysqli_query($koneksi, "update user SET 				
nama_pegawai='$nama',
nippnpn='$nippnpn',
jabatan='$jabatan',
username='$user',
pass='$pass'
where id ='".$id_admin."'") or die(mysqli_error($koneksi));

echo "<script>
	alert('Data User Berhasil di Ubah!');
	window.location.href='../../sudimin.php?module=data_user';
	</script>";


}



	
