<?php

//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else { 
    include "lib/config.php";
    include "lib/koneksi.php";
  ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
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
          <center><h1>CETAK LAPORAN</h1></center>  
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
    
     <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cetakAbsensi">Cetak Absensi Random</button> 
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cetakAbsensiSystem">Cetak Absensi Harian</button>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>  

      <?php 
      $datausr = mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'"); 
      while($pro=mysqli_fetch_array($datausr)){ 
      ?>



    <div class="modal fade bd-example-modal-lg" id="cetakAbsensi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">CETAK ABSENSI RANDOM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="module/kinerja/cetak/cetak_absensi.php" method="post">
            <div class="modal-body">
              <div class="row">       
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Bulan : </label>
                    <input type="hidden" class="form-control" id="id" value="<?php echo $pro['id'];?>" name="user_id" placeholder="1">
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"  id="bulan" name="bulan">
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
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Jam Datang paling awal :</label>
                    <input type="text" class="form-control" id="output" value="06:50" name="jam_awal_datang" placeholder="06:50">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Jam Datang paling akhir :</label>
                    <input type="text" class="form-control" id="jam_akhir_datang" value="07:10" name="jam_akhir_datang" placeholder="07:10">
                  </div> 
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Jam Pulang paling awal :</label>
                    <input type="text" class="form-control" id="jam_awal_pulang" value="16:02" name="jam_awal_pulang" placeholder="16:02">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Jam Pulang paling akhir :</label>
                    <input type="text" class="form-control" id="jam_akhir_pulang" value="16:15" name="jam_akhir_pulang" placeholder="16:15">
                  </div> 
                    
                </div> <!-- end col-md6 -->
              </div>  <!-- end row -->      
            </div> <!-- End Modal Body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
          </div>
          </form>
        </div>
      </div>
    </div>
        <!-- end modal for cetak absensi random -->


      
        <div class="modal fade bd-example-modal-lg" id="cetakAbsensiSystem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CETAK ABSENSI HARIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="module/kinerja/cetak/cetak_absensi_data.php" method="post">
                <div class="modal-body">
                  <div class="row">       
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Bulan : </label>
                        <input type="hidden" class="form-control" id="id" value="<?php echo $pro['id'];?>" name="user_id" placeholder="1">
            
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example"  id="bulan" name="bulan">
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
                      </div>
                      <?php $tahun  = 'date ("Y")';?>
                      <div class="form-group">
                      <label for="recipient-name" class="control-label">Tahun :</label>
                      <select class="form-select" aria-label="Default select example" name="tahun">
                        <?php
                        $mulai= date('Y') - 2;
                        for($i = $mulai; $i<$mulai + 50; $i++){
                            //$sel = $i == date('Y') ? ' selected="selected"' : '';
                            if($tahun ==$i){
                              echo'<option value="'.$i.'"'.$i.' selected>'.$i.'</option>';
                            }else{echo'<option value="'.$i.'"'.$i.'>'.$i.'</option>';}
                   
                            // echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                      
                        }
                        ?>
                      </select>
                    </div>
                        
                    </div> <!-- end col-md6 -->
                  </div>  <!-- end row -->      
                </div> <!-- End Modal Body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
              </div>
              </form>
            </div>
          </div>
        </div> <?php } ?>
            <!-- end modal for cetak absensi Sistem -->

     <!--  FORM TABLE -->
     <div class="box-body no-padding">
        <table class="table table-hover striped ">
        <br>
          <tr class="table-dark">
            <th width="2%"><center>NO</center></th>
            <th width="27%"><center>BULAN</center></th>
            <th width="15%"><center>TAHUN</center></th>
            <th width="21%"><center>JUMLAH KEGIATAN</center></th>
            <th width="35%"><center>AKSI</center></th>
          </tr>
			<?php
      $thn = date('Y');
      $dataLap = mysqli_query($koneksi,"select * from lap_bulanan lb join user u on lb.id_peg = u.id where tahun = '2025' and id_peg ='$user_id'");  
      $no=0;
			while($pro=mysqli_fetch_array($dataLap)){
      $no+=1; 
      $bul = $pro['bulan'];
      $bul2 = getBulan($bul);
      $bulan = strtoupper($bul2);


			?>
          <tr>
            <td><center><?php echo $no; ?></center></td>
            <td><center><?php echo $bulan; ?><center></td>
            <td><center><?php echo $pro['tahun']; ?></center></td>
            <td><center><?php echo $pro['jumlah_kegiatan']; ?></center></td>
            <td><center><a href="module/kinerja/cetak/cetak_laporan.php?id=<?php echo $pro['id_lapbul']; ?>">
            <div class="icon-wrapper">
            <img src="img/assets/icon_page/icon_cetak2.png" width="75px" height="35px">
            </div>
            <p>CETAK</p>
            </a></center></td>
            
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