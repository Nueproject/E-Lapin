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
          <center><h1>PROFILE</h1></center>  
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
      ?>
       <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#ubahPassword">UBAH PASSWORD</button>
       <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#ubahProfil">UBAH PROFILE</button>
      <hr>
     <!--  FORM content -->
     <div class="box-body no-padding">    
     <div class="card mb-3" style="max-width: 540px;" >      
     <!-- <div class="row g-0"> -->
          <div class="col-md-12">      
            <div class="card-body">
             <table class="table table-hover table-striped">
              <tr>
                <td> NAMA </td>
                <td> : </td>
                <td> <?php echo $nama; ?> </td>
              </tr>
              <tr>
                <td> NIK </td>
                <td> : </td>
                <td> <?php echo $nik; ?> </td>
              </tr>
              <tr>
                <td> JENIS KELAMIN </td>
                <td> : </td>
                <td> <?php echo $jenis_kelamin; ?> </td>
              </tr>
              <tr>
                <td> JABATAN </td>
                <td> : </td>
                <td> <?php echo $jabatan; ?> </td>
              </tr>
              <tr>
                <td> NIPPNPN </td>
                <td> : </td>
                <td> <?php echo $nippnpn; ?> </td>
              </tr>             
              <tr>
                <td> SPK </td>
                <td> : </td>
                <td> <?php echo $spk; ?> </td>
              </tr>
              <tr>
                <td>Tanggal SPK </td>
                <td> : </td>
                <td> <?php echo $tglspk; ?> </td>
              </tr>
              <tr>
                <td>Nama Atasan </td>
                <td> : </td>
                <td> <?php echo $nama_atasan; ?> </td>
              </tr>
              <tr>
                <td>NIP Atasan </td>
                <td> : </td>
                <td> <?php echo $nip_atasan; ?> </td>
              </tr>
              <tr>
                <td>Jabatan Atasan </td>
                <td> : </td>
                <td> <?php echo $jabatan_atasan; ?> </td>
              </tr>
              
             </table>
            </div>
          </div>
        <!-- </div> -->
        <!-- row-g -->
      </div>
      <hr>
    </div>
      <!--  END FORM content -->
  


              </div> <!-- End Box Header -->
            </div> <!-- End Box -->
          </div> <!-- End Col-md-12 -->
        </div> <!-- End row -->
      </div> <!-- End Container Fluid -->

  <!-- Modal for Ubah Profil -->
  <div class="modal fade bd-example-modal-md" id="ubahProfil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">EDIT PROFIL </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/profile/aksi.php" method="post">
          <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama :</label>
                <input type="hidden" class="form-control" id="id" value="<?php echo $user_id;?>" name="id" placeholder="1">
                <input type="text" class="form-control" id="nama" value="<?php echo $nama;?>" name="nama" placeholder="nama">
               
             
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">NIK :</label>
                <input type="text" class="form-control" id="nik" value="<?php echo $nik;?>" name="nik" placeholder="nik">
              </div> 
              <div class="form-group">
              <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
              <select class="form-select form-select-lg mb-3" aria-label="Large select example"  id="jenis_kelamin" name="jenis_kelamin">
                <option selected=""><?php echo $jenis_kelamin;?></option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              </div>
              <div class="form-group">
              <label class="input-group-text" for="inputGroupSelect01">Jabatan/Divisi </label>
              <select class="form-select form-select-lg mb-3" aria-label="Large select example"  id="jabatan" name="jabatan">
                <option selected=""><?php echo $jabatan;?></option>
                <option value="Tenaga Keamanan">Security</option>
                <option value="Tenaga Keamanan Wanita">Security Cewek</option>
                <option value="Tenaga Pramubakti">Pramubakti</option>
                <option value="Tenaga Kebersihan">Cleaning Service</option>
                <option value="Tenaga Pengemudi">Driver</option>
              </select>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">NIPPNPN :</label>
                <input type="text" class="form-control" id="nippnpn" value="<?php echo $nippnpn;?>" name="nippnpn" placeholder="nippnpn">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">SPK :</label>
                <input type="text" class="form-control" id="spk" value="<?php echo $spk;?>" name="spk" placeholder="spk">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tanggal SPK :</label>
                <input type="text" class="form-control" id="tglspk" value="<?php echo $tglspk;?>" name="tglspk" placeholder="tglspk">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Atasan :</label>
                <input type="text" class="form-control" id="nama_atasan" value="<?php echo $nama_atasan;?>" name="nama_atasan" placeholder="nama_atasan">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">NIP Atasan :</label>
                <input type="text" class="form-control" id="nip_atasan" value="<?php echo $nip_atasan;?>" name="nip_atasan" placeholder="nip_atasan">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jabatan Atasan :</label>
                <input type="text" class="form-control" id="jabatan_atasan" value="<?php echo $jabatan_atasan;?>" name="jabatan_atasan" placeholder="Jabatan_atasan">
              </div> 
             
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveEditProfil" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for edit -->

        
  <!-- Modal for EDIT PASSWORD -->
  <div class="modal fade bd-example-modal-md" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">UBAH PASSWORD </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/profile/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="control-label">USERNAME :</label>
                <input type="hidden" class="form-control" id="user_id" value="<?php echo $user_id;?>" name="user_id" placeholder="1">
                <input type="text" class="form-control" id="username" value="<?php echo $username;?>" name="username" placeholder="username">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">PASSWORD :</label>
                <input type="text" class="form-control" id="password" value="<?php echo $password;?>" name="password" placeholder="password">
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveUbahPasword" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for edit PASSWORD -->

    </div> <!-- END OF KOTAK -->
    </div> <!-- END OF CONTAINER -->
<?php } ?>