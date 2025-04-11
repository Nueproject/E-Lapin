<?php
    include "../../lib/config.php";
    include "../../lib/koneksi.php";
    
ob_start();
session_start();

//unset($_SESSION['productListUpdatePO']);

if (empty($_SESSION['username']) AND empty($_SESSION['pass'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
	$user = $_SESSION['username'];
   // $sqlUser = "select * from user where username='".$_SESSION['username']."'";

 	$kuerisqluser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");
 
 	$user = $_SESSION['username'];
  

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
 
  //echo "sekarang bulan ".$bulan;
    if (empty($_POST['bln'])){
      $angka=date('m'); 
    } else {
    $angka=$_POST['bln'];
    }  
    $bulan = getBulan($angka);?>

  
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>LAPORAN BULAN <?php echo strtoupper($bulan); ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  </head>
  <nav class="navbar navbar-expand-lg" style="background-color: #DCDCDC;" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="logo navbar-brand" href="adminweb.php?module=home"><b style="color : black;">PPNPN</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
	
    <div class="collapse navbar-collapse" id="navbarNav">
	<ul class="nav nav-pills">
		<!-- <li class="nav-item">
			<a class="nav-link" aria-current="page" href="adminweb.php?module=home"><h5 style="color : black;">HOME</h5></a>
		</li> -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><h5 style="color : black;">KINERJA</h5></a>
			<ul class="dropdown-menu">
			<li><a class="dropdown-item" href="../../adminweb.php?module=kinerja">Input Kinerja</a></li>
			<li><a class="dropdown-item" href="../../adminweb.php?module=status">Status Laporan</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="#">Cetak Laporan</a></li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../../adminweb.php?module=profile"><h5 style="color : black;">PROFILE</h5></a>
		</li>
		</ul>
    </div>
  </div>
</nav>


<form id="myform" method="post">
        
     <!--  ISI CONTENT -->
     <table id="example" class="display nowrap stripe" style="width:100%">
    
        <thead class="cell-border">
    <tr>
      <td colspan="5">
    <select name = 'bln' style = 'position: relative' class="pull-right" onchange="change()">
        <option value="<?php echo $angka?>"><?php echo $bulan?></option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
     <?php     
      $datauser= mysqli_query($koneksi,"select * from user where username='admin'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id where bulan ='$angka'"); 
      while($user=mysqli_fetch_array($datauser)){        
            $user_id= $user['id']; 	
      }
      ?>
      </td>
    </tr>
        <tr class="dark">          
           <th><center>TANGGAL</center></th>
            <th><center>NO</center></th>
            <th><center>URAIAN</center></th>
            <th><center>OUTPUT</center></th>
            <th><center>SATUAN</center></th>
          </tr>
        </thead>
        <tbody>
        <?php
        $tahun = date('Y');
     
      $dataLap = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id where bulan ='$angka' and tahun ='$tahun' and id_peg ='$user_id' order by tgl_lap desc");  
      $no=0;
			while($pro=mysqli_fetch_array($dataLap)){
      $tgl =  $pro['tgl_lap'];
      $tgl_indo = date('d F Y', strtotime($tgl));
      $no+=1; 
      $jml_tgl = "select count(tgl_lap) AS tgllap from data_laporan where id_peg ='$user_id' and tgl_lap='$tgl'";
  		$querymax = mysqli_query($koneksi, $jml_tgl);
	  	$lihatjml = $querymax->fetch_assoc();
      $angkatgl = $lihatjml['tgllap'];
       } ?>
       <?php
       $tgllap = mysqli_query($koneksi,"select tgl_lap from data_laporan dl join user u on dl.id_peg = u.id where bulan ='$angka' and tahun ='$tahun' and id_peg ='$user_id' order by tgl_lap desc");   
	  		while($tgl=mysqli_fetch_array($tgllap)){
          echo $tgllap;
        }
       ?>
            <tr>              
            <td rowspan="<?php echo $angkatgl; ?>"><center><?php echo $tgl_lap; ?></center></td>
            <td><center><?php echo $no; ?></center></td>
            <td><?php echo $pro['uraian']; ?></td>
            <td><center><?php echo $pro['output']; ?></center></td>
            <td><center><?php echo $pro['satuan']; ?></center></td>  
            </tr>
            
        </tbody>
    </table>


    <script>
        $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
      <!--  END ISI CONTENT TABLE -->

      </form>

      <script>
      function change(){
          document.getElementById("myform").submit();
      }
      </script>








      <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="../../asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

		<!-- Bootstrap 3.3.5 -->
		<script src="../../asset/bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../../asset/plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../../asset/dist/js/app.min.js"></script>
		<!-- Sparkline -->
		<script src="../../asset/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="../../asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="../../asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="../../asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="../../asset/plugins/chartjs/Chart.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="../../asset/dist/js/pages/dashboard2.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="../../asset/dist/js/demo.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<!-- CSS Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<!-- CSS Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">

<!-- jQuery -->
<!-- Javascript Bootstrap Datepicker -->
<script
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
</script>


</html>
<?php } ?>
      
     
       