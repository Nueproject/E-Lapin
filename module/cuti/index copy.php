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
          <center><h1>PENGAJUAN CUTI</h1></center>  
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">


      <?php     
      $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
      $datacuti = mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."'");
    
      while($user=mysqli_fetch_array($datauser)){        
            $user_id= $user['id']; 	
            $nama= $user['nama_pegawai']; 	
            $nippnpn= $user['nippnpn']; 	
            $username= $user['username']; 	
            $password= $user['pass']; 	
            $nik= $user['nik']; 	
            $spk= $user['spk']; 	
            $tglspk= $user['tgl_spk']; 	
            $jenis_kelamin= $user['jenis_kelamin']; 	
            $jabatan= $user['jabatan']; 	
            $nama_atasan= $user['nama_atasan']; 	
            $nip_atasan= $user['nip_atasan']; 	
            $jabatan_atasan= $user['jabatan_atasan']; 	          
      }    
      $datacutitahun= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."' and jenis_cuti ='1'");
      $jumlah_tahun = 0;
      while ($row = $datacutitahun->fetch_assoc()){
      $jumlah_tahun += $row['jml_cuti'];      
    }      

    $datacutipenting= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."' and jenis_cuti ='2'");
    $jumlah_penting = 0;
    while ($row = $datacutipenting->fetch_assoc()){
    $jumlah_penting += $row['jml_cuti'];      
    }  
    $datacutisakit= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."' and jenis_cuti ='3'");
    $jumlah_sakit = 0;
    while ($row = $datacutisakit->fetch_assoc()){
    $jumlah_sakit += $row['jml_cuti'];      
    }  
    $datacutilahir= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where us.username='".$_SESSION['username']."' and jenis_cuti ='4'");
    $jumlah_lahir = 0;
    while ($row = $datacutilahir->fetch_assoc()){
    $jumlah_lahir += $row['jml_cuti'];      
    }  
      $sisatahunan = 12 - $jumlah_tahun;
      ?>
      <div style="padding-right:35px">
       <button class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#tambahCuti">TAMBAH CUTI</button>
      </div>  <hr>
      <br>
  <div class="col-md-12">
     <!--  FORM content -->
     <br>
   
    <div class="col-md-4">  
     <div class="box-body no-padding">    
     <div class="card mb-3" style="max-width: 540px;">      
     <div class="row g-0">
          <div class="col-md-12">      
            <div class="card-body">
             <table class="table table-hover table-striped">
              <tr>
                <td> NAMA </td>
                <td> : </td>
                <td> <?php echo $nama; ?> </td>
              </tr>
              <tr>
                <td> NIPPNPN </td>
                <td> : </td>
                <td> <?php echo $nippnpn; ?> </td>
              </tr> 
              <tr>
                <td> JABATAN </td>
                <td> : </td>
                <td> <?php echo $jabatan; ?> </td>
              </tr>              
              <tr>
                <td> CUTI TAHUNAN </td>
                <td> : </td>
                <td> <?php echo $jumlah_tahun; ?> Hari - Sisa  <?php echo $sisatahunan; ?> Hari</td>
              </tr>                  
              <tr>
                <td> ALASAN PENTING </td>
                <td> : </td>
                <td> <?php echo $jumlah_penting; ?> Hari</td>
              </tr>         
              <tr>
                <td> CUTI SAKIT </td>
                <td> : </td>
                <td> <?php echo $jumlah_sakit; ?> Hari</td>
              </tr>
              <tr>
                <td> MELAHIRKAN </td>
                <td> : </td>
                <td> <?php echo $jumlah_lahir; ?> Hari</td>
              </tr>
              
              
             </table>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
      <!--  END FORM content -->
    </div> <!--  END Col MD 4 -->
    <div class="col-md-8">
  <?php  
    function  getJenis($jct){
      switch  ($jct){
          case  1:
          return  "Tahunan";
          break;
          case  2:
          return  "Alasan Penting";
          break;
          case  3:
          return  "Sakit";
          break;
          case  4:
          return  "Melahirkan";
          break;
      }
  }
 ?>
    
     <!--  FORM TABLE -->
     <div class="box-body no-padding">
        <table class="table table-hover table-striped ">
        
          <tr class="table-dark">
            <th width="3%"><center>NO</center></th>
            <th width="20%"><center>MULAI</center></th>
            <th width="20%"><center>SELESAI</center></th>
            <th width="17%"><center>JENIS</center></th>
            <th width="30%"><center>ALASAN</center></th>
            <th width= "10%"><center>CETAK</center></th>
          </tr>
			<?php
      $dataLap = mysqli_query($koneksi,"select * from cuti ct join user u on ct.id_peg = u.id where id_peg ='$user_id' order by mulai_cuti desc");  
      $no=0;
			while($pro=mysqli_fetch_array($dataLap)){
      $tgl_mulai =  $pro['mulai_cuti'];
      $tgl_selesai =  $pro['selesai_cuti'];
      $tgl_indo_mulai = date('d F Y', strtotime($tgl_mulai));
      $tgl_indo_selesai = date('d F Y', strtotime($tgl_selesai));
      $jenis = getJenis($pro['jenis_cuti']);
      $no+=1; 
			?>
          <tr>
            <td><center><?php echo $no; ?></center></td>
            <td><center><?php echo $tgl_indo_mulai; ?></center></td>
            <td><?php echo $tgl_indo_selesai; ?></td>
            <td><center><?php echo $jenis; ?></center></td>
            <td><center><?php echo $pro['alasan_cuti']; ?></center></td>
            <td><center><a class="dropdown-item" href="module/cuti/cetak_cuti.php?id=<?php echo $pro['id_cuti'];?>" onClick="return confirm('Anda yakin ingin mencetak Surat Cuti ini?')"><div class="icon-wrapper">
            <img src="img/assets/icon_page/icon_cetak2.png" width="75px" height="35px">
            </div></a></center></td>
          </tr>
    <?php } ?>
          
        </table>
      </div>
      <!--  END FORM TABLE -->
  
    </div>  <!-- end col md 8 -->
 </div>   <!-- End Col MD 12 -->


              </div> <!-- End Box Header -->
            </div> <!-- End Box -->
          </div> <!-- End Col-md-12 -->
        </div> <!-- End row -->
      </div> <!-- End Container Fluid -->
       
  <!-- Modal for Tambah CUTI -->
  <div class="modal fade bd-example-modal-md" id="tambahCuti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">TAMBAH CUTI </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/cuti/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jenis Cuti :</label>
                <input type="hidden" class="form-control" id="user_id" value="<?php echo $user_id; ?>" name="user_id" placeholder="user_id">
                <select class="form-select form-select-lg mb-3" aria-label="Large select example"  id="jenis" name="jenis">
                        <option value="1">Tahunan</option>
                        <option value="2">Alasan Penting</option>
                        <option value="3">Sakit</option>
                        <option value="4">Melahirkan</option>
                </select>
              </div> 

              <div class="form-group">
                <label for="recipient-name" class="control-label">Alasan :</label>
                <textarea class="form-control" placeholder="Uraian Kegiatan" id="alasan" name="alasan"></textarea>
              </div>
              <div class="form-group">
                    <label for="recipient-name" class="control-label">Mulai Cuti : </label><br>
                   <input type="text" class="datepicker form-select form-select-lg mb-3" name="mulai_cuti"><div class="bi bi-calendar-date"></div>
                    <script type="text/javascript">
                    $('.datepicker').datepicker({
                    //merubah format tanggal datepicker ke dd-mm-yyyy
                        format: "yyyy-mm-dd",
                        autoclose: true
                    });
                    </script>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Sampai : </label><br>
                    <!-- <input type="text" class="form-control" id="tanggal" value="<?php echo @$_SESSION['formTambahBaru']['tanggal']; ?>" name="tanggal" placeholder="Tanggal"> -->
                    <input type="text" class="datepicker form-select form-select-lg mb-3" name="selesai_cuti"><div class="bi bi-calendar-date"></div>
                   
                    <script type="text/javascript">
                    $('.datepicker').datepicker({
                    //merubah format tanggal datepicker ke dd-mm-yyyy
                        format: "yyyy-mm-dd",
                        autoclose: true
                    });
                    </script>
                  </div>
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveCuti" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for edit PASSWORD -->

    </div> <!-- END OF KOTAK -->
    </div> <!-- END OF CONTAINER -->
<?php } ?>