 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
  $datauser= mysqli_query($koneksi,"select * from user where jabatan ='admin' or jabatan ='sudimin' order by nama_pegawai asc");	 	
  $datachartabsen= mysqli_query($koneksi,"select * from absensi");	 	
  $datacuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where status_cuti = 'Belom ditinjau' order by mulai_cuti");	 	
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where id_peg = '$id_pegawai' and month(tgl_datang) = '$bulan' and year(tgl_datang)='$tahun'");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where status1 = '0'");	 	
?>
    <form action="" method="post">
      <div class="content-wrapper">
        <section class="content">
            <div class="row">
              
              <div class="row box box-solid">
                <br>               
                  <div class="box-header with-border">
                    <h3 class="box-title">Data Admin</h3>
                    <div class="box-tools pull-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#tambahAdmin">
                      <button type="button" class="btn btn-sm btn-primary">Tambah Admin</button></a>
                    
                    </div>
                  </div>
                  <br>
                  <br>
                  
                
                  <!-- ABSEN HARI INI -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-solid">
              <div class="box-body no-padding">
                <table class="table table-hover table-striped" style="overflow-x: auto!important;">
                  <tbody>
                      <tr class="table-dark">
                        <th style="width: 10px" class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIP</th>                        
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Username</th>                        
                        <th class="text-center">Password</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                      <?php           
                        $no=0;                     
                        while($usr=mysqli_fetch_array($datauser)){  
                        $usr_id = $usr['id'];
                      $no+=1;

                      ?>
                      <tr>             
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php echo $usr['nama_pegawai']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['nippnpn']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['jabatan']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['username']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['pass']; ?>
                        </td>
                        <td class="text-center">
                        
                        <a type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editAdmin<?php echo $usr['id'];?>" > 
                         Ubah
                        </a>
                        <a type="button" name="hapusAdmin" class="btn btn-sm btn-danger" href="module/sudimin/aksi_hapus.php?id=<?php echo $usr['id'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> 
                         Hapus
                        </a>
                        </td>
                      
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>              
            </div> <!-- end box solid -->
          </div>
          <!-- END ABSEN HARI INI -->
         
             



              </div> <!-- end of ROW BOX SOLID -->
            </div>
                 
          </div>
         </section>
      </div>
    </form>

     <!-- Modal for Tambah Admin -->    
  <div class="modal fade bd-example-modal-lg" id="tambahAdmin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">TAMBAH ADMIN </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Pegawai :</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">NIP :</label>
                <input type="text" class="form-control" id="nip" name="nip" placeholder="nip">
              </div>         
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jabatan :</label>
                      <select class="form-select" aria-label="Default select example" name="jabatan">
                      <option value="admin">Admin</option>                                        
                      <option value="sudimin">Super Admin</option>                                        
                      </select>
                     </div>      
              <div class="form-group">
                <label for="recipient-name" class="control-label">Username :</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
              </div>   
              <div class="form-group">
                <label for="recipient-name" class="control-label">Password :</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="password">
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveTambahAdmin" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for edit Absen -->

     <!-- Modal for Edit Absen -->
     <?php 
      $dataUsr = mysqli_query($koneksi,"select * from user"); 
      while($pro=mysqli_fetch_array($dataUsr)){ 
      ?>
  <div class="modal fade bd-example-modal-lg" id="editAdmin<?php echo $pro['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">EDIT ADMIN </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Pegawai :</label>
                <input type="hidden" class="form-control" id="id_peg" value="<?php echo $pro['id'];?>" name="id_peg" placeholder="1">
                <input type="text" class="form-control" id="nama_pegawai" value="<?php echo $pro['nama_pegawai'];?>" name="nama_pegawai" placeholder="1">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">NIP :</label>
                <input type="text" class="form-control" id="nip" value="<?php echo $pro['nippnpn'];?>" name="nip" placeholder="nip">
              </div>         
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jabatan :</label>
                <input type="text" class="form-control" id="jabatan" value="<?php echo $pro['jabatan'];?>" name="jabatan" placeholder="Jabatan">
              </div>      
              <div class="form-group">
                <label for="recipient-name" class="control-label">Username :</label>
                <input type="text" class="form-control" id="username" value="<?php echo $pro['username'];?>" name="username" placeholder="username">
              </div>   
              <div class="form-group">
                <label for="recipient-name" class="control-label">Password :</label>
                <input type="text" class="form-control" id="password" value="<?php echo $pro['pass'];?>" name="password" placeholder="password">
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveEditAdmin" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div> <?php } ?>
        <!-- end modal for edit Absen -->
      <?php } ?>
