 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
  $datashift= mysqli_query($koneksi,"select * from shift_kerja order by nama_shift asc");	 	
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
                    <h3 class="box-title">Data Shift</h3>
                    <div class="box-tools pull-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#tambahShift">
                      <button type="button" class="btn btn-sm btn-primary">Tambah Shift</button></a>
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
                        <th class="text-center" width="150px">Nama Shift</th>
                        <th class="text-center">Jam Masuk</th>                        
                        <th class="text-center">Jam Pulang</th>
                        <th class="text-center" width="150px">Aksi</th>
                      </tr>
                      <?php           
                        $no=0;                     
                        while($usr=mysqli_fetch_array($datashift)){  
                      $no+=1;

                      ?>
                      <tr>             
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php echo $usr['nama_shift']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['jam_datang_shift']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['jam_pulang_shift']; ?>
                        </td>
                        <td class="text-center">
                        
                        <a type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editShift<?php echo $usr['id_shift'];?>" > 
                         Ubah
                        </a>
                        <a type="button" name="hapusShift" class="btn btn-sm btn-danger" href="module/sudimin/aksi_hapus_shift.php?id_shift=<?php echo $usr['id_shift'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> 
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
  <div class="modal fade bd-example-modal-lg" id="tambahShift" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">TAMBAH SHIFT </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Shift :</label>
                <input type="text" class="form-control" id="nama_shift" name="nama_shift" placeholder="Nama Shift">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jam Masuk :</label>
                <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" placeholder="Jam Masuk">
              </div>  
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jam Pulang :</label>
                <input type="text" class="form-control" id="jam_pulang" name="jam_pulang" placeholder="jam pulang">
              </div>                  
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveTambahShift" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for Tambah Shift -->

     <!-- Modal for Edit Shift -->
     <?php 
      $dataUsr = mysqli_query($koneksi,"select * from shift_kerja"); 
      while($pro=mysqli_fetch_array($dataUsr)){ 
      ?>
  <div class="modal fade bd-example-modal-lg" id="editShift<?php echo $pro['id_shift'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">EDIT SHIFT </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Shift :</label>
                <input type="hidden" class="form-control" id="id_shift" value="<?php echo $pro['id_shift'];?>" name="id_shift" placeholder="id_shift">
                <input type="text" class="form-control" id="nama_shift" value="<?php echo $pro['nama_shift'];?>" name="nama_shift" placeholder="Nama Shift">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jam Masuk :</label>
                <input type="text" class="form-control" id="jam_masuk" value="<?php echo $pro['jam_datang_shift'];?>" name="jam_masuk" placeholder="jam_masuk">
              </div>         
              <div class="form-group">
                <label for="recipient-name" class="control-label">Jam Pulang :</label>
                <input type="text" class="form-control" id="jam_pulang" value="<?php echo $pro['jam_pulang_shift'];?>" name="jam_pulang" placeholder="Jam Pulang">
              </div>    
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveEditShift" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div> <?php } ?>
        <!-- end modal for edit Absen -->
      <?php } ?>
