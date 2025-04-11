<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<!-- CSS Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<!-- Javascript Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<!-- Javascript Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<head>
	<title>Cetak Laporan Bulanan</title>


<?php 
session_start();
    include "../../../lib/config.php";
    include "../../../lib/koneksi.php";

function  getBulan($bln){
  switch  ($bln){
      case  1:
      return  "Januari";
      break;
      case  2:
      return  "Februari";
      break;
      case  3:
      return  "Maret";
      break;
      case  4:
      return  "April";
      break;
      case  5:
      return  "Mei";
      break;
      case  6:
      return  "Juni";
      break;
      case  7:
      return  "Juli";
      break;
      case  8:
      return  "Agustus";
      break;
      case  9:
      return  "September";
      break;
      case  10:
      return  "Oktober";
      break;
      case  11:
      return  "November";
      break;
      case  12:
      return  "Desember";
      break;
  }
}

function  getHari($hari){
  switch  ($hari){
      case 'Sun':
        return  "Minggu";
      break; 
      case 'Mon':			
        return  "Senin";
      break; 
      case 'Tue':
        return  "Selasa";
      break;
      case 'Wed':
        return  "Rabu";
      break;   
      case 'Thu':
        return  "Kamis";
      break;   
      case 'Fri':
        return  "Jumat";
      break;   
      case 'Sat':
        return "Sabtu";
      break;      
      default:
        return "Tidak di ketahui";		
      break;
  }
}



$user_id = $_POST['user_id'];

  $bulan = $_POST['bulan'];
  $jam_awal_datang = $_POST['jam_awal_datang'];
  $jam_akhir_datang = $_POST['jam_akhir_datang'];
  $jam_awal_pulang = $_POST['jam_awal_pulang'];
  $jam_akhir_pulang = $_POST['jam_akhir_pulang'];

    $datauser= mysqli_query($koneksi,"select * from user where id='".$user_id."'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id"); 
      while($user=mysqli_fetch_array($datauser)){        
        $user_id= $user['id']; 	
        $username= $user['username']; 	
        $nama_pegawai= $user['nama_pegawai']; 	
        $nippnpn= $user['nippnpn']; 	
        $NIK= $user['nik']; 	
        $jeniskelamin= $user['jenis_kelamin']; 	
        $jabatan= $user['jabatan']; 	
        $spk= $user['spk']; 	
        $tglspk= $user['tgl_spk']; 	
        $nama_atasan= $user['nama_atasan']; 	
        $nip_atasan= $user['nip_atasan']; 	
        $jabatan_atasan= $user['jabatan_atasan']; 	
  }

$sasi = getBulan($bulan); 

function tanggalMerah($value) {
	$array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);
	//check tanggal merah berdasarkan libur nasional
	if(isset($array[$value]) && $array[$value]["holiday"]){
		$saiki = ($array[$value]['summary']['0']);

	//check tanggal merah berdasarkan hari minggu
	} elseif (date("D",strtotime($value))==="Sun"){
		$saiki ="";

	//bukan tanggal merah
	} else {
		$saiki = "";
	}
	return $saiki;
}
?>

<div id="print">
<center>
    <h4>REKAP ABSENSI PPNPN</h4>
    <h4>KANTOR REGIONAL I BKN YOGYAKARTA</h4>
  </center>
  <hr>

<table border="0" align="center" width="90%">    
<tr>
  <td align="left" width="15%"><b>Nama</b></td>
  <td align="center" width="5%"><b> : </b></td>
  <td align="left" width="80%"><b><?php echo $nama_pegawai; ?></b></td>
</tr>
<?php 

if ($jabatan == "Tenaga Keamanan Wanita"){
        $jab = "Tenaga Keamanan";
    } else {
      $jab = $jabatan;
    }?>
<tr> 
  <td align="left"><b>Jabatan</b></td>
  <td align="center"><b> : </b></td>
  <td align="left"><b><?php echo $jab; ?></b></td>
</tr>
<tr>
  <td align="left"><b>Nomor SPK</b></td>
  <td align="center"><b> : </b></td>
  <td align="left"><b><?php echo $spk; ?></b></td>
</tr>
</table> 
<hr>
</head>
<body onLoad="PrintDoc()">
<table border="0" align="center" width="90%">
<tr>
<td align="left">
<b>Absensi Bulan <?php echo $sasi;?></b>
</td>
</tr>
</table>  
        <center><table  width="90%" class="display stripe" id="myTable" border="1">    
       
        <thead>
        <?php if ($jabatan == "Tenaga Keamanan"){ ?>   
          <tr class="table-dark">
            <th width="5%"><center>NO</center></th>
            <th width="30%"><center>HARI/TANGGAL</center></th>
            <th width="14%"><center>DINAS</center></th>
            <th width="10%"><center>DATANG</center></th>
            <th width="10%"><center>PARAF</center></th>
            <th width="10%"><center>PULANG</center></th>
            <th width="10%"><center>PARAF</center></th>
            <th width="11%"><center>KET</center></th>
          </tr>
          <?php }  else { ?>
            <tr class="table-dark">
            <th width="5%"><center>NO</center></th>
            <th width="30%"><center>HARI/TANGGAL</center></th>
            <th width="12%"><center>DATANG</center></th>
            <th width="10%"><center>PARAF</center></th>
            <th width="12%"><center>PULANG</center></th>
            <th width="10%"><center>PARAF</center></th>
            <th width="21%"><center>KET</center></th>
          </tr>
          <?php } ?>
          
        </thead>
<?php
$hariIni = new DateTime();
$tahun = '2024';
$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

for ($i=1; $i < $tanggal+1; $i++) { 
    $tgl=date("$tahun/$bulan/$i");
    $dino = date('D', strtotime($tgl));
    $sasi = date('m', strtotime($tgl));
    $bul = getBulan($sasi);
    $din = getHari($dino);

$pagi_start = strtotime($jam_awal_datang);
$pagi_end = strtotime($jam_akhir_datang);
$hitungpagi = $pagi_end - $pagi_start;
$pagitime =  $pagi_start + mt_rand(0,$hitungpagi);

$sore_start = strtotime($jam_awal_pulang);
$sore_end = strtotime($jam_akhir_pulang);
$hitungsore = $sore_end - $sore_start;
$soretime =  $sore_start + mt_rand(0,$hitungsore);
$jamdatang = date("H:i",$pagitime);
$jampulang = date("H:i",$soretime); 
//$paraf="";
//$paraf = '<img src="../../../img/assets/ttd_user/ttd_'.$username.'.png" alt="ttd" width="15" height="15">';

if(file_exists("../../../img/assets/ttd_user/ttd_$username.png")){
  $paraf = '<img src="../../../img/assets/ttd_user/ttd_'.$username.'.png" alt="ttd" width="15" height="15">';
} else {
  $paraf = "";
}
  

if ($din == "Minggu") {
  $jamdatang = "Libur";
  $jampulang = "Libur";
  $paraf ="____";
} elseif ($din == "Sabtu" && $jabatan == "Tenaga Pramubakti") {  
  $jamdatang = "Libur";
  $jampulang = "Libur";  
  $paraf ="____";
}  elseif ($din == "Sabtu" && $jabatan == "Tenaga Kebersihan"){   
  $jampulang = "11:00";
}   elseif ($din == "Sabtu" && $jabatan == "Tenaga Pengemudi"){   
  $jampulang = "11:10";
} elseif ($din == "Sabtu" && $jabatan == "Tenaga Keamanan Wanita"){   
  $jampulang = "11:10";
} 
$hari_ini = "$tahun/$bulan/$i";
$saiki = date("Y-m-d",strtotime($hari_ini));
$libur = tanggalMerah($saiki);

if (!empty($libur) && $jabatan == "Tenaga Pramubakti"){
$paraf = "____";
$jamdatang = "Libur";
$jampulang = "Libur";  
} else if (!empty($libur) && $jabatan == "Tenaga Keamanan Wanita"){
$paraf = "____";
$jamdatang = "Libur";
$jampulang = "Libur";  
} else if (!empty($libur) && $jabatan == "Tenaga Kebersihan"){
  $jamdatang = "";
  $jampulang = "";
  $paraf = "";
  } else if (!empty($libur) && $jabatan == "Tenaga Pengemudi"){
    $jamdatang = "";
    $jampulang = "";
    $paraf = "";
    } else {
}
if ($jabatan == "Tenaga Keamanan"){?>
 <tr>
                <td><center><?php echo $i; ?></center></td>
                <td>&nbsp;
                <?php echo "$din, ";
                echo " $i ";
                echo " $bul ";
                echo $tahun; ?>
                </td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
              </tr>     
              <?php }  else { ?>
              <tr>
                <td><center><?php echo $i; ?></center></td>
                <td>&nbsp;
                <?php echo "$din, ";
                echo " $i ";
                echo " $bul ";
                echo $tahun; ?>
                </td>
                <td><center><?php echo $jamdatang;  ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $jampulang; ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $libur; ?></center></td>
              </tr>     
              <?php } } ?>
            
        </table></center>

  <br>
  

<table border="0" align="center" width="90%">
<tr>
  <td align="center" width="40%">Diketahui oleh,<br>
  <?php echo $jabatan_atasan; ?>
</td>
  <td align="center" width="20%">  </td>
  <td align="center" width="40%">Dilaporkan oleh,</td>
</tr>
</table>

<?php
if(file_exists("../../../img/assets/ttd_user/ttd_$username.png")){
  $ttd_kasub = '<img src="../../../img/assets/ttd_user/ttd_'.$username.'.png" alt="ttd" width="15" height="15">';
} else {
  $ttd_kasub = "";
}
?>
<br><br>
<table border="0" align="center" width="90%">
<tr>
  <td align="center" width="40%"><u> <?php echo $nama_atasan; ?> </u><br> NIP  <?php echo $nip_atasan; ?></td>
  <td align="center" width="20%">   </td>
  <td align="center" width="40%"><?php echo $nama_pegawai; ?></td>
</tr>
</table> 		
</body>
</div>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<script type="text/javascript">

$(document).ready(function () {
    window.print();
    window.location = "../../../adminweb.php?module=home";
});
</script> 

</html>