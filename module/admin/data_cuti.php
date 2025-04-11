 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 

  
  if(isset($_POST['tahun'])){
    $tahun   = date ($_POST['tahun']);    
    $filtertahun = "and year(mulai_cuti) = '$tahun'";
  } 
  else{
    $tahun  = date ("Y");    
    $filtertahun = "";
  }
  
    $hari       = date("d");
    $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
    $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));    
    //============================================================= 
  $id_pegawai = $_GET['id'];
  $tgl_saiki = date('Y-m-d');
  $user = $_SESSION['username'];

  if(isset($_POST['jabatan']) and $_POST['jabatan'] != "*"){
    $jab  = ($_POST['jabatan']);
    $filteruser = "and jabatan = '$jab'";
    } else if ($_POST['jabatan'] == '*') {
      $filteruser = ""; 
    } else {
      $filteruser = ""; 
    }

  $datauser= mysqli_query($koneksi,"select * from user where jabatan !='admin' $filteruser $filtertahun order by nama_pegawai asc");	 	
  $datachartabsen= mysqli_query($koneksi,"select * from absensi");	 	
  $datacuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where status_cuti='Di Setujui' and jabatan !='admin' and jabatan !='sudimin' and jabatan !='Magang'  $filteruser $filtertahun order by mulai_cuti desc");	 	
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where id_peg = '$id_pegawai' and month(tgl_datang) = '$bulan' and year(tgl_datang)='$tahun'");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where status1 = '0'");	 	
  
          

?>

    <form action="" method="post">
      <div class="content-wrapper">
        <section class="content">
            <div class="row">
              
              <div class="row box box-solid">
                <br>
               
                <div class="form-group">
                <h3>DATA CUTI TAHUN <?php echo $tahun; ?></h3>
                </div>
                <br>
                <div class="col-4">
                      <select class="form-select" aria-label="Default select example" name="jabatan">
                      <option value="*">Semua</option>
                      <?php
                      $jabat = mysqli_query($koneksi,"select distinct jabatan from user where jabatan !='admin' and jabatan !='sudimin'");  
                      while($row=mysqli_fetch_array($jabat)){  ?>
                      <?php
                      if($jab ==$row['jabatan']){
                        echo'<option value="'.$row['jabatan'].'" selected>'.$row['jabatan'].'</option>';
                      }else{
                        echo'<option value="'.$row['jabatan'].'">'.$row['jabatan'].'</option>';}
                      ?>
                      <!-- <option value="<?php echo $row['jabatan']?>"><?php echo $row['jabatan']?></option> -->
                      <?php  } ?>                      
                      </select>
                  </div>
                  
                  <div class="col-4">
                    <div class="form-group">
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
                  </div>
                  <div class="col-3" align="right">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-md">TAMPILKAN</button>
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
                        <th class="text-center">Jabatan</th>                        
                        <th class="text-center">Jenis Cuti</th>                        
                        <th class="text-center">Mulai</th>
                        <th class="text-center">Selesai</th>                        
                        <th class="text-center">Jumlah</th>                        
                        <th class="text-center">Keterangan</th>
                      </tr>
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
                        $no=0;                     
                        while($cuti=mysqli_fetch_array($datacuti)){  
                      $id_cuti = $cuti['id_cuti'];
                      $no+=1;
                      $jenis_cuti = getJenis($cuti['jenis_cuti']); 
                  
                      
                      ?>
                      <tr>             
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php echo $cuti['nama_pegawai']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $cuti['jabatan']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $jenis_cuti; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $cuti['mulai_cuti']; ?>
                        </td>
                        <td class="text-center">
                        <?php echo $cuti['selesai_cuti']; ?>
                        </td>
                        <td class="text-center">
                        <?php echo $cuti['jml_cuti']; ?> Hari
                        </td>
                        <td class="text-center">
                        <?php echo $cuti['alasan_cuti']; ?>
                        </td>
                       
                      
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>              
            </div> <!-- end box solid -->
          </div>
          <!-- END ABSEN HARI INI -->
         
          <!-- MODAL DETAIL IMAGE DATANG -->
      <?php 
       $teko = mysqli_query($koneksi,"select * from izin");      
       while($tk=mysqli_fetch_array($teko)){        
      ?>
      <div id="myModalBukti<?php echo $tk['id_izin']?>" class="modal">
      <div class="modal-dialog modal-md"  style="width:480px;" align="center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h3 class="modal-title" id="exampleModalLabel">DETAIL BUKTI</h3></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">       
                <img style="width:480px; height:500px;" src="img/upload/bukti_ijin/<?php echo $tk['bukti_izin']?>" class="modal-content">
              </div>  <!-- end row -->      
            </div> <!-- End Modal Body -->
          </form>
          </div>
        </div>
      </div>    
      <?php } ?>    
        <!-- end modal for View Picture DATANG -->



              </div> <!-- end of ROW BOX SOLID -->
            </div>
                 
          </div>
         </section>
      </div>
    </form>
      <?php } ?>
