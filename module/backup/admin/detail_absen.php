 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 

  if(isset($_POST['bulan']) OR isset($_POST['tahun'])){
      $bulan   = date ($_POST['bulan']);
      $month_en = bulan_indo2((int)$bulan);
  } 
  else{
      $bulan  = date ("m");
  }
  if(isset($_POST['tahun'])){
    $tahun   = date ($_POST['tahun']);
  } 
  else{
    $tahun  = date ("Y");
  }
  
    $hari       = date("d");
    $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
    $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));    
    //============================================================= 
  $id_pegawai = $_GET['id'];
  $tgl_saiki = date('Y-m-d');
  $user = $_SESSION['username'];
  $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
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
               
                <div class="form-group">
                <h3>DATA ABSENSI <?php echo $jabatan; ?><br>Bulan : <?php echo $month_en; ?><br> Tahun : <?php echo $tahun; ?></h3>
                </div>
                <br>
                
                  <div class="col-4">
                        <select class="form-select" aria-label="Default select example" name="bulan">
                      <?php
                      //$bulan = date('m');
                        if($bulan ==1){echo'<option value="01" selected>Januari</option>';}else{echo'<option value="01">Januari</option>';}
                        if($bulan ==2){echo'<option value="02" selected>Februari</option>';}else{echo'<option value="02">Februari</option>';}
                        if($bulan ==3){echo'<option value="03" selected>Maret</option>';}else{echo'<option value="03">Maret</option>';}
                        if($bulan ==4){echo'<option value="04" selected>April</option>';}else{echo'<option value="04">April</option>';}
                        if($bulan ==5){echo'<option value="05" selected>Mei</option>';}else{echo'<option value="05">Mei</option>';}
                        if($bulan ==6){echo'<option value="06" selected>Juni</option>';}else{echo'<option value="06">Juni</option>';}
                        if($bulan ==7){echo'<option value="07" selected>Juli</option>';}else{echo'<option value="07">Juli</option>';}
                        if($bulan ==8){echo'<option value="08" selected>Agustus</option>';}else{echo'<option value="08">Agustus</option>';}
                        if($bulan ==9){echo'<option value="09" selected>September</option>';}else{echo'<option value="09">September</option>';}
                        if($bulan ==10){echo'<option value="10" selected>Oktober</option>';}else{echo'<option value="10">Oktober</option>';}
                        if($bulan ==11){echo'<option value="11" selected>November</option>';}else{echo'<option value="11">November</option>';}
                        if($bulan ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
                      ?>
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
                  <div class="col-4" align="right">
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
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jam Masuk</th>                        
                        <th class="text-center">Foto Hadir</th>
                        <th class="text-center">Jam Pulang</th>                        
                        <th class="text-center">Foto Pulang</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-right">Keterangan</th>
                      </tr>
                      <?php           
                      $linkmap = '<iframe src="https://www.google.com/maps/@-7.7445764,110.3666281,15z?entry=ttu" width="150" height="117" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';           
                      $no=0;
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
      
                    function  getHari($hari){
                      switch  ($hari){
                          case 'Sun':
                            return  "Minggu";
                          break; 
                          case 'Mon':			
                            return  "Senin";
                          break; 
                          case 'Tue':
                            return  "Selasa";
                          break;
                          case 'Wed':
                            return  "Rabu";
                          break;   
                          case 'Thu':
                            return  "Kamis";
                          break;   
                          case 'Fri':
                            return  "Jumat";
                          break;   
                          case 'Sat':
                            return "Sabtu";
                          break;      
                          default:
                            return "Tidak di ketahui";		
                          break;
                      }
                    }

                      

                        while($hdr=mysqli_fetch_array($hadir)){  
                    $teko = $hdr['tgl_datang'];
                    $bul_absen = date("m",strtotime($teko));
                    $tgle = date("d",strtotime($teko));                    
                    $hari = date("D",strtotime($teko));                    
                    $sasi = getBulan($bul_absen);
                    $dino = getHari($hari);
                          

                      $no+=1;
                      if($hdr['status_datang'] != "Tepat Waktu"){
                        $klasd="label-danger";
                       } else {
                        $klasd="label-success";
                       }
                       if(empty($hdr['status_pulang']) and $hdr['jam_pulang'] == "00:00:00"){
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
                        <td class="text-center"><?php echo "$dino, $tgle $sasi $tahun"; ?></td>
                        <td>
                          <?php echo $hdr['nama_pegawai']; ?>
                          <p style="font-size:13px;">(<?php echo $hdr['jam_datang_shift'];?> - <?php echo $hdr['jam_pulang_shift']; ?>)</p>
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
                        <td><?php echo $hdr['keterangan']; ?></td>
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

      <?php } ?>
