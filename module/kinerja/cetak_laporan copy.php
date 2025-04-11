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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="kotak">
          <center><h1>INPUT LAPORAN KINERJA</h1></center>  
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">


      <?php     
      $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
      $dataLaporan = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id"); 
      ?>
     
      <?php
      while($user=mysqli_fetch_array($datauser)){        
            $user_id= $user['id']; 	
      }
      ?>
      <div class="modal fade bd-example-modal-lg" id="tambahLaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Uraian Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="module/kinerja/aksi.php" method="post">
            <div class="modal-body">
              <div class="row">       
                <div class="col-md-12">
            
              
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Tanggal : </label>
                    <!-- <input type="text" class="form-control" id="tanggal" value="<?php echo @$_SESSION['formTambahBaru']['tanggal']; ?>" name="tanggal" placeholder="Tanggal"> -->
                    <input type="text" class="datepicker" name="tanggal" value="<?php echo @$_SESSION['formTambahBaru']['tanggal']; ?>"><div class="bi bi-calendar-date"></div>
                    <input type="hidden" class="form-control" id="id" value="<?php echo $user_id; ?>" name="id" placeholder="1">
                
                    <script type="text/javascript">
                    $('.datepicker').datepicker({
                    //merubah format tanggal datepicker ke dd-mm-yyyy
                        format: "yyyy-mm-dd",
                        autoclose: true
                    });
                    </script>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Uraian :</label>
                    <textarea class="form-control" placeholder="Uraian Kegiatan" id="uraian" name="uraian"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Jumlah Output :</label>
                    <input type="text" class="form-control" id="output" value="<?php echo @$_SESSION['formTambahBaru']['output']; ?>" name="output" placeholder="1">
                  </div> 
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Satuan :</label>
                    <input type="text" class="form-control" id="satuan" value="<?php echo @$_SESSION['formTambahBaru']['satuan']; ?>" name="satuan" placeholder="kegiatan">
                  </div>              
                </div> <!-- end col-md6 -->
              </div>  <!-- end row -->      
            </div> <!-- End Modal Body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="saveLaporan" class="btn btn-primary">SIMPAN</button>
          </div>
          </form>
        </div>
      </div>
    </div>
        <!-- end modal for tambah -->

    <select name = 'bln' style = 'position: relative' class="pull-right" onchange="change()">
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
    

     <!--  FORM TABLE -->
     <div class="box-body no-padding">
        <table class="display" id="myTable">
        <br>
        <thead>
          <tr class="table-dark">
            <th width="3%"><center>NO</center></th>
            <th width="13%"><center>TANGGAL</center></th>
            <th width="67%"><center>URAIAN</center></th>
            <th width="5px"><center>OUTPUT</center></th>
            <th width="12%"><center>SATUAN</center></th>
          </tr>
        </thead>
			<?php
        if (empty($_POST['bln'])){
          $bln=date('m'); 
        } else {
        $bln=$_POST['bln'];
        }
      $tahun = date('Y');
      $dataLap = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id where bulan ='$bln' and tahun ='$tahun' and id_peg ='$user_id' order by tgl_lap desc");  
      $no=0;
			while($pro=mysqli_fetch_array($dataLap)){
      $tgl =  $pro['tgl_lap'];
      $tgl_indo = date('d F Y', strtotime($tgl));
      $no+=1; 
			?>
      <tbody>
          <tr>
            <td><center><?php echo $no; ?></center></td>
            <td><center><?php echo $tgl_indo; ?></center></td>
            <td><?php echo $pro['uraian']; ?></td>
            <td><center><?php echo $pro['output']; ?></center></td>
            <td><center><?php echo $pro['satuan']; ?></center></td>           
            </tr>
      </tbody>
            <?php } ?>
        </table>
      </div>
      <!--  END FORM TABLE -->
      </form>

      <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
  } );
      </script>
     
       

              </div> <!-- End Box Header -->
            </div> <!-- End Box -->
          </div> <!-- End Col-md-12 -->
        </div> <!-- End row -->
      </div> <!-- End Container Fluid -->

    </div> <!-- END OF KOTAK -->
    </div> <!-- END OF CONTAINER -->
<?php } ?>