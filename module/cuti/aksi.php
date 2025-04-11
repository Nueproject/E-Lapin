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
		$bln_saiki = date('m');
		$thn_saiki = date('Y');
		$status_cuti = "Belom ditinjau";
		
		$datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");		
		while($user=mysqli_fetch_array($datauser)){        
			  $user_id= $user['id']; 	
			  $nama= $user['nama_pegawai']; 	
			  $nippnpn= $user['nippnpn']; 	
			  $username= $user['username']; 	
			  $password= $user['pass']; 	
			  $nik= $user['nik']; 	
			  $spk= $user['spk']; 	
			  $tglspk= $user['tgl_spk']; 	
			  $jenis_kelamin= $user['jenis_kelamin']; 	
			  $jabatan= $user['jabatan']; 	
			  $nama_atasan= $user['nama_atasan']; 	
			  $nip_atasan= $user['nip_atasan']; 	
			  $jabatan_atasan= $user['jabatan_atasan']; 	          
		}    
		$datacutitahun= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."' and jenis_cuti ='1' and year(mulai_cuti)='$thn_saiki'");
		$jumlah_tahun = 0;
		while ($row = $datacutitahun->fetch_assoc()){
		$jumlah_tahun += $row['jml_cuti'];      
	  }      
  
		
$tgl1 = strtotime($mulai); 
$tgl2 = strtotime($selesai); 
$jarak = $tgl2 - $tgl1;
$jml = $jarak / 60 / 60 / 24;
$hasil = $jml + 1;
$cek_jml = $hasil + $jumlah_tahun;
$sisa = 12 - $jumlah_tahun;
include_once '../../user_agent.php';
$ua = new UserAgent();
if ($cek_jml>12){

	
	if($ua->is_mobile()){
		echo "<script>
		alert('TOTAL CUTI ANDA MELEBIHI BATAS! Cuti anda tinggal $sisa Hari');
		window.location.href='../../absensi.php?module=cuti';
		</script>";
		exit;
	}else{
		echo "<script>
		alert('TOTAL CUTI ANDA MELEBIHI BATAS! <br> Cuti anda tinggal $sisa Hari');
		window.location.href='../../adminweb.php?module=cuti';
		</script>";
		exit;
	}
	

} else {
	$maxid = "select max(id_cuti) AS idcut from cuti";
	$querymax = mysqli_query($koneksi, $maxid);
	$count = $querymax->fetch_assoc();
	$newid = $count['idcut'] + 1;

	$simpancutitahunan = mysqli_query($koneksi, "insert into cuti 
	(id_cuti, id_peg, jml_cuti, mulai_cuti, selesai_cuti, jenis_cuti, status_cuti, alasan_cuti) values 
	('$newid', '$id_peg', '$hasil', '$mulai', '$selesai', '$jenis', '$status_cuti', '$alasan')") or die(mysqli_error($koneksi));

unset($_SESSION['formDataCuti']);


if($ua->is_mobile()){
    header('Location: ../../absensi.php?module=cuti'); //ini link untuk mobile
    exit;
}else{
	header('Location: ../../adminweb.php?module=cuti'); //ini link untuk yang bukan mobile
    exit;
}


}
	}

	
