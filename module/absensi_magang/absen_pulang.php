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
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <style type="text/css">
            #results { padding:20px; border:1px solid; background:#ccc; }
        </style>
    
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
                      <?php
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
                        
                        ?>
                        <div class="col-8" align="left">
                      <form action="module/absensi/aksi_pulang.php" method="post">
                      <?php

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
                      }
                      }else {
                      $ucapan="Error";
                      }
                      // END FUNGSI UCAPAN
                      ?>
                        <span class="title" style="font-size:20px;"><?php echo $ucapan; ?></span>
                        <h5><b><?php echo $nama_pegawai; ?></b></h5>
                      </div>
                      <div class="col-4" align="right">
                        <span style="font-size:13px;"><?php echo "$tgl"; echo " $bulan <br>"; echo $tahun;?></span>
                        <b><span id="jam" style="font-size:15"></b>
                      </div>      
                      <script>
                        getLocation();
                        function getLocation() {
                        if (navigator.geolocation) {
                          navigator.geolocation.getCurrentPosition(showPosition);
                          } else {
                            alert("Browser Anda tidak mendukung")
                          }
                        }                        
                      function showPosition(position) {
                        $('#latitude_pegawai').val(position.coords.latitude);
                        $('#longitude_pegawai').val(position.coords.longitude);
                        }
                      </script>             
                      <?php
                      $id_absen = $_GET['id'];
                       $databsen= mysqli_query($koneksi,"select * from absensi where id_peg='$user_id' and id_absen = '$id_absen'");	 	
                       while($absen=mysqli_fetch_array($databsen)){        
                         $id_peg= $absen['id_peg'];
                         $id_kantor= $absen['id_kantor'];
                         $id_shift= $absen['id_shift'];
                       }

                       function  getLokasi($lok){
                        switch  ($lok){
                            case  1:
                            return  "Kantor Regional I BKN Yogyakarta";
                            break;
                            case  2:
                            return  "Rumah Dinas";
                            break;
                            case  3:
                            return  "Limasan";
                            break;                           
                        }
                    }

                    function  getShift($sif){
                      switch  ($sif){
                          case  1:
                          return  "Full Time";
                          break;
                          case  2:
                          return  "Shift Malam";
                          break;
                          case  3:
                          return  "Shift Pagi";
                          break;  
                          case  4:
                          return  "Sabtu";
                          break;                            
                      }
                  }

                  $datasif= mysqli_query($koneksi,"select * from shift_kerja where id_shift='$id_shift'");	 	
                  while($shift=mysqli_fetch_array($datasif)){        
                    $namasif= $shift['nama_shift'];
                    $jam_pul= $shift['jam_pulang_shift'];
                  }                        
                        $nama_lokasi=getLokasi($id_kantor);
                        $nama_shift=getShift($id_shift);
                      ?>    
                        
                          
                          <center>
                          <div class="col-8 text-center">
                          <input type="hidden" class="form-control" id="user_id" value="<?php echo $user_id;?>" name="user_id" placeholder="1">
                          <input type="hidden" id="latitude_pegawai" name="latitude_pegawai">
                          <input type="hidden" id="longitude_pegawai" name="longitude_pegawai"> 
                          <input type="hidden"  value="<?php echo $id_absen;?>" name="id_absen"> 
                          <input type="hidden"  value="<?php echo $id_kantor;?>" name="lokasi"> 
                          <input type="hidden"  value="<?php echo $id_shift;?>" name="shift"> 
                          <label for="recipient-name" class="control-label"><h6>Lokasi :<b><?php echo " $nama_lokasi";?></b></h6></label>
                          <label for="recipient-name" class="control-label"><h6>Jam Pulang : <b> <?php echo "$jam_pul";?></b></h6></label>
                          </div>
                          </center>                          
                          <div class="col-12"></div> 
                          <div class="col text-center">
                          <center> 
                            <div class="col">
                                <div id="my_camera"></div>
                                <input type="hidden" name="image" class="image-tag">  
                            </div>
                          </center><br>
                            <div class="d-grid gap-2">
                            <button  onClick="take_snapshot()" class="btn btn-success btn-lg">ABSEN PULANG</button>
                            </div>
                          </div>
                          <hr>
                          

                        </form>
                        <br/>
                          <br>
                      </div>
                    </div><!-- end container text center -->
                  </div><!-- end container text center -->
                </div><!-- end col-md-12 -->
              </div>
            </div>
          </section>
        </div>

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
      <script language="JavaScript">
      Webcam.set({
          width: 195,
          height: 255,
          image_format: 'jpeg',
          jpeg_quality: 80
      });
    
      Webcam.attach( '#my_camera' );
    
      function take_snapshot() {
          Webcam.snap( function(data_uri) {
              $(".image-tag").val(data_uri);
              document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
          } );
      }
      </script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script>
	  <?php } ?>

    