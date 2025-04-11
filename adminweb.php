<?php
include "lib/config.php";     			
include "lib/koneksi.php";

require_once __DIR__ . '/vendor/autoload.php';

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

 	  


	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>E-Lapin Dong!</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Theme style -->
		<!-- <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css"> -->
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<!-- <link rel="stylesheet" href="asset/dist/css/skins/_all-skins.min.css"> -->


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
			<li><a class="dropdown-item" href="adminweb.php?module=kinerja">Input Kinerja</a></li>
			<li><a class="dropdown-item" href="adminweb.php?module=status">Status Laporan</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="adminweb.php?module=cetak_laporan">Cetak Laporan</a></li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="adminweb.php?module=cuti"><h5 style="color : black;">CUTI</h5></a>
		</li>	
		<li class="nav-item">
			<a class="nav-link" href="adminweb.php?module=izin"><h5 style="color : black;">IZIN</h5></a>
		</li>	
		<li class="nav-item">
			<a class="nav-link" href="adminweb.php?module=profile"><h5 style="color : black;">PROFILE</h5></a>
		</li>	
	</ul>
	   </div>
  </div>
  <form class="container-fluid justify-content-end">
    <a href="logout.php"  onClick="return confirm('Anda yakin ingin mau keluar?')"> <button class="btn btn-outline-success me-2" type="button">LOGOUT</button></a>
  </form>
</nav>
	
		

			
			<?php

            if ($_GET['module'] == 'home') {
                include "module/home/index.php";

			} elseif ($_GET['module'] == 'kinerja') {
                include "module/kinerja/index.php";
            } elseif ($_GET['module'] == 'status') {
                include "module/status/index.php";
            } elseif ($_GET['module'] == 'profile') {
                include "module/profile/index.php";
            } elseif ($_GET['module'] == 'cetak_laporan') {
                include "module/kinerja/cetak/isi_cetak.php";
            } elseif ($_GET['module'] == 'cuti') {
                include "module/cuti/index.php";		
			} elseif ($_GET['module'] == 'izin') {
                include "module/izin/index.php";			
			} 

            else {
            	 include "module/home/index.php";
            }
			?>

		

			<!-- Control Sidebar -->

		

		

		

	      <script type="text/javascript" src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	 


<!-- jQuery 2.1.4 -->
<script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery 2.1.4 -->
		<script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="asset/bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="asset/plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="asset/dist/js/app.min.js"></script>
		<!-- Sparkline -->
		<script src="asset/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="asset/plugins/chartjs/Chart.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="asset/dist/js/pages/dashboard2.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="asset/dist/js/demo.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<!-- CSS Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<!-- CSS Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- Javascript Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js">
</script>
<!-- Javascript Bootstrap Datepicker -->
<script
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
</script>
	</body>
</html>
<?php } ?>
