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
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$user_id = $_POST['user_id'];


      $datauser= mysqli_query($koneksi,"select * from user where id='".$user_id."'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id"); 
      while($user=mysqli_fetch_array($datauser)){        
        //$user_id= $user['id']; 	
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
  $dataAbsensi = mysqli_query($koneksi,"select * from absensi ab join user u on ab.id_peg = u.id where month(tgl_datang)='$bulan' and year(tgl_datang)='$tahun' and id_peg='$user_id'"); 
  $sasi = getBulan($bulan); 

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
//$tahun = date('Y');
$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

for ($i=1; $i < $tanggal+1; $i++) { 
    $tgl=date("$tahun/$bulan/$i");
    $dino = date('D', strtotime($tgl));
    $sasi = date('m', strtotime($tgl));
    $bul = getBulan($sasi);
    $din = getHari($dino);


//$paraf="";
//$paraf = '<img src="../../../img/assets/ttd_user/ttd_'.$username.'.png" alt="ttd" width="15" height="15">';

if(file_exists("../../../img/assets/ttd_user/ttd_$username.png")){
  $paraf = '<img src="../../../img/assets/ttd_user/ttd_'.$username.'.png" alt="ttd" width="15" height="15">';
} else {
  $paraf = "";
}

  

$hari_ini = "$tahun/$bulan/$i";
$saiki = date("Y-m-d",strtotime($hari_ini));

 //$query_absen= mysqli_query($koneksi,"SELECT * FROM absensi WHERE $filter AND id_peg='$row[id]' ORDER BY id_absen DESC");	
 $query_absen= "SELECT * FROM absensi  ab join user us on ab.id_peg=us.id where day(tgl_datang)='$i' and month(tgl_datang)='$bulan' and year(tgl_datang)='$tahun' and id_peg='$user_id'";	
 $result_absen = $koneksi->query($query_absen);
 $row_absen = $result_absen->fetch_assoc(); 
 if (isset($row_absen['jam_datang'])) {  
  $jam_masuk = $row_absen['jam_datang'];
  } else {    
   $jam_masuk = '-';
  }

  if ($jam_masuk == '-') {
    $paraf ="";
  }

  $query_pulang= "SELECT * FROM absensi  ab join user us on ab.id_peg=us.id where day(tgl_pulang)='$i' and month(tgl_pulang)='$bulan' and year(tgl_pulang)='$tahun' and id_peg='$user_id'";	
  $result_pulang = $koneksi->query($query_pulang);
  $row_pulang = $result_pulang->fetch_assoc(); 
  if (isset($row_pulang['jam_pulang'])) {  
   $jam_pulang = $row_pulang['jam_pulang'];
   } else {    
    $jam_pulang = '-';
   }

  $query_dinas= "SELECT * FROM absensi  ab join shift_kerja sk on ab.id_shift=sk.id_shift where day(tgl_datang)='$i' and month(tgl_datang)='$bulan'and year(tgl_datang)='$tahun' and id_peg='$user_id'";	
  $result_dinas = $koneksi->query($query_dinas);
  $row_dinas = $result_dinas->fetch_assoc(); 
  if (isset($row_dinas['id_shift'])) {  
   $dinas = $row_dinas['nama_shift'];
   } else {    
    $dinas = '-';
   }

   $query_ket= "SELECT * FROM absensi  ab join user us on ab.id_peg=us.id where day(tgl_datang)='$i' and month(tgl_datang)='$bulan' and year(tgl_datang)='$tahun' and id_peg='$user_id'";	
   $result_ket = $koneksi->query($query_ket);
   $row_ket = $result_ket->fetch_assoc(); 
   if (isset($row_ket['keterangan'])) {  
    $ket = $row_ket['keterangan'];
    } else {    
     $ket = '-';
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
                <td><center><?php echo $dinas;  ?></center></td>
                <td><center><?php echo $jam_masuk;  ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $jam_pulang; ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $ket; ?></center></td>
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
                <td><center><?php echo $jam_masuk;  ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $jam_pulang; ?></center></td>
                <td><center><b><?php echo  $paraf; ?></b></center></td>
                <td><center><?php echo  $ket; ?></center></td>
              </tr>     
              <?php } } ?>
            
        </table></center>

  <br>
  

<style>
  .teks-di-depan-gambar {
    position: relative;
  }
  .teks {
    position: absolute;
    top: 15%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 1;
  }
  .gambar {
    position: relative;
    z-index: 0;
    height: 110px;
  }
</style>
 
<?php
$dataLapbul = mysqli_query($koneksi,"select * from lap_bulanan lb join user u on lb.id_peg = u.id where lb.bulan=$bulan and lb.tahun=$tahun and u.id=$user_id"); 
   while($dalap=mysqli_fetch_array($dataLapbul)){    
       $status1 = $dalap['status1'];
  }
  
if($status1=='di Setujui'){
  $ttd_kasub = '<img src="../../../img/assets/ttd_user/ttd_kasub.png" width="100" height="100"  class="gambar">';
} else {
  $ttd_kasub = "<br><br><br><br>";
}


?>
 <br><br>
<table border="0" align="center" width="90%">
<tr>
  <td align="center" width="50%">
  <div class="teks-di-depan-gambar">
    <span class="teks">
      Diketahui oleh,
      <br><?php echo $jabatan_atasan; ?>
    </span>
      <?php echo $ttd_kasub; ?>
      <br>
      <u> <?php echo $nama_atasan; ?> </u>
      <br> NIP  <?php echo $nip_atasan; ?>
  </div>
  </td>
  <td align="center" width="10%">  </td>
  <td align="center" width="40%"><br><span>Dilaporkan oleh,</span>
  <br><br><br><br>
  <?php echo $nama_pegawai; ?></td>
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