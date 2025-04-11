<style>

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}


/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}


</style>

<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 
   $tgl_saiki = date('Y-m-d');
  $user = $_SESSION['username'];
  $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
  $datachartabsen= mysqli_query($koneksi,"select * from absensi");	 	
  $datacuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where status_cuti = 'Belom ditinjau' order by mulai_cuti");	 	
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where tgl_datang = '$tgl_saiki' order by jam_datang asc");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where status1 = 'Belom di Proses!'");	 	
                     





?>
<style>
body  {
  background-image: url("img/assets/kantorbg1.jpg");
  background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
}
</style>
      <div class="content-wrapper">
            <section class="content">
            <div class="row">
                    <?php 
                    $saiki = date('Y-m-d');
                    $dataabs= mysqli_query($koneksi,"select * from absensi where tgl_datang='$saiki'");	 	
                    $jml_hdr=mysqli_num_rows($dataabs);
                    ?>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?php echo $jml_hdr;?></h3>
                          <p>Jumlah Hadir</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>
                          <a href="sudimin.php?module=absen_harian" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                          </a>                        
                      </div>
                    </div>
                    <?php 
                    $datact= mysqli_query($koneksi,"select * from cuti where mulai_cuti<='$saiki' and selesai_cuti >='$saiki'");	 	
                    $jml_cuti=mysqli_num_rows($datact);
                    ?>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3><?php echo $jml_cuti;?></h3>
                          <p>Cuti</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa fa-briefcase"></i>
                        </div>
                        <a href="sudimin.php?module=data_cuti" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <?php
                    $datatel= mysqli_query($koneksi,"select * from absensi where tgl_datang='$saiki' and status_datang !='Tepat Waktu'");	 	
                    $jml_tel=mysqli_num_rows($datatel);
                    ?>
                    <div class="col-lg-3 col-xs-6">
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo $jml_tel;?></h3>
                          <p>Telat</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-building"></i>
                        </div>
                        <a href="sudimin.php?module=rekap_absensi" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <?php 
                    $dataiz= mysqli_query($koneksi,"select * from izin where mulai_izin<='$saiki' and selesai_izin >='$saiki'");	 	
                    $jml_izin=mysqli_num_rows($dataiz);
                    ?>
                    <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3><?php echo $jml_izin;?></h3>
                        <p>Izin</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-retweet"></i>
                      </div>
                      <a href="sudimin.php?module=data_izin" class="small-box-footer">
                        More Info <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  </div>  <!-- END OF ROW CARDS -->

                  
                  <!-- MENU PERMOHONAN CUTI MASUK -->
                  <form action="module/admin/aksi.php" method="post">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><b>Permohonan Cuti</b></h3>
                        <div class="box-tools pull-right">
                          <a href="sudimin.php?module=data_cuti" class="btn btn-sm btn-primary btn-flat">Data Cuti</a>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table table-hover table-striped ">
                          <tbody>
                              <tr class="table table-success">
                                <th style="width: 10px" class="text-center">No.</th>
                                <th class="text-center" width="25%">Nama</th>
                                <th class="text-center" width="10%">Tanggal Cuti</th>
                                <th class="text-center" width="15%">Jenis Cuti</th>
                                <th class="text-center" width="10%">Jumlah</th>
                                <th class="text-right" width="30%">Alasan</th>
                                <th class="text-center" width="10%">Aksi</th>
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
                              $no+=1;       
                              $jenis_cuti = getJenis($cuti['jenis_cuti']); 
                              $idcuti = $cuti['id_cuti']; 
                                             
                              ?>
                              <input type="hidden" class="form-control" id="id" value="<?php echo $cuti['jenis_cuti']; ?>" name="id_cuti" placeholder="1">
                              <tr  class="">             
                                <td class="text-center label-danger"><?php echo $no; ?></td>
                                <td><?php echo $cuti['nama_pegawai']; ?></td>
                                <td class="text-center"><?php echo $cuti['mulai_cuti']; ?></td>
                                <td class="text-center"><?php echo $jenis_cuti; ?></td>
                                <td class="text-center"><label><?php echo $cuti['jml_cuti']; ?></label></td>
                                <td class="text-right"><?php echo $cuti['alasan_cuti']; ?></td>
                                <td class="text-center label">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                 <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                    Opsi
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                    <li><button type="submit" name="saveAccCuti" class="btn btn-sm btn-success" onClick="return confirm('Anda yakin ingin menyetujui cuti ini?')">Di Setujui</button><button type="submit" name="saveTolakCuti" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menolak pengajuan cuti ini?')">Di Tolak</button></li>
                                   
                                  </ul>
                                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailCuti<?php echo $idcuti; ?>"><div class="icon-wrapper">Detail</button>
                                  
                                </div>
                              </div>
                                </td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>
                      </div>              
                    </div> <!-- end box solid -->
                  </div>
                  </form>
                  <!-- END PERMOHONAN CUTI -->


                  
                  <!-- dashboard SUBMIT LAPORAN -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><b>Laporan Bulanan</b></h3>
                        <div class="box-tools pull-right">
                          <a href="sudimin.php?module=data_laporan" class="btn btn-sm btn-primary btn-flat">Data Laporan</a>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <table class="table table-hover table-striped ">
                          <tbody>
                              <tr class="table-success">
                                <th style="width: 10px" class="text-center">No.</th>
                                <th class="text-center" width="25%">Nama Pegawai</th>
                                <th class="text-center" width="25%">Bulan</th>
                                <th class="text-center" width="20%">Tahun</th>
                                <th class="text-center" width="15%">Jumlah Output</th>
                                <th class="text-center" width="10%">Aksi</th>
                              </tr>
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
                          
                              $no=0;
                                while($lapbul=mysqli_fetch_array($data_lapbul)){    
                              $no+=1;       
                              $bulan = getBulan($lapbul['bulan']);                
                              ?>
                              <tr>             
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $lapbul['nama_pegawai']; ?></td>
                                <td class="text-center"><?php echo $bulan; ?></td>
                                <td class="text-center"><?php echo $lapbul['tahun']; ?></td>
                                <td class="text-center"><label><?php echo $lapbul['jumlah_kegiatan']; ?></label></td>
                                <td class="text-center label">
                                <form action="module/admin/aksi.php" method="post">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                  <div class="btn-group" role="group">
                                  <input type="hidden" class="form-control" id="id" value="<?php echo $lapbul['id_lapbul']; ?>" name="id_lapbul" placeholder="1">
                                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                      PROSES
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <li>
                                      <button type="submit" name="saveAccLapbul" class="btn btn-sm btn-success" onClick="return confirm('Anda yakin ingin menyetujui Laporan ini?')">Di Setujui</button>
                                      <button type="submit" name="saveTolakLapbul" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menolak Laporan ini?')">Di Tolak</button>
                                    </li>
                                    </ul>
                               
                                  <a href="sudimin.php?module=detail_lap&id=<?php echo $lapbul['id_lapbul']; ?>"><button type="button"  class="btn btn-sm btn-primary"><div class="icon-wrapper">Detail</button></a>
                                    
                                  </div>
                                </div>
                                </form>
                                </td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>
                      </div>              
                    </div> <!-- end box solid -->
                  </div>
                  <!-- END LAPORAN MASUK -->


                  <!-- CHART ABSENSI -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Statistik Absensi</h3>
                    </div>
                      <div class="box-body">
                        <div class="chart">
                          <canvas id="areaChart" style="height:300px"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END OF CHART -->

          <!-- ABSEN HARI INI -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Absensi Hari Ini</h3>
                <div class="box-tools pull-right">
                  <a href="sudimin.php?module=rekap_absensi" class="btn btn-primary btn-flat">Kehadiran</a>
                </div>
              </div>
              <div class="box-body no-padding">
                <table class="table table-hover table-striped ">
                  <tbody>
                      <tr class="table-dark">
                        <th style="width: 10px" class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jam Masuk</th>                        
                        <th class="text-center">Foto Hadir</th>
                        <th class="text-center">Jam Pulang</th>                        
                        <th class="text-center">Foto Pulang</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-right">Edit</th>
                      </tr>
                      <?php           
                      $linkmap = '<iframe src="https://www.google.com/maps/@-7.7445764,110.3666281,15z?entry=ttu" width="150" height="117" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';           
                      $no=0;

                      

                        while($hdr=mysqli_fetch_array($hadir)){  
                            
                      $no+=1;
                      if($hdr['status_datang'] != "Tepat Waktu"){
                        $klasd="label-danger";
                       } else {
                        $klasd="label-success";
                       }
                       if($hdr['jam_pulang'] == "00:00:00"){
                        $klasp="label-warning";
                        $statusp="(Belom Absen)";
                       } else if (!empty($hdr['foto_pulang']) and $hdr['status_pulang'] != "Tepat Waktu"){
                        $klasp="label-danger";
                        $statusp = $hdr['status_pulang'];
                       } else {
                        $klasp="label-success";                        
                        $statusp = $hdr['status_pulang'];
                       }                     
                      ?>
                      <tr>             
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php echo $hdr['nama_pegawai']; ?>
                          <p style="font-size:13px;">(<?php echo $hdr['jam_datang_shift'];?> - <?php echo $hdr['jam_pulang_shift']; ?>)<br>
                          <b style="font-size:13px;">(<?php echo $hdr['nama_shift'];?>)</b></p>
                        </td>
                        <td class="text-center label <?php echo $klasd; ?>">
                          <?php echo $hdr['jam_datang']; ?>
                          <p style="font-size:13px;">(<?php echo $hdr['status_datang'];?>)</p>
                        </td>
                        <td class="text-center">
                        <a data-toggle="modal" data-target="#myModalImage<?php echo $hdr['id_absen']; ?>">
                        <img src="img/upload/absensi/<?php echo $hdr['foto_datang']; ?>" id="myImg" alt="snow" width="70px" height="65px" alt="User Image">  
                      </a>                        
                        </td>                      
                        <td class="text-center label <?php echo $klasp; ?>">
                          <?php echo $hdr['jam_pulang']; ?>
                          <p style="font-size:13px;"><?php echo $statusp;?></p>
                        </td>
                        
                        <td class="text-center">
                          <?php if (empty($hdr['foto_pulang']) or $hdr['jam_pulang'] == "00:00:00"){?>
                        <a href="">
                        <img src="img/assets/icon_page/profilnull.png" width="70px" height="65px" alt="User Image">  
                        </a> 
                          <?php } else {?>
                            <a data-toggle="modal" data-target="#myModalImagePulang<?php echo $hdr['id_absen']; ?>">
                        <img src="img/upload/absensi/<?php echo $hdr['foto_pulang']; ?>" width="70px" height="65px" alt="User Image">  
                        </a>    
                          <?php } ?>                   
                        </td>
                        <td class="text-center">
                        <a class="dropdown-item" href="https://www.google.com/maps/@<?php echo $hdr['latlong_datang']; ?>,20.5z?entry=ttu">
                        <div class="icon-wrapper">
                        <img src="img/assets/icon_page/icon_maps.png" width="20px" height="20px">
                        <b style="font-size:15px;">DATANG</b>
                        </div>
                        </a>
                        <?php if (empty($hdr['latlong_pulang']) or $hdr['jam_pulang'] == "00:00:00"){?>
                        <a class="dropdown-item" href="">
                        <div class="icon-wrapper">                        
                        <img src="img/assets/icon_page/icon_maps.png" width="20px" height="20px">
                        <b style="font-size:15px;">PULANG</b>                        
                        </div>
                        </a>
                        <?php } else {?>
                        <a class="dropdown-item" href="https://www.google.com/maps/@<?php echo $hdr['latlong_pulang']; ?>,20.5z?entry=ttu">
                        <div class="icon-wrapper">                        
                        <img src="img/assets/icon_page/icon_maps.png" width="20px" height="20px">
                        <b style="font-size:15px;">PULANG</b>                        
                        </div>
                        </a>
                        <?php } ?>
                        </td>
                        <td>
                        <center>
                          <a class="dropdown-item" data-toggle="modal" data-target="#editAbsen<?php echo $hdr['id_absen'];?>" > <div class="icon-wrapper">
                          <img src="img/assets/icon_page/icon_edit.png" width="35px" height="35px">
                          </div>
                          </a>
                        </center>
                        </td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>              
            </div> <!-- end box solid -->
          </div>
          <!-- END ABSEN HARI INI -->
         

      <?php 
      
        

      $bln_saiki = date('m');
      $thn_saiki = date('Y');
       $datact= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id");	 	
       while($pro=mysqli_fetch_array($datact)){ 
        $jenis = getJenis($pro['jenis_cuti']);

      $datacutitahun= mysqli_query($koneksi,"select * from cuti ct where ct.id_peg='".$pro['id_peg']."' and jenis_cuti ='1' and status_cuti='Di Setujui' and year(mulai_cuti)='$thn_saiki'");
      $jumlah_tahun = 0;
      while ($row = $datacutitahun->fetch_assoc()){
      $jumlah_tahun += $row['jml_cuti'];      
      } 
      $datacutipenting= mysqli_query($koneksi,"select * from cuti ct where ct.id_peg='".$pro['id_peg']."' and jenis_cuti ='2' and status_cuti='Di Setujui' and year(mulai_cuti)='$thn_saiki'");
      $jumlah_penting = 0;
      while ($row = $datacutipenting->fetch_assoc()){
      $jumlah_penting += $row['jml_cuti'];      
      } 
      $datacutisakit= mysqli_query($koneksi,"select * from cuti ct where ct.id_peg='".$pro['id_peg']."' and jenis_cuti ='3' and status_cuti='Di Setujui' and year(mulai_cuti)='$thn_saiki'");
      $jumlah_sakit = 0;
      while ($row = $datacutisakit->fetch_assoc()){
      $jumlah_sakit += $row['jml_cuti'];      
      }  
      $datacutilahir= mysqli_query($koneksi,"select * from cuti ct where ct.id_peg='".$pro['id_peg']."' and jenis_cuti ='4' and status_cuti='Di Setujui' and year(mulai_cuti)='$thn_saiki'");
      $jumlah_lahir = 0;
      while ($row = $datacutilahir->fetch_assoc()){
      $jumlah_lahir += $row['jml_cuti'];      
      }  
      $sisatahunan = 12 - $jumlah_tahun; 
        ?>
        <!-- MODAL DETAIL CUTI -->
        <div class="modal fade bd-example-modal-lg" id="detailCuti<?php echo $pro['id_cuti'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">DETAIL CUTI  <b>#<?php echo $pro['nama_pegawai'];?></b></h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">       
            <div class="col-md-12">
              <div class="form-group">
                <table class="table table-striped striped">
                  <tr>
                    <td>Nama Pegawai</td>
                    <td>:</td>
                    <td><?php echo $pro['nama_pegawai'];?></td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo $pro['jabatan'];?></td>
                  </tr>
                  <tr>
                    <td>Jenis Cuti</td>
                    <td>:</td>
                    <td><?php echo $jenis;?></td>
                  </tr>
                  <tr>
                    <td>Jumlah Cuti</td>
                    <td>:</td>
                    <td><?php echo $pro['jml_cuti'];?> Hari</td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php echo $pro['alasan_cuti'];?></td>
                  </tr>
                  <tr>
                    <td>Mulai Cuti</td>
                    <td>:</td>
                    <td><?php echo $pro['mulai_cuti'];?></td>
                  </tr>
                  <tr>
                    <td>Sampai</td>
                    <td>:</td>
                    <td><?php echo $pro['selesai_cuti'];?></td>
                  </tr>
                  <hr>
                  <tr>
                    <td>Jumlah Cuti Tahunan</td>
                    <td>:</td>
                    <td><?php echo "<b>$jumlah_tahun Hari</b>";  echo "(  sisa $sisatahunan Hari )"; ?></td>
                  </tr>
                  <tr>
                    <td>Jumlah Cuti Alasan Penting</td>
                    <td>:</td>
                    <td><?php echo "$jumlah_penting Hari";?></td>
                  </tr>
                  <tr>
                    <td>Jumlah Cuti Sakit</td>
                    <td>:</td>
                    <td><?php echo "$jumlah_sakit Hari";?></td>
                  </tr>
                  <tr>
                    <td>Jumlah Cuti Melahirkan</td>
                    <td>:</td>
                    <td><?php echo "$jumlah_lahir Hari";?></td>
                  </tr>
                 
                </table>
              </div>             
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div> <?php } ?>
        <!-- end modal for Detail Cuti -->
        <?php 
      $dataAbsen = mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id"); 
      while($pro=mysqli_fetch_array($dataAbsen)){ 
      ?>
        <!-- Modal for Edit Absen -->
  <div class="modal fade bd-example-modal-lg" id="editAbsen<?php echo $pro['id_absen'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h3 class="modal-title" id="exampleModalLabel">EDIT ABSENSI </h3></center>
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
                <input type="hidden" class="form-control" id="id_absen" value="<?php echo $pro['id_absen'];?>" name="id_absen" placeholder="1">
                <input type="hidden" class="form-control" id="id_shift" value="<?php echo $pro['id_shift'];?>" name="id_shift" placeholder="1">
                <input type="text" class="form-control" id="nama_pegawai" value="<?php echo $pro['nama_pegawai'];?>" name="nama_pegawai" placeholder="1">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tgl Datang :</label>
                <input type="text" class="datepicker" id="tanggal" value="<?php echo $pro['tgl_datang'];?>" name="tgl_datang" placeholder="Jam Datang"><div class="bi bi-calendar-date"></div>
                <script type="text/javascript">
                $('.datepicker').datepicker({
                 //merubah format tanggal datepicker ke dd-mm-yyyy
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                </script>
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Datang :</label>
                <input type="text" class="form-control" id="datang" value="<?php echo $pro['jam_datang'];?>" name="jam_datang" placeholder="Jam Datang">
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tgl Pulang :</label>
                <input type="text" class="datepicker" id="tanggal" value="<?php echo $pro['tgl_pulang'];?>" name="tgl_pulang" placeholder="Jam Pulang"><div class="bi bi-calendar-date"></div>
                <script type="text/javascript">
                $('.datepicker').datepicker({
                 //merubah format tanggal datepicker ke dd-mm-yyyy
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                </script>
              </div> 
              <div class="form-group">
                <label for="recipient-name" class="control-label">Pulang :</label>
                <input type="text" class="form-control" id="pulang" value="<?php echo $pro['jam_pulang'];?>" name="jam_pulang" placeholder="Jam Pulang">
              </div> 
            </div> <!-- end col-md6 -->        
          </div>  <!-- end row -->      
        </div> <!-- End Modal Body -->
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveEditAbsen" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
  </div>
</div> <?php } ?>
        <!-- end modal for edit Absen -->

              <!-- MODAL DETAIL IMAGE DATANG -->
      <?php 
       $teko = mysqli_query($koneksi,"select * from absensi");      
       while($tk=mysqli_fetch_array($teko)){        
      ?>
      <div id="myModalImage<?php echo $tk['id_absen']?>" class="modal">
      <div class="modal-dialog modal-md"  style="width:480px;" align="center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h3 class="modal-title" id="exampleModalLabel">DETAIL FOTO</h3></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">       
                <img style="width:480px; height:500px;" src="img/upload/absensi/<?php echo $tk['foto_datang']?>" class="modal-content">
              </div>  <!-- end row -->      
            </div> <!-- End Modal Body -->
          </form>
          </div>
        </div>
      </div>    
      <?php } ?>    
        <!-- end modal for View Picture DATANG -->

            <!-- MODAL DETAIL IMAGE PULANG -->
      <?php 
       $teko = mysqli_query($koneksi,"select * from absensi");      
       while($tk=mysqli_fetch_array($teko)){        
      ?>
      <div id="myModalImagePulang<?php echo $tk['id_absen']?>" class="modal">
      <div class="modal-dialog modal-md"  style="width:480px;" align="center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h3 class="modal-title" id="exampleModalLabel">DETAIL FOTO</h3></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">       
                <img style="width:480px; height:500px;" src="img/upload/absensi/<?php echo $tk['foto_pulang']?>" class="modal-content">
              </div>  <!-- end row -->      
            </div> <!-- End Modal Body -->
          </form>
          </div>
        </div>
      </div>    
      <?php } ?>    
        <!-- end modal for View Picture PULANG -->

            </section>
      </div>


	
<?php
    $date = date("d-m-Y",strtotime("-6 days"));
    $D = substr($date,0,2);
    $M = substr($date,3,2)-1;
    $Y = substr($date,6,4);
    $tgl_skrg = date("Y-m-d");
    $seminggu = strtotime("-1 week +1 day",strtotime($tgl_skrg));
    $hasilnya = date('Y-m-d', $seminggu);
    //visitor
    for ($i=0; $i<=6; $i++){
      $tgl_pengujung   = strtotime("+$i day",strtotime($hasilnya));
      $hasil_pengujung = date("Y-m-d", $tgl_pengujung);
      $tanggal_visitor []= tgl_ind($hasil_pengujung);
      $query_absensi ="SELECT tgl_datang FROM absensi WHERE tgl_datang='$hasil_pengujung'";
      $result_absensi = $koneksi->query($query_absensi);
      $absensi [] = $result_absensi->num_rows;

    }
 $tanggal_visitor = implode('","',$tanggal_visitor);?>

 <script type="text/javascript">
    var lineChartData = {
      labels :["<?php echo $tanggal_visitor;?>"],
      datasets : [
        {
          label: "Statistik Absensi",
          fillColor : "rgba(29,75,251,0.7)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data :<?php echo json_encode($absensi);?>

        }
      ]

    }

  window.onload = function(){
    var ctx = document.getElementById("areaChart").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true
    });
  }
 
</script>

	  <?php } ?>

    