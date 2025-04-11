
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
          <div class="container"> 
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
                       
                  <form id="myform" method="post">
                  <center>
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
                    $bulan = getBulan($angka);
                    $tahun = date('Y');
                    ?>
                  
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
                  <span class="text-dark"><?php echo " $tahun"; ?></span>
                  </div> </center>                       
                  <br>
                  <table class="table table-striped">
                    <tr style="background-color: red;">
                      <th style="color:white; align:center;"><center>Tanggal</center></th>
                      <th style="color:white;"><center>Jam Masuk</center></th>
                      <th style="color:white;"><center>Jam Pulang</center></th>
                      <th style="color:white;"><center>Keterangan</center></th>
                      <th style="color:white;"><center>Aksi</center></th>
                    </tr>
                    <?php
                       $databs= mysqli_query($koneksi,"select * from absensi where id_peg='$user_id' and month(tgl_datang)='$angka' and year(tgl_datang)='$tahun' order by id_absen DESC limit 7");	 	
                       while($absen=mysqli_fetch_array($databs)){        
                         $id_abs = $absen['id_absen'];
                         $jam_maker = $absen['jam_datang'];
                         $tgl_maker = $absen['tgl_datang'];
                         $jam_puker= $absen['jam_pulang'];
                         $status_absen= $absen['status_datang'];
                         $status_pulang= $absen['status_pulang'];
                         $ket= $absen['keterangan'];
                      ?>
                        <tr class="table table-striped">
                         <td><?php echo $tgl_maker; ?></td>
                         <td><center><?php echo "$jam_maker<br>";  echo $status_absen;?></center></td>
                         <td><center><?php echo "$jam_puker<br>";  echo $status_pulang;?></center></td>
                         <td><center><?php echo $ket;?></center></td>
                         <td><center><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#tambahKet<?php echo $id_abs;?>"><div class="icon-wrapper">Keterangan</button>
                          </center></td>
                       </tr>
                      <?php
                        }
                       ?>
                  </table>
                </form>           
                  
                  <br><br><br>
                </div> 
            </div><!-- end container text center -->
            
            <!-- Modal for Tambah Keterangan -->
  <?php
  $abs="SELECT * FROM absensi";                    
  $queryabs = mysqli_query($koneksi, $abs);
  while($rowabs=mysqli_fetch_array($queryabs)){  
  $idabs = $rowabs['id_absen'];  
  $ket = $rowabs['keterangan'];  
  ?>
 
  <div class="modal fade bd-example-modal-md" id="tambahKet<?php echo $idabs;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">TAMBAH KETERANGAN </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/histori/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Keterangan :</label>
                <input type="hidden" class="form-control" id="id_absen" value="<?php echo $idabs; ?>" name="id_absen" placeholder="id_absen">
                <textarea type="text" class="form-control" id="ket" value="" name="keterangan" placeholder="keterangan"><?php echo $ket; ?></textarea>
             
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveKeterangan" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>  <?php } ?>
        <!-- end modal for edit PASSWORD -->


                            
              </div><!-- end col-md-12 -->
            </div><!-- end row -->
          </div><!-- end container -->          
         </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script>
      function change(){
          document.getElementById("myform").submit();
      }
      </script>
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

    