
<?php
include "lib/config.php";
include "lib/koneksi.php";
date_default_timezone_set('Asia/Jakarta');
// session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<script>
    window.location.href='../../absen/index.php';
     </script>";
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
                         $foto_absen= $absen['foto_pulang'];
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
                      <div class="item col-3">                       
                      <center>                        
                      <?php if ($m>15 or empty($jam_masukkerja) and ($tgl_masukkerja != date('Y-m-d'))) { ?>                        
                        <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=absen_datang">
                        <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:center;">Absen</p></strong>
                        </a>                        
                        <?php } else if  (!empty($jam_masukkerja) and empty($jam_pulangkerja) or $jam_pulangkerja=="00:00:00") { ?>
                          <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=absen_pulang&id=<?php echo $id_absen; ?>">
                        <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:center;">Absen</p></strong>
                        </a>  
                        <?php } else {?>
                         <div class="icon-wrapper">
                        <img src="img/assets/button/tombol/tombol_absen.png" width="50px" height="50px">
                        </div>
                          <strong><p style="font-size:10px; text-align:center;">Absen</p></strong>
                        
                        <?php } ?>
                      
                      </center>
                      </div>
                      <div class="item col-3">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=izin">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_izin.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:center;">Izin</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-3">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=cuti">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_cuti.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:center;">Cuti</p></strong>
                        </a>
                      </center>
                      </div>
                      <div class="item col-3">
                      <center>
                      <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=histori">
                          <div class="icon-wrapper">
                            <img src="img/assets/button/tombol/tombol_history.png" width="50px" height="50px">
                          </div>
                          <strong><p style="font-size:10px; text-align:center;">Histori</p></strong>
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
                      if ($m>20 or empty($jam_masukkerja)) { ?>
                          <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=absen_datang"> 
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
                      if  (empty($tgl_masukkerja)) { ?>
                             <!-- <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=absen_pulang&id=<?php echo $id_absen; ?>">  -->
                             <div class="stat-box bg-success text-center">
                                    <div class="title text-white">Absen Pulang</div>
                                    <div class="value text-white">Belum Absen</div>
                                  </div>                      
                              <!-- </a> -->
                      <?php } else if ($m>15 or $jam_pulangkerja=="00:00:00"){ ?>
                            <a style="text-decoration:none; text-align:center;" href="absensi_magang.php?module=absen_pulang&id=<?php echo $id_absen; ?>"> 
                              <div class="stat-box bg-success text-center">
                                <div class="title text-white">Absen Pulang</div>
                                <div class="value text-white">Belum Absen</div>
                              </div>                      
                            </a>
                           
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
                  <!-- <select name = 'bln' onchange="change()">
                 
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
                  </select>  -->
                  <select onchange="change()" name="bln">
                      <?php                
                       //echo "sekarang bulan ".$bulan;
                         if (empty($_POST['bln'])){
                           $angka=date('m'); 
                         } else {
                         $angka=$_POST['bln'];
                         }  
                         $bulan = getBulan($angka);
                      //$bulan = date('m');
                        if($angka ==1){echo'<option value="01" selected>Januari</option>';}else{echo'<option value="01">Januari</option>';}
                        if($angka ==2){echo'<option value="02" selected>Februari</option>';}else{echo'<option value="02">Februari</option>';}
                        if($angka ==3){echo'<option value="03" selected>Maret</option>';}else{echo'<option value="03">Maret</option>';}
                        if($angka ==4){echo'<option value="04" selected>April</option>';}else{echo'<option value="04">April</option>';}
                        if($angka ==5){echo'<option value="05" selected>Mei</option>';}else{echo'<option value="05">Mei</option>';}
                        if($angka ==6){echo'<option value="06" selected>Juni</option>';}else{echo'<option value="06">Juni</option>';}
                        if($angka ==7){echo'<option value="07" selected>Juli</option>';}else{echo'<option value="07">Juli</option>';}
                        if($angka ==8){echo'<option value="08" selected>Agustus</option>';}else{echo'<option value="08">Agustus</option>';}
                        if($angka ==9){echo'<option value="09" selected>September</option>';}else{echo'<option value="09">September</option>';}
                        if($angka ==10){echo'<option value="10" selected>Oktober</option>';}else{echo'<option value="10">Oktober</option>';}
                        if($angka ==11){echo'<option value="11" selected>November</option>';}else{echo'<option value="11">November</option>';}
                        if($angka ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
                      ?>
                        </select>
                  <span class="text-dark"><?php echo date('Y');?></span>
                  </div>
                  <br>
                  <div class="transactions">
                    <div class="row">
                      <div class="load-home" style="display:contents">
                      <?php
                      $hadir= mysqli_query($koneksi,"select count(tgl_datang) as masuk from absensi where month(tgl_datang)='$angka' and id_peg='$user_id'");	 	
                      $count = $hadir->fetch_assoc();
		                  $jml_hadir = $count['masuk'];
                       ?>
                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4" style="text-align: center;">
                              <br>
                              <img src="img/assets/button/footer/info_hadir.png" width="50px" height="60px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body" style="text-align: left;">
                                <h5>Hadir</h5>
                                <p><?php echo $jml_hadir; ?> Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        $ijin= mysqli_query($koneksi,"select count(id_izin) as iz from izin where month(mulai_izin)='$angka' and id_peg='$user_id'");	 	
                        $countijin = $ijin->fetch_assoc();
                        $jml_ijin = $countijin['iz'];
                        ?>
                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4" style="text-align: center;">
                              <br>
                              <img src="img/assets/button/footer/info_ijin.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Ijin</h5>
                                <p><?php echo $jml_ijin;?> Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php
                      $jmlcuti= mysqli_query($koneksi,"select count(status_datang) as stdatang from absensi where id_peg='$user_id' and status_datang !='Tepat Waktu'");	 	
                      $cut = $jmlcuti->fetch_assoc();      
                      $telat= $cut['stdatang'];
                       ?>
                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4" style="text-align: center;">
                              <br>
                              <img src="img/assets/button/footer/info_telat.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Telat</h5>
                                <p><?php echo $telat;?> Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                      $jmlsakit= mysqli_query($koneksi,"select sum(jml_cuti) as jmsakit from cuti where id_peg='$user_id' and jenis_cuti ='3'");	 	
                      $sak = $jmlsakit->fetch_assoc();      
                      $jum_sakit= $sak['jmsakit'];
                       ?>
                        <div class="card col-6 col-md-3 mb-2">
                          <div class="row container-fluid g-0">
                            <div class="col-4" style="text-align: center;">
                              <br>
                              <img src="img/assets/button/footer/info_sakit.png" width="50px" height="50px" style="padding-left:10px;" class="img img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                              <div class="card-body">
                                <h5>Sakit</h5>
                                <p><?php echo $jum_sakit; ?> Hari</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                  </form> <!-- FORM AUTO LOAD BY BULANG -->
                  <script>
                   
                  function change(){
                      document.getElementById("myform").submit();
                  }
                  </script>         
                  
                  <br>
                  <h5>1 Minggu Terakhir</h5>
                  <table class="table table-striped">
                    <tr style="background-color: red;">
                      <th style="color:white; align:center;"><center>Tanggal</center></th>
                      <th style="color:white;"><center>Jam Masuk</center></th>
                      <th style="color:white;"><center>Jam Pulang</center></th>
                    </tr>
                    <?php
                       $databs= mysqli_query($koneksi,"select * from absensi where id_peg='$user_id' order by id_absen DESC limit 7");	 	
                       while($absen=mysqli_fetch_array($databs)){        
                         $jam_maker = $absen['jam_datang'];
                         $tgl_maker = $absen['tgl_datang'];
                         $jam_puker= $absen['jam_pulang'];
                         $status_absen= $absen['status_datang'];
                         $status_pulang= $absen['status_pulang'];
                      ?>
                        <tr class="table table-striped"  style="background-color:white;">
                         <td><center><?php echo $tgl_maker; ?></center></td>
                         <td><center><?php echo "$jam_maker<br>";  echo $status_absen;?></center></td>
                         <td><center><?php echo "$jam_puker<br>";  echo $status_pulang;?></center></td>
                       </tr>
                      <?php
                        }
                       ?>
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

    