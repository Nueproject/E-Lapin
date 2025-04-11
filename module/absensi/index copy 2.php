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
        <section class="content-header"  style="background: #a5c4c6; height: 105px;">  
        <!-- MENU DASHBOARD -->      
          <div class="container-fluid"> 
            <div class="row">
              <div class="col-md-12" >            
                  <div class="container-fluid card text-bg-light">
                    <div class="row justify-content-center">   
                      <div class="col-8" align="left">
                        <span class="title"> Selamat Datang </span>
                        <h3><b>Dimas Dwi Nugroho</b></h3>
                      </div>
                      <div class="col-4" align="right">
                        <h4>Jam Kerja</h4>
                        <p>07:30 - 16:00</p>
                      </div>    
                      
                      <div class="col-12"><hr></div>  

                      <div class="item col-2">
                      <center>
                        <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px;">Absen</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_izin.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px;">Izin</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_cuti.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px;">Cuti</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_history.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px;">History</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_profil.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px;">Profil</p></strong>
                        </a>
                      </center>
                      </div>
                    </div> 
                  </div><!-- end container text center -->

                  <br>
                  <div class="section">
                    <div class="row mt-2">
                      <div style="background-color:red;" class="col-6">
                      <a href=""> 
                          <div class="stat-box text-center">
                            <div class="title text-white">Absen Masuk</div>
                            <div class="value text-white">Belum Absen</div>
                          </div>                      
                      </a>
                      </div>

                      <div class="col-6">
                      <a href=""> 
                          <div class="stat-box bg-secondary text-center">
                            <div class="title text-white">Absen Pulangk</div>
                            <div class="value text-white">Belum Absen</div>
                          </div>                      
                      </a>
                      </div>
                    </div>
                  </div>
                
                  <br>
                  <br>

                  <form id="myform" method="post">
                  <div class="col-12">
                    Absensi Bulan
                  <select name = 'bln' onchange="change()">
                  <?php
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
                  <span class="text-primary">2024</span>
                  </div>
                  <br>
                  <div class="transactions">
                    <div class="row">
                      <div class="load-home" style="display:contents">

                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4">
                              <br>
                              <img src="img/assets/ppnpn.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Hadir</h5>
                                <p>1 Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4">
                              <br>
                              <img src="img/assets/ppnpn.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Ijin</h5>
                                <p>1 Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4">
                              <br>
                              <img src="img/assets/ppnpn.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Cuti</h5>
                                <p>1 Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4">
                              <br>
                              <img src="img/assets/ppnpn.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Sakit</h5>
                                <p>1 Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                  </form>           
                  
                  <br>
                  <h5>1 Minggu Terakhir</h5>
                  <table class="table table-striped">
                    <tr style="background-color: red;">
                      <th style="color:white;">Tanggal</th>
                      <th style="color:white;">Jam Masuk</th>
                      <th style="color:white;">Jam Pulang</th>
                    </tr>
                  </table>


                            
              </div><!-- end col-md-12 -->
            </div><!-- end row -->
          </div><!-- end container -->          
         </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <?php } ?>

    