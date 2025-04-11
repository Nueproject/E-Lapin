<?php
session_start();
    include "../../../lib/config.php";
    include "../../../lib/koneksi.php";
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
	<title>Cetak Laporan Bulanan</title>



<?php     
      $idlap = $_GET['id'];
      $lap_bulanan= mysqli_query($koneksi,"select * from lap_bulanan where id_lapbul='".$idlap."'");	 	
      while($dataL=mysqli_fetch_array($lap_bulanan)){ 
        $idLB= $dataL['id_lapbul']; 
        $idpegLB= $dataL['id_peg']; 
        $bulanLB= $dataL['bulan']; 
        $tahunLB= $dataL['tahun']; 
        }


      $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id"); 
      while($user=mysqli_fetch_array($datauser)){        
        $user_id= $user['id']; 	
        $nama_pegawai= $user['nama_pegawai']; 	
        $nippnpn= $user['nippnpn']; 	
        $NIK= $user['nik']; 	
        $jeniskelamin= $user['jenis_kelamin']; 	
        $jabatan= $user['jabatan']; 	
        $spk= $user['spk']; 	
        $tglspk= $user['tgl_spk'];
        $nama_atasan = $user['nama_atasan'];
        $nip_atasan = $user['nip_atasan'];
        $jabatan_atasan = $user['jabatan_atasan'];
  }
?>
 
<div id="print">
	
	<br><br>
<center>
    <h4>LAPORAN BULANAN PPNPN</h4>
    <h4>PERIODE TAHUN 2025</h4>
  </center>
  <hr>
<table border="0" align="center" width="90%">
<tr>
<td align="left">
<b>A. Identitas</b>
</td>
</tr>
</table>

<table border="0" align="center" width="90%">
<tr>
  <td align="left" width="25%">Nama</td>
  <td align="center" width="5%"> : </td>
  <td align="left" width="70%"><?php echo $nama_pegawai; ?></td>
</tr>
<?php 
if ($jabatan == "Tenaga Keamanan Wanita"){
        $jab = "Tenaga Keamanan";
    } else {
      $jab = $jabatan;
    }?>
<tr>
  <td align="left">Jabatan</td>
  <td align="center"> : </td>
  <td align="left"><?php echo $jab; ?></td>
</tr>

<tr>
  <td align="left"> Nomor Induk</td>
  <td align="center">  : </td>
  <td align="left"><?php echo $nippnpn; ?></td>
</tr>
<tr>
  <td align="left">  Nomor dan Tanggal SPK</td>
  <td align="center"> : </td>
  <td align="left"><?php echo $spk; ?> Tanggal <?php echo $tglspk; ?></td>
</tr>
</table> 
<br>
</head>

<body onLoad="PrintDoc()">
<table border="0" align="center" width="90%">
<tr>
<td align="left">
<b>B. Prestasi Kerja</b>
</td>
</tr>
</table>  
<center>  
<table  width="90%" class="display stripe" id="myTable" border="1">       
        <thead>
          <tr class="table-dark">
            <th width="20%"><center>TANGGAL</center></th>
            <th width="5%"><center>NO</center></th>
            <th width="60%"><center>URAIAN</center></th>
            <th width="5px"><center>OUTPUT</center></th>
            <th width="10%"><center>SATUAN</center></th>
          </tr>
        </thead>

        <?php
    
      $no=0; 
      
      $tgllap = mysqli_query($koneksi,"select distinct tgl_lap from data_laporan where bulan ='$bulanLB' and tahun ='$tahunLB' and id_peg ='$user_id' order by tgl_lap asc");  
            while($tgl=mysqli_fetch_array($tgllap)){ 
      $hasiltgl = $tgl['tgl_lap'];  
      $jml_tgl = "select count(tgl_lap) AS tgllap from data_laporan where id_peg ='$user_id' and tgl_lap='$hasiltgl'";
      $querymax = mysqli_query($koneksi, $jml_tgl);
      $lihatjml = $querymax->fetch_assoc();
      $spantgl = $lihatjml['tgllap'];
      $row = $spantgl +=1;
      $dataLap = mysqli_query($koneksi,"select * from data_laporan where bulan ='$bulanLB' and tahun ='$tahunLB' and id_peg ='$user_id' and tgl_lap='$hasiltgl'");  
      $tgl_indo = date('d F Y', strtotime($hasiltgl));
      ?>     
              
              <tr>
                <td rowspan="<?php echo $row;?>"><center><?php echo $tgl_indo;?></center></td>
              </tr>
      <?php        
      while($pro=mysqli_fetch_array($dataLap)){ 
            $tgl =  $pro['tgl_lap'];
            $uraian =  $pro['uraian'];             
            $no+=1; 
      ?>
              <tr>
                <td><center><?php echo $no;?></center></td>
                <td style="padding-left: 7px;"><?php echo $pro['uraian']; ?></td>
                <td><center><?php echo $pro['output']; ?></center></td>
                <td><center><?php echo $pro['satuan']; ?></center></td>
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
<tr>
<td colspan="3" height="30px"></td>
</tr>
<tr border="0" align="center" width="90%">
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
    window.location = "../../../adminweb.php?module=cetak_laporan";
});
</script>

</html>