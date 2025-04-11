<?php

//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else { 
    include "lib/config.php";
    include "lib/koneksi.php";
  ?>
  <!-- CSS Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<!-- CSS Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<!-- Javascript Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<!-- Javascript Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>



    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="kotak">
          <center><h1>STATUS LAPORAN</h1></center>  
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">


      <?php     
      $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id"); 
    
      while($user=mysqli_fetch_array($datauser)){        
            $user_id= $user['id']; 	
      }
      ?>
      
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
  }    ?>
    

     <!--  FORM TABLE -->
     <div class="box-body no-padding">
        <table class="table table-hover table-striped ">
        <br>
          <tr class="table-dark">
            <th width="2%"><center>NO</center></th>
            <th width="27%"><center>BULAN</center></th>
            <th width="15%"><center>TAHUN</center></th>
            <th width="21%"><center>JUMLAH KEGIATAN</center></th>
            <th width="35%"><center>STATUS</center></th>
          </tr>
			<?php
      $thn = date('Y');
      $dataLap = mysqli_query($koneksi,"select * from lap_bulanan lb join user u on lb.id_peg = u.id where tahun = '$thn' and id_peg ='$user_id'");  
      $no=0;
			while($pro=mysqli_fetch_array($dataLap)){
      $no+=1; 
      $bul = $pro['bulan'];
      $bul2 = getBulan($bul);
      $bulan = strtoupper($bul2);

  
  
  if ($pro['status1']=="di Tolak"){
    $warnastats = "table-danger";
  } else if ($pro['status1']=="di Setujui"){
    $warnastats = "table-success";
  } else {
    $warnastats = "table-warning";
  }
			?>
          <tr>
            <td><center><?php echo $no; ?></center></td>
            <td><center><?php echo $bulan; ?><center></td>
            <td><center><?php echo $pro['tahun']; ?></center></td>
            <td><center><?php echo $pro['jumlah_kegiatan']; ?></center></td>
            <td class="<?php echo $warnastats; ?>"><center><?php echo $pro['status1']; ?></center></td>
            
          </tr>
          <?php } ?>
        </table>
      </div>
      <!--  END FORM TABLE -->
      </form>


              </div> <!-- End Box Header -->
            </div> <!-- End Box -->
          </div> <!-- End Col-md-12 -->
        </div> <!-- End row -->
      </div> <!-- End Container Fluid -->

    </div> <!-- END OF KOTAK -->
    </div> <!-- END OF CONTAINER -->
<?php } ?>