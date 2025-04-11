 
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
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where tgl_datang = '$tgl_saiki'");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where status1 = '0'");	 	
  

?>

    <form action="" method="post">
      <div class="content-wrapper">
        <section class="content">
            <div class="row">
              
              <div class="row box box-solid">
                <br>
                <?php
                 if(isset($_POST['jabatan']) and $_POST['jabatan'] != "*"){
                  $jab  = ($_POST['jabatan']);
                  $jabatan = " Jabatan $jab";
                  } else if ($_POST['jabatan'] == '*') {
                    $jabatan = ""; 
                  } else {
                    $jabatan = ""; 
                  }

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
                                  
                  ?>
                <div class="form-group">
                <h3>DATA ABSENSI <?php echo $jabatan; ?><br>Bulan : <?php echo $month_en; ?><br> Tahun : <?php echo $tahun; ?></h3>
                </div>
                <br>
                  <div class="col-3">
                      <select class="form-select" aria-label="Default select example" name="jabatan">
                      <option value="*">Semua</option>
                      <?php
                      $jabat = mysqli_query($koneksi,"select distinct jabatan from user");  
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
                  <div class="col-3">
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
                  <div class="col-3">
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
                  
                  <!-- TAMPIL TABEL DATA -->
                
                  <div class="table-responsive" style="overflow-x: auto!important;">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th rowspan="2" width="40" class="text-center" style="vertical-align: middle;">No</th>
                        <th colspan="1" rowspan="2" style="vertical-align: middle;">Jabatan</th>
                        <th colspan="2" rowspan="2" style="vertical-align: middle;">Nama Pegawai</th>
                        <th class="text-center" colspan="<?php echo $jumlahhari; ?>"><?php echo $month_en; ?></th>
                        <th class="text-center" colspan="3">Keterangan</th>
                      </tr>
                      <tr>
                      <?php
                     function tanggalMerah($value) {
                      $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);
                      //check tanggal merah berdasarkan libur nasional
                      if(isset($array[$value]) && $array[$value]["holiday"]){
                        $saiki = ($array[$value]['summary']['0']);
                    
                      //check tanggal merah berdasarkan hari minggu
                      } elseif (date("D",strtotime($value))==="Sun"){
                        $saiki ="";
                    
                      //bukan tanggal merah
                      } else {
                        $saiki = "";
                      }
                      return $saiki;
                    }
                      

                      $sum = 0;
                      $libur = 0;
                      for ($d=1;$d<=$jumlahhari;$d++) { 
                        $tgl=date("$tahun/$bulan/$d");
                        $dino = date('D', strtotime($tgl));
                        $hari_ini = "$tahun/$bulan/$d";
                        $saiki = date("Y-m-d",strtotime($hari_ini));
                        $abang = tanggalMerah($saiki);
                        

                        if (!empty($abang) or $dino == "Sun"){
                          $warna = "color:white;";
                          $background = "background-color:red;";
                          $sum++;
                        } else {
                          $warna = "color:black;";
                          $background = "background-color:white;";
                          $libur++;
                        }
                       

                        ?>                      
                      <th width="50" class="text-center" style="<?php echo $warna; echo $background;?>"><?php echo $d;?></th>
                      <?php } ?>
                      <th width="50" class="text-center">A</th>
                      <th width="50" class="text-center">I</th>
                      <th width="50" class="text-center">S</th>
                      </tr>
                    </thead>     
                    <tbody>
                      <?php
                       if(isset($_POST['jabatan']) and $_POST['jabatan'] != "*"){
                        $jabatan  = ($_POST['jabatan']);
                        $jab = "where jabatan ='$jabatan'";
                        } else if ($_POST['jabatan'] == '*') {
                          $jab = ""; 
                        } else {
                          $jab = ""; 
                        }
                    $no=0;
                    $query= mysqli_query($koneksi,"SELECT * FROM user $jab order by nama_pegawai asc");	
                    while($row=mysqli_fetch_array($query)){                      
                      $no++;                      
                      ?>
                    <tr>
                      <td rowspan="2" class="text-center"><?php echo $no; ?></td>
                      <td rowspan="2" width="150"><?php echo $row['jabatan']; ?></td>
                      <td rowspan="2" width="150"><?php echo $row['nama_pegawai']; ?></td>
                      <td width="60">Masuk</td>
                      <?php
                      for ($d=1;$d<=$jumlahhari;$d++){                    
                        $hari_ini = "$tahun-$bulan-$d";
                         if(isset($_POST['bulan']) OR isset($_POST['tahun'])){
                            
                            $bulan = $_POST['bulan'];
                            $tahun  = $_POST['tahun'];
                            $filter ="day(tgl_datang)='$d' AND month(tgl_datang)='$bulan' AND year(tgl_datang)='$tahun'";
                            $filter_absen ="month(tgl_datang)='$bulan' AND year(tgl_datang)='$tahun'";
                            $filter_izin ="year(mulai_izin)='$tahun' AND MONTH(mulai_izin) ='$bulan'";
                            $filter_sakit ="year(mulai_cuti)='$tahun' AND MONTH(mulai_cuti) ='$bulan' AND jenis_cuti='3'";
                          } 
                          else{
                            
                            $filter ="day(tgl_datang)='$d' AND year(tgl_datang)='$tahun' AND MONTH(tgl_datang) ='$bulan'";
                            $filter_absen ="month(tgl_datang)='$bulan' AND year(tgl_datang)='$tahun'";
                            $filter_izin ="year(mulai_izin)='$tahun' AND MONTH(selesai_izin) ='$bulan'";
                            $filter_sakit ="year(mulai_cuti)='$tahun' AND MONTH(mulai_cuti) ='$bulan' AND jenis_cuti='3'";
                          }
                        //$query_absen= mysqli_query($koneksi,"SELECT * FROM absensi WHERE $filter AND id_peg='$row[id]' ORDER BY id_absen DESC");	
                          $query_absen= "SELECT * FROM absensi  ab join user us on ab.id_peg=us.id WHERE $filter AND id_peg='$row[id]'";	
                          $result_absen = $koneksi->query($query_absen);
                          $row_absen = $result_absen->fetch_assoc();

                          if($row_absen['jam_datang']== NULL){
                            $jam_masuk ='<b style="color:red;">x</b>';
                          }else{
                            $jam_masuk = $row_absen['jam_datang'];
                          } 
                          ?>                                                    
                         <td class="text-center"><p style="color:blue;"><?php echo $jam_masuk;?></p></td>
                         
                      <?php } // END FOR D
        
                    $jmlabsen="SELECT * FROM absensi WHERE $filter_absen AND id_peg='$row[id]'"; 
                    $queryabsen = mysqli_query($koneksi, $jmlabsen);
                    $jml_absen=mysqli_num_rows($queryabsen);
                    
                    $jmlizin="SELECT sum(jml_izin) as jml_izin FROM izin WHERE $filter_izin AND id_peg='$row[id]'";                    
                    $queryizin = mysqli_query($koneksi, $jmlizin);                    
                    $rowizin = $queryizin->fetch_assoc();
                    $jml_izin = $rowizin['jml_izin'];
                    if ($jml_izin == NULL){
                      $jml_izin = '0';
                    }

                    $jmlsakit="SELECT sum(jml_cuti) as jml_sakit FROM cuti WHERE $filter_sakit AND id_peg='$row[id]'";                    
                    $querysakit = mysqli_query($koneksi, $jmlsakit);
                    $rowsakit = $querysakit->fetch_assoc();
                    $jml_sakit = $rowsakit['jml_sakit'];
                    if ($jml_sakit == NULL){
                      $jml_sakit = '0';
                    }
                    ?>
                    <th width="50" rowspan="2" class="text-center"><?php echo $jml_absen; ?></th>
                    <th width="50" rowspan="2" class="text-center"><?php echo $jml_izin; ?></th>
                    <th width="50" rowspan="2" class="text-center"><?php echo $jml_sakit; ?></th>
                    </tr>
                    <tr>
                      <td width="60">Pulang</td>
                   <?php        
                  
                  for ($d=1;$d<=$jumlahhari;$d++) {
                    $hari_ini = "$tahun-$bulan-$d";
                    if(isset($_POST['bulan']) OR isset($_POST['tahun'])){
                       $bulan = $_POST['bulan'];
                       $tahun  = $_POST['tahun'];
                       $filter_pulang ="day(tgl_pulang)='$d' AND month(tgl_pulang)='$bulan' AND year(tgl_pulang)='$tahun'";
                      } 
                     else{
                      $filter_pulang ="day(tgl_pulang)='$d' AND year(tgl_pulang)='$tahun' AND MONTH(tgl_pulang) ='$bulan'";
                           
                     }
    
                    $query_pulang ="SELECT * FROM absensi ab join user us on ab.id_peg=us.id WHERE $filter_pulang AND id_peg='$row[id]'";
                    $result_pulang = $koneksi->query($query_pulang);
                    $row_pulang = $result_pulang->fetch_assoc();

                    if(empty($row_pulang['jam_pulang'])){
                      $jam_pulang ='<b style="color:red;">x</b>';
                    } else if($row_pulang['jam_pulang'] == "00:00:00"){
                      $jam_pulang = "Tidak Absen";
                    } else {
                      $jam_pulang = $row_pulang['jam_pulang'];
                    }
                    ?>                                                    
                   <td class="text-center"><p style="color:black;"><?php echo $jam_pulang;?></p></td>

                    <?php
                     } // END while D++ ROW PULANG
                    ?>
                  </tr>
                    <?php } ?>  <!-- END WHILE ROW -->
                    </tbody>                 
                  </table>
                  </div>




              </div> <!-- end of ROW BOX SOLID -->
            </div>
                 
          </div>
         </section>
      </div>
    </form>
      <?php } ?>
