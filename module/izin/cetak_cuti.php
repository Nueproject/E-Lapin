<?php
session_start();
include "../../lib/config.php";
include "../../lib/koneksi.php";
?>
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
	<title>Pengajuan Cuti</title>		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style type="text/css">
    body { font-family: "Calibri", sans-serif; }
    p { font-family: "Calibri", sans-serif; font-size: 20px;}
    h4 {font-size: 20px;}
</style>
<?php
  $id_cuti = $_GET['id'];  
  $data_cuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where id_cuti='".$id_cuti."'");
  while($cuti=mysqli_fetch_array($data_cuti)){   
    $jumlah= $cuti['jml_cuti']; 		
    $mulai= $cuti['mulai_cuti']; 	
    $selesai= $cuti['selesai_cuti']; 	
    $jenis= $cuti['jenis_cuti']; 	
    $nama= $cuti['nama_pegawai']; 	
    $unit= $cuti['jabatan']; 	  
    $jabatan_atasan= $cuti['jabatan_atasan']; 	  
    $nama_atasan= $cuti['nama_atasan']; 	  
    $nip_atasan= $cuti['nip_atasan']; 	  
}


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

function  getCuti($jenis){
  switch  ($jenis){
      case '1':
        return  "Tahunan";
      break; 
      case '2':			
        return  "Alasan Penting";
      break; 
      case '3':			
        return  "Sakit";
      break; 
      case '4':
        return  "Melahirkan";
      break;
  }
}

$saiki = date('now');
$tgl_saiki = date('d');
$bln_saiki = date('m');
$tahun_saiki = date('Y');
$bulan = getBulan($bln_saiki);
$din_mulai = date('D', strtotime($mulai));
$tgl_mulai = date('d', strtotime($mulai));
$bul_mulai = date('m', strtotime($mulai));
$tahun_mulai = date('Y', strtotime($mulai));
$din_selesai = date('D', strtotime($selesai));
$tgl_selesai = date('d', strtotime($selesai));
$bul_selesai = date('m', strtotime($selesai));
$tahun_selesai = date('Y', strtotime($selesai));
$bulan_mulai = getBulan($bul_mulai);
$bulan_selesai = getBulan($bul_selesai);
$jenis_cuti = getCuti($jenis);


$dino_mulai = getHari($din_mulai);
$dino_selesai = getHari($din_selesai);
if ($jumlah>1){
  $waktunya = "$dino_mulai tanggal $tgl_mulai $bulan_mulai $tahun_mulai sampai dengan $dino_mulai $tgl_selesai $bulan_selesai $tahun_selesai";
} else {
  $waktunya = "$dino_mulai tanggal $tgl_mulai  $bulan_mulai $tahun_selesai";
}

//$dino = date('D', strtotime($tgl));
?>
<body>
  <div id="print">
      <div class="col-md-10">
      <h4 align="right" width="80%" style="padding-right: 50px; padding-top: 20px;">Yogyakarta, <?php echo "$tgl_saiki "; echo "$bulan "; echo "$tahun_saiki "; ?></h4>
  <br><h4 align="left" width="80%" style="padding-left: 40px;;">Perihal :<b> Permohonan Cuti</b></h4>
  <br><h4 align="left" width="80%" style="padding-left: 40px;;">Kepada Yth,</h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Kepala Kantor Regional I BKN</h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">u.p Kepala Bagian Tata Usaha</h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">di Yogyakarta.</h4>
      <br>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Dengan Hormat,</h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Yang bertanda tangan dibawah ini :</h4>
      <br>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Nama &emsp;&emsp;&ensp;&ensp;&thinsp;&thinsp;: <?php echo $nama; ?></h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Jabatan &emsp;&emsp;&thinsp;&thinsp;&thinsp;: PPNPN</h4>
      <h4 align="left" width="80%" style="padding-left: 40px;;">Unit &emsp;&emsp;&emsp;&ensp;&ensp;:  <?php echo $unit; ?></h4>
      <br>
      <p align="justify" width="80%" style="padding-left: 40px; padding-right: 45px;">Dengan ini bermaksud mengajukan cuti selama <?php echo $jumlah; ?> hari kerja terhitung mulai hari <?php echo $waktunya; ?>, untuk permohonan <b>Cuti <?php echo $jenis_cuti; ?></b>.</p>
      <p align="justify" width="80%" style="padding-left: 40px; padding-right: 45px;">Demikian surat permohonan ini saya ajukan, atas perhatian dan kebijaksanaan Bapak dan Ibu saya ucapkan terima kasih.</p>
      <br>
      <p align="right" width="80%" style="padding-right: 115px;">Mengetahui,</p>
      <br>
      <div class="col-md-12">
      <table border="0">
        <tr>
          <td align="left" style="padding-left: 10px;" width="35%"><p>Kepala Bagian Tata Usaha</p></td>
          <td width="25%"></td>
          <td align="left" style="padding-right: 5px;" width="40%"><p><?php echo $jabatan_atasan; ?></p></td>
        </tr>       
        <tr height="10px">
          <td align="left top" style="padding-left: 10px;" width="40%"><p>Kantor Regional I BKN Yogyakarta</p></td>
          <td></td>
          <td width="35%"></td>
        </tr>
        <tr height="50px">
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
        <td align="left" style="padding-left: 10px;" width="35%"><p><u>Anang Pikukuh Purwoko, SE,MM</u><br>NIP. 197707302008121001</p></td>
          <td></td>
          <td align="left" style="font-size: 21px; padding-right: 10px;" width="40%"><p><u><?php echo $nama_atasan; ?></u><br>NIP.<?php echo $nip_atasan; ?></p></td>
        </tr>
        <tr>
          <td></td>
          <td><center><p>Pemohon</p></center></td>
          <td></td>
          <tr height="50px">
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td><center><p><?php echo $nama; ?></p></center></td>
          <td></td>
        </tr>
        </tr>
      </table>    
        
       </div>
      </div>
</div>

</body>


<script type="text/javascript">
$(document).ready(function () {
    window.print();
    window.location = "../../adminweb.php?module=cuti";
});
</script> 

</html>