 
<?php
include "lib/config.php";
include "lib/koneksi.php";
include "lib/fungsi_date.php";

// session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=$admin_url><b>LOGIN</b></a></center>";
} else { 

  if(isset($_POST['bulan'])){
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

if(isset($_POST['jabatan']) and $_POST['jabatan'] != "*"){
  $jab  = ($_POST['jabatan']);
  $filteruser = "and jabatan = '$jab'";
  } else if ($_POST['jabatan'] == '*') {
    $filteruser = ""; 
  } else {
    $filteruser = ""; 
  }


  $datauser= mysqli_query($koneksi,"select * from user where jabatan !='admin' and jabatan !='sudimin' $filteruser $filtertahun order by nama_pegawai asc");	 	
  $datachartabsen= mysqli_query($koneksi,"select * from absensi");	 	
  $datacuti= mysqli_query($koneksi,"select * from cuti ct join user us on ct.id_peg = us.id where jabatan !='admin' $filteruser $filtertahun order by mulai_cuti desc");	 	
  $hadir= mysqli_query($koneksi,"select * from absensi ab join user us on ab.id_peg = us.id join shift_kerja sk on ab.id_shift = sk.id_shift where id_peg = '$id_pegawai' and month(tgl_datang) = '$bulan' and year(tgl_datang)='$tahun'");	 	
  $data_lapbul= mysqli_query($koneksi,"select * from lap_bulanan lb join user us on lb.id_peg = us.id where jabatan !='admin' and jabatan !='sudimin' and bulan = '$bulan' and tahun ='$tahun' $filteruser order by nama_pegawai asc");	 	
  $data_nonlb= mysqli_query($koneksi,"select * from user where jabatan !='admin' and jabatan !='sudimin' and id NOT IN (SELECT id_peg FROM lap_bulanan where bulan='$bulan' and tahun='$tahun') $filteruser order by nama_pegawai asc");	
          

?>

    <form action="" method="post">
      <div class="content-wrapper">
        <section class="content">
            <div class="row">
              
              <div class="row box box-solid">
                <br>
               
                <div class="form-group">
                <h3>DATA LAPORAN BULANAN</h3>
                </div>
                <br>
                <div class="col-3">
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
                  
                
                  
                        <!-- dashboard SUBMIT LAPORAN -->
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><b>Laporan Bulanan  <?php echo "$month_en "; echo $tahun; ?></b></h3>
                      </div>
                       <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="nav-link active">
                          <a class="dropdown-item" href="#SudahSubmit" aria-controls="home" role="tab" data-toggle="tab">
                            SUDAH SUBMIT
                          </a>
                        </li>
                        <li role="presentation" class="nav-link"> 
                          <a class="dropdown-item" href="#po" aria-controls="profile" role="tab" data-toggle="tab">
                            BELUM SUBMIT
                          </a>
                        </li>
                      </ul>

                     
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="SudahSubmit">
                          <?php include "module/admin/lap_submit.php"; ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="po">
                          <?php include "module/admin/lap_nonsubmit.php";  ?>
                        </div>            
                      </div>
                    </div>
                  </div>
             
                    </div> <!-- end box solid -->
                  </div>
                  <!-- END LAPORAN MASUK -->


         
          



              </div> <!-- end of ROW BOX SOLID -->
            </div>
                 
          </div>
         </section>
      </div>
    </form>
      <?php } ?>
