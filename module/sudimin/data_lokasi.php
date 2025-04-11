 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
  $datalokasi= mysqli_query($koneksi,"select * from kantor");	 	
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
                    <h3 class="box-title">Data Lokasi</h3>
                    <div class="box-tools pull-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#tambahLokasi">
                      <button type="button" class="btn btn-sm btn-primary">Tambah Lokasi</button></a>
                    
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
                        <th class="text-center" width="150px">Nama Kantor</th>
                        <th class="text-center">Alamat</th>                        
                        <th class="text-center">Latitude, Longitude</th>
                        <th class="text-center" width="150px">Jangkauan (m)</th>
                        <th class="text-center" width="150px">Aksi</th>
                      </tr>
                      <?php           
                        $no=0;                     
                        while($usr=mysqli_fetch_array($datalokasi)){  
                        $usr_id = $usr['id_kantor'];
                      $no+=1;

                      ?>
                      <tr>             
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php echo $usr['nama_kantor']; ?>
                        </td>
                        <td class="text-right">
                          <?php echo $usr['alamat']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['lat_long']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $usr['radius']; ?>
                        </td>
                        <td class="text-center">
                        
                        <a type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLokasi<?php echo $usr['id_kantor'];?>" > 
                         Ubah
                        </a>
                        <a type="button" name="hapusLokasi" class="btn btn-sm btn-danger" href="module/sudimin/aksi_hapus_lokasi.php?id_lokasi=<?php echo $usr['id_kantor'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> 
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
  <div class="modal fade bd-example-modal-lg" id="tambahLokasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">TAMBAH LOKASI </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Lokasi :</label>
                <input type="text" class="form-control" id="nama_lokasi" name="nama_kantor" placeholder="Nama Lokasi">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Alamat :</label>
                <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat"></textarea>
              </div>  
              <div class="form-group">
                <label for="recipient-name" class="control-label">Latitude Longitude :</label>
                <input type="text" class="form-control" id="lat_long" name="lat_long" placeholder="lat_long">
              </div>   
              <div class="form-group">
                <label for="recipient-name" class="control-label">radius (m):</label>
                <input type="text" class="form-control" id="radius" name="radius" placeholder="radius">
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveTambahLokasi" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <!-- end modal for edit Absen -->

     <!-- Modal for Edit Absen -->
     <?php 
      $dataUsr = mysqli_query($koneksi,"select * from kantor"); 
      while($pro=mysqli_fetch_array($dataUsr)){ 
      ?>
  <div class="modal fade bd-example-modal-lg" id="editLokasi<?php echo $pro['id_kantor'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">EDIT LOKASI </h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="module/sudimin/aksi.php" method="post">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">              
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Kantor :</label>
                <input type="hidden" class="form-control" id="id_kantor" value="<?php echo $pro['id_kantor'];?>" name="id_kantor" placeholder="id_kantor">
                <input type="text" class="form-control" id="nama_kantor" value="<?php echo $pro['nama_kantor'];?>" name="nama_kantor" placeholder="Nama Kantor">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Alamat :</label>
                <input type="text" class="form-control" id="alamat" value="<?php echo $pro['alamat'];?>" name="alamat" placeholder="alamat">
              </div>         
              <div class="form-group">
                <label for="recipient-name" class="control-label">Latitude Longitude :</label>
                <input type="text" class="form-control" id="lat_long" value="<?php echo $pro['lat_long'];?>" name="lat_long" placeholder="Latitude, Longitude">
              </div>      
              <div class="form-group">
                <label for="recipient-name" class="control-label">Radius (m) :</label>
                <input type="text" class="form-control" id="radius" value="<?php echo $pro['radius'];?>" name="radius" placeholder="radius">
              </div>  
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveEditLokasi" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div> <?php } ?>
        <!-- end modal for edit Absen -->
      <?php } ?>
