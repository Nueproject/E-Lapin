
<body style="border: 0.1pt solid #ccc">
<?php
include "../../lib/config.php";
include "../../lib/koneksi.php";
include "../../lib/fungsi_date.php";





  $tgl_saiki = date('Y-m-d');
  $user = $_SESSION['username'];
  $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
  $datachartabsen= mysqli_query($koneksi,"select * from absensi");	 	
  $datacuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where status_cuti = 'Belom ditinjau' order by mulai_cuti");	 	
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where tgl_datang = '$tgl_saiki'");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where status1 = '0'");	 	
  
  $jabatan     = strip_tags($_GET['jabatan']);
  if($jabatan==''){
    $filter_pegawai ='';
  }else{
    $filter_pegawai ="where jabatan='$jabatan'";
  }  


?>
    
    <form action="" method="post">
      <div class="content-wrapper">
        <section class="content">
            <div class="row">
              
              <div class="row box box-solid">
                <br>
                <?php
                 if(isset($_GET['jabatan']) and $_GET['jabatan'] != "*" or $_GET['jabatan'] != ''){
                  $jab  = ($_GET['jabatan']);
                  $jabatan = "";
                  } else if ($_GET['jabatan'] == '*') {
                    $jabatan = ""; 
                  } else if ($_GET['jabatan'] == '') {
                    $jabatan = ""; 
                  }else {
                    $jabatan = ""; 
                  }

                  if(isset($_GET['bulan']) OR isset($_GET['tahun'])){
                      $bulan   = date ($_GET['bulan']);
                      $month_en = bulan_indo2((int)$bulan);
                      $month_caps = strtoupper($month_en);

                  } 
                  else{
                      $bulan  = date ("m");
                  }

                  if(isset($_GET['tahun'])){
                    $tahun   = date ($_GET['tahun']);
                  } 
                  else{
                    $tahun  = date ("Y");
                  }
                  
                    $hari       = date("d");
                    $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
                    $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));    
                                  


                      header("Pragma: public");
                      header('Content-Type: application/xls');
                      header('Content-Disposition: attachment; filename=DATA ABSENSI PPNPN $jab $month_caps $tahun.xls');
                      
                      
                     // header('Content-Type: application/vnd.ms-excel');
                     // header("Content-Disposition: attachment; filename=DATA ABSENSI PPNPN $jab $month_caps $tahun.xls");
                      header('Cache-Control: max-age=0');
                  ?>
                <div class="form-group">
                <h3>DATA ABSENSI <?php echo $jabatan; ?><br>Bulan : <?php echo $month_en; ?><br> Tahun : <?php echo $tahun; ?></h3>
                </div>
                <br>
                  
                  
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
                       if(isset($_GET['jabatan']) and $_GET['jabatan'] != "*" or $_GET['jabatan'] != ''){
                        $jabatan  = ($_GET['jabatan']);
                        $jab = "where jabatan ='$jabatan'";
                        } else if ($_GET['jabatan'] == '*') {
                          $jab = "where jabatan !='admin' and jabatan !='sudimin'"; 
                        }  else {
                          $jab = "where jabatan !='admin' and jabatan !='sudimin'"; 
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
                      <td width="70">Masuk</td>
                      <?php
                      for ($d=1;$d<=$jumlahhari;$d++){                    
                        $hari_ini = "$tahun-$bulan-$d";
                         if(isset($_GET['bulan']) OR isset($_GET['tahun'])){
                            
                            $bulan = $_GET['bulan'];
                            $tahun  = $_GET['tahun'];
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
                      <td width="80">Pulang</td>
                   <?php        
                  
                  for ($d=1;$d<=$jumlahhari;$d++) {
                    $hari_ini = "$tahun-$bulan-$d";
                    if(isset($_GET['bulan']) OR isset($_GET['tahun'])){
                       $bulan = $_GET['bulan'];
                       $tahun  = $_GET['tahun'];
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
