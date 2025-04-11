 
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
              <!-- ABSEN HARI INI -->
              <?php
              $id_lapbul =$_GET['id'];
              $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where id_lapbul = '$id_lapbul'");	 	
              while($lapbul=mysqli_fetch_array($data_lapbul)){  
              $id_lap = $lapbul['id_lapbul'];
              $id_peg =$lapbul['id_peg'];
              $bulan_lap=$lapbul['bulan'];
              $tahun_lap=$lapbul['tahun'];
              $nama_peg=$lapbul['nama_pegawai'];
              
              }
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
              $bulan = getBulan($bulan_lap);?>           
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Detail Laporan <b><?php echo "<br> Nama : $nama_peg"; echo "<br> Bulan : $bulan <br> Tahun : $tahun_lap"; ?></b> </h3>
                              <div class="box-tools pull-right">
                                
                                <form action="module/admin/aksi.php" method="post">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                  <div class="btn-group" role="group">
                                  <input type="hidden" class="form-control" id="id" value="<?php echo $id_lap; ?>" name="id_lapbul" placeholder="1">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                      PROSES
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <li>
                                      <button type="submit" name="saveAccLapbul" class="btn btn-sm btn-success" onClick="return confirm('Anda yakin ingin menyetujui Laporan ini?')">Di Setujui</button>
                                      <button type="submit" name="saveTolakLapbul" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menolak Laporan ini?')">Di Tolak</button>
                                    </li>
                                    </ul>
                                  </div>
                                </div>
                                </form>

                              </div>
                            </div>
                            <div class="box-body no-padding">
                              <table class="table table-hover table-striped ">
                                <tbody>
                                    <tr class="table-dark">
                                      <th style="width: 10px" class="text-center">No</th>
                                      <th class="text-center">Tanggal</th>
                                      <th class="text-center">Uraian</th>                        
                                      <th class="text-center">Output</th>
                                      <th class="text-center">Satuan</th> 
                                    </tr>
                                    <?php           
                                  $no=0; 
                                  $data_lap = mysqli_query($koneksi,"select * from data_laporan dl join user u on dl.id_peg = u.id where id_peg = '$id_peg' and bulan ='$bulan_lap' and tahun ='$tahun_lap' order by tgl_lap asc");  
                                      while($dl=mysqli_fetch_array($data_lap)){  
                                        $tgl =  $dl['tgl_lap'];
                                        $tgl_indo = date('d F Y', strtotime($tgl));
                                        $dino = date('D', strtotime($tgl));
                                        $din = getHari($dino);                                        
                                        $no+=1; 
                                  ?>
                                    <tr>             
                                      <td class="text-center"><?php echo $no; ?></td>
                                      <td>
                                        <?php echo $din; echo ", $tgl_indo"; ?>
                                      </td>
                                      <td class="text-left">
                                        <?php echo $dl['uraian']; ?>
                                      </td>                                          
                                      <td class="text-center">
                                        <?php echo $dl['output']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $dl['satuan']; ?>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                              </table>
                            </div>              
                          </div> <!-- end box solid -->
                        </div>
                        <!-- END ABSEN HARI INI -->
                </section>
              </div>    
            <?php } ?>
