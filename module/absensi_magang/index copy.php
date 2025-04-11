
<?php
include "lib/config.php";
include "lib/koneksi.php";
date_default_timezone_set('Asia/Jakarta');
// session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
  $user = $_SESSION['username'];
  $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
  while($user=mysqli_fetch_array($datauser)){        
    $user_id= $user['id'];
    $nama_pegawai= $user['nama_pegawai']; 	
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
$bln=date('m');
$bulan=getBulan($bln);
$tgl = date('d');
$tahun = date('Y');
$waktu=gmdate("H:i",time()+7*3600);
$t=explode(":",$waktu);
$jam=$t[0];
$menit=$t[1];
if ($jam >= 00 and $jam < 10 ){
if ($menit >00 and $menit<60){
$ucapan="Selamat Pagi";
}
}else if ($jam >= 10 and $jam < 15 ){
if ($menit >00 and $menit<60){
$ucapan="Selamat Siang";
}
}else if ($jam >= 15 and $jam < 18 ){
if ($menit >00 and $menit<60){
$ucapan="Selamat Sore";
}
}else if ($jam >= 18 and $jam <= 24 ){

if ($menit >00 and $menit<60){
$ucapan="Selamat Malam";
}else {
$ucapan="Error";
}
}

                       $tgl_saiki = date('Y-m-d');
                       $jam_masukkerja="";
                       $tgl_masukkerja="";
                       $jam_pulangkerja="";
                       $tgl_pulangkerja="";
                       $databsen= mysqli_query($koneksi,"select * from absensi where id_peg='$user_id' order by id_absen DESC limit 1 ");	 	
                       while($absen=mysqli_fetch_array($databsen)){        
                         $id_absen= $absen['id_absen'];
                         $jam_masukkerja= $absen['jam_datang'];
                         $tgl_masukkerja= $absen['tgl_datang'];
                         $jam_pulangkerja= $absen['jam_pulang'];
                         $status_absen= $absen['status_datang'];
                       }
                       $jamsaiki = strtotime(date("Y-m-d H:i:s"));
                       $waktudatang ="$tgl_masukkerja $jam_masukkerja";
                       $angka_maker = strtotime($waktudatang);
                        //$dat= strtotime($jam_datang);
                        //$masuk= strtotime($jam_masukkerja);
                        $selisih = $jamsaiki-$angka_maker;  
                        $jam = ($selisih / (60 * 60));
                        $m = number_format($jam,2);                                               
                      ?>
	 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">  
        <!-- MENU DASHBOARD -->      
          <div class="container-fluid"> 
            <div class="row">
              <div class="col-md-12" >            
                  <div class="container-fluid card text-bg-light">
                    <div class="row justify-content-center">   
                      <div class="col-8" align="left">
                        <span class="title" style="font-size:20px;"><?php echo $ucapan; ?></span>
                        <h3><b><?php echo $nama_pegawai; ?></b></h3>
                      </div>
                      <div class="col-4" align="right">
                      <h7><?php echo "$tgl "; echo "$bulan "; echo $tahun;?></h7><br>
                       <b> <span id="jam" style="font-size:20"></b>
                      </div>    
                      
                      <div class="col-12"><hr></div> 
                      <div class="item col-2">                       
                      <center>                        
                      <?php if ($m>12 or empty($jam_masukkerja) and ($tgl_masukkerja != date('Y-m-d'))) { ?>                        
                        <a style="text-decoration:none; text-align:center;" href="absensi.php?module=absen_datang">
                        <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:right;">Absen</p></strong>
                        </a>                        
                        <?php } else if  (!empty($jam_masukkerja) and empty($jam_pulangkerja) or $jam_pulangkerja=="00:00:00") { ?>
                          <a style="text-decoration:none; text-align:center;" href="absensi.php?module=absen_pulang&id=<?php echo $id_absen; ?>">
                        <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:right;">Absen</p></strong>
                        </a>  
                        <?php } else {?>
                         <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:right;">Absen</p></strong>
                        
                        <?php } ?>
                      
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_izin.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:center;">Izin</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_cuti.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:center;">Cuti</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_history.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:right;">Histori</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-2">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="./absent">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_profil.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:right;">Profil</p></strong>
                        </a>
                      </center>
                      </div>
                    </div> 
                  </div><!-- end container text center -->

                  <br>
                  <div class="section">
                    <div class="row mt-2">
                      
                      <div style="background-color:red;" class="col-6">
                      <?php
                      if ($m>12 or empty($jam_masukkerja)) { ?>
                          <a style="text-decoration:none; text-align:center;" href="absensi.php?module=absen_datang"> 
                          <div class="stat-box text-center">
                            <div class="title text-white">Absen Masuk</div>
                            <div class="value text-white">Belum Absen</div>
                          </div>                      
                          </a>
                        <?php } else { ?>
                          <div class="stat-box text-center">
                            <div class="title text-white">Sudah Absen</div>
                            <div class="value text-white"><?php echo $jam_masukkerja; ?></div>
                          </div>
                       <?php } ?>
                      </div>

                      <div class="col-6">
                      <?php
                      if  ((empty($jam_masukkerja) or  $tgl_masukkerja== date('Y-m-d') and $m>8 or $jam_pulangkerja=="00:00:00")) { ?>
                            <a style="text-decoration:none; text-align:center;" href="absensi.php?module=absen_pulang&id=<?php echo $id_absen; ?>"> 
                              <div class="stat-box bg-success text-center">
                                <div class="title text-white">Absen Pulang</div>
                                <div class="value text-white">Belum Absen</div>
                              </div>                      
                            </a>
                      <?php } else if ($tgl_masukkerja != date('Y-m-d')){ ?>
                        
                            <!-- <a style="text-decoration:none; text-align:center;" href="absensi.php?module=absen_pulang&id=<?php echo $id_absen; ?>">  -->
                            <div class="stat-box bg-success text-center">
                                    <div class="title text-white">Absen Pulang</div>
                                    <div class="value text-white">Belum Absen</div>
                                  </div>                      
                              <!-- </a> -->
                        <?php } else { ?>
                        <div class="stat-box bg-success text-center">
                            <div class="title text-white">Sudah Absen</div>
                            <div class="value text-white"><?php echo $jam_pulangkerja; ?></div>
                          </div>  
                          <?php } ?>
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
                      <th style="color:white;">Keterangan</th>
                    </tr>
                  </table>
                  <br><br><br>


                            
              </div><!-- end col-md-12 -->
            </div><!-- end row -->
          </div><!-- end container -->          
         </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script type="text/javascript">
        window.onload = function() { jam(); }
       
        function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
       
            e.innerHTML = h +':'+ m +':'+ s;
       
            setTimeout('jam()', 1000);
        }
       
        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
    </script>
	  <?php } ?>

    