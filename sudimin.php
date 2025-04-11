<?php
include "lib/config.php";     			
include "lib/koneksi.php";

require_once __DIR__ . '/vendor/autoload.php';

ob_start();
session_start();

//unset($_SESSION['productListUpdatePO']);

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
	$user = $_SESSION['username'];
	$kuerisqluser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");
    $r = mysqli_fetch_array($kuerisqluser); 
	$jab = $r['jabatan'];

if ($jab != 'sudimin'){
	echo "<center>Maaf, HALAMAN ANDA BUKAN DISINI! <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else {


	?>
<!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Halaman Super Admin</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" type="image/png" href="img/assets/logobkn.png">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="asset/dist/css/skins/_all-skins.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="sidebar-mini skin-blue-light fixed">
		<div class="wrapper">

			<header class="main-header">

				<!-- Logo -->
				<a href="adminweb.php?module=home" class="logo dropdown-item"> 
					<!-- mini logo for sidebar mini 50x50 pixels --> 
					<span class="logo-mini"><b>A</b>LT</span> 
					<!-- logo for regular state and mobile devices --> 
					<span class="logo-lg"><b>Admin</b>Sistem</span> 
				</a>

				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation" style="height:10px;">
					<!-- Sidebar toggle button-->
					<a  style="padding-top:5px; height: 35px; width:50px;" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only"></span> </a>
					<!-- Navbar Right Menu -->
					
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">							
							<li class="dropdown user user-menu pull-right">								
								<a href="#" class="dropdown-togglenav" data-toggle="dropdown" style="padding-right:10px;"> <img src="img/assets/ppnpn.png" class="user-image" alt="User Image"></a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="img/assets/ppnpn.png" class="img-circle" alt="User Image">
										<p>
											My Sistem Terpadu
											<small>Kanreg I BKN Yogyakarta</small>
										</p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="absensi.php?module=profil" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
							<!-- Control Sidebar Toggle Button -->

						</ul>
					</div>


				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img src="img/assets/logobkn.png" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p>
								<?php 	  echo "<text class='text-uppercase'> $user </text>"; ?>
							</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<br>
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="header">
							MAIN NAVIGATION
						</li>

						<li>
							<a  class="dropdown-item" href="sudimin.php?module=home"> <i class="fa fa-home"></i> <span>Home</span> </a>
						</li>
					
						
						<li>
							<a class="dropdown-item" href="sudimin.php?module=absen_harian"> <i class="fa fa-calendar-o"></i> <span>Data Absensi</span> </a>
						</li>
						<li>
							<a class="dropdown-item" href="sudimin.php?module=rekap_absensi"> <i class="fa fa-clock-o"></i> <span>Rekap Absensi</span> </a>
						</li>
           				 
						<li>
							<a class="dropdown-item" href="sudimin.php?module=data_izin"> <i class="fa fa-inbox"></i> <span>Data Izin</span> </a>
						</li>
						<li>
							<a class="dropdown-item" href="sudimin.php?module=data_cuti"> <i class="fa fa-location-arrow"></i> <span>Data Cuti</span> </a>
						</li>
						<li>
							<a class="dropdown-item" href="sudimin.php?module=data_laporan"> <i class="fa fa-print"></i> <span>Data Laporan</span> </a>
						</li>
						<li>
							<a class="dropdown-item" href="sudimin.php?module=data_admin"> <i class="fa fa-print"></i> <span>Admin</span> </a>
						</li>
						<li><a class="dropdown-item" href="sudimin.php?module=data_laporan"> <i class="fa fa-print"></i> <span>Setting</span> </a>
							<ul class="treeview-menu">
								<li><a class="dropdown-item" href="sudimin.php?module=data_lokasi"> <i class="fa fa-building"></i> <span>Lokasi Kerja</span></a></li>
								<li><a class="dropdown-item" href="sudimin.php?module=data_shift"> <i class="fa fa-bell"></i> <span>Shift Kerja</span></a></li>
								<li><a class="dropdown-item" href="sudimin.php?module=data_user"> <i class="fa fa-user"></i> <span>Data User</span></a></li>
							</ul>
						</li>						
						<li>
							<a class="dropdown-item" href="logout.php"> <i class="fa fa-power-off"></i> <span>Logout</span> </a>
						</li>



					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
			<?php

            if ($_GET['module'] == 'home') {
                include "module/sudimin/index.php";

			} elseif ($_GET['module'] == 'ngadimin') {
                include "module/sudimin/list_user.php";
            } elseif ($_GET['module'] == 'detail_lap') {
                include "module/sudimin/detail_lap.php";
            } elseif ($_GET['module'] == 'absen_harian') {
                include "module/sudimin/absen_harian.php";
            } elseif ($_GET['module'] == 'detail_absen') {
                include "module/sudimin/detail_absen.php";
			} elseif ($_GET['module'] == 'rekap_absensi') {
                include "module/sudimin/rekap_absensi.php";
			} elseif ($_GET['module'] == 'data_izin') {
                include "module/sudimin/data_izin.php";
			} elseif ($_GET['module'] == 'data_cuti') {
                include "module/sudimin/data_cuti.php";
			} elseif ($_GET['module'] == 'data_laporan') {
                include "module/sudimin/data_laporan.php";
			} elseif ($_GET['module'] == 'data_admin') {
                include "module/sudimin/data_admin.php";
			} elseif ($_GET['module'] == 'data_lokasi') {
                include "module/sudimin/data_lokasi.php";
			} elseif ($_GET['module'] == 'data_shift') {
                include "module/sudimin/data_shift.php";
            } elseif ($_GET['module'] == 'data_user') {
                include "module/sudimin/data_user.php";
			} else {
            	 include "module/home/index.php";
            }
			?>

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 0.1.0
				</div>
				<strong>Copyright &copy; 2024 <a href="https://instagram.com/dimasdwinue">Dimas BKN</a>.</strong> All rights reserved.
			</footer>

			<!-- Control Sidebar -->

			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>

		</div><!-- ./wrapper -->

		<script type="text/javascript" src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	 	<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
		<!-- jQuery 2.1.4 -->
		<script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery 2.1.4 -->
		<script src="asset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<!-- <script src="asset/bootstrap/js/bootstrap.min.js"></script> -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		
	</body>
</html>
<?php 
} //else admin bukan

} //else login
?>
