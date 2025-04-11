<?php
include "lib/config.php";
include "lib/koneksi.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
  $user = $_SESSION['username'];
 

?>
<style>
body  {
  background-image: url("img/assets/kantorbg1.jpg");
  background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
}
</style>

	 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <center>
          <h1>
           SELAMAT DATANG
          </h1></center>
        


          
       
        <!-- MENU DASHBOARD -->
          <div class="container"> 
            <div class="row">
              <div class="col-md-12" >
                <center>
                  <div class="col-md-6 col-lg-6 col-xl-8">
                    <img src="img/assets/logo_elapin.png"
                      class="figure-img img-fluid" alt="Sample image">
                  </div>    
                  <div class="col-md-6 col-lg-6 col-xl-4">
                    <img src="img/assets/icon_laporan.png"
                      class="figure-img img-fluid" alt="Sample image">
                  </div>              
                </center>
               
              </div>
            </div>
          </div>
               
                  

              
             
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <?php } ?>

    