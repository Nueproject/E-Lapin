<?php
    date_default_timezone_set('Asia/Jakarta');
    session_start();
    include "../../lib/config.php";
    include "../../lib/koneksi.php";

    if($_POST['lokasi']==0){ //validasi SELECT
      echo "<script>
        alert('Lokasi Kantor belum dipilih!');
        window.location.href='../../absensi.php?module=absen';
        </script>";
    } else if ($_POST['shift']==0){
      echo "<script>
      alert('Shift Kerja belom dipilih!');
      window.location.href='../../absensi.php?module=absen';
      </script>";
    } 

		function distance($lat1, $lon1, $lat2, $lon2, $unit) { 
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);
		   
			if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
          return $miles;
        }
		  }
      $id_absen = $_POST['id_absen'];
      $lat_pegawai = $_POST['latitude_pegawai'];
      $long_pegawai = $_POST['longitude_pegawai'];
      $img = $_POST['image'];
      
  
      if (empty($lat_pegawai)){
        echo "<script>
        alert('GPS Anda Tidak Terdeteksi');
        window.location.href='../../absensi.php?module=home';
        </script>";
      } else {

        $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
        while($user=mysqli_fetch_array($datauser)){        
          $user_id= $user['id'];
          $user_name= $user['username'];
          $nama_pegawai= $user['nama_pegawai']; 	
        }
        $id_kantor = $_POST['lokasi'];
        $id_shift = $_POST['shift'];
        $datakantor= mysqli_query($koneksi,"select * from kantor where id_kantor='$id_kantor'");	 	
        while($kantor=mysqli_fetch_array($datakantor)){        
          $lat_long_kantor= $kantor['lat_long'];
          $radius= $kantor['radius'];
          $r=$radius/1000;	
        }

        $shiftkerja= mysqli_query($koneksi,"select * from shift_kerja where id_shift='$id_shift'");	 	
        while($shift=mysqli_fetch_array($shiftkerja)){        
          $jam_shiftmasuk= $shift['jam_datang_shift'];
          $jam_shiftpulang= $shift['jam_pulang_shift'];
        }
        $explode=explode(",",$lat_long_kantor);  
        $lat_kantor = $explode[0]; //untuk tahun
        $long_kantor = $explode[1]; //untuk bulan
        //lokasi Kantor
        $tanggal_datang="";
        $tanggal_pulang= date('Y-m-d');
        $jam_datang="";
        $jam_pulang=  date('H:i:s');
        $foto_datang= "";
        $foto_pulang= "";
        $status_pulang= "";
        $latlong_datang= "";
        $latlong_pulang= "$lat_pegawai,$long_pegawai";
        $jumlah_jam_kerja= "";

        $hasil = distance($lat_kantor, $long_kantor, $lat_pegawai, $long_pegawai, "K");		 

        $dataAbsen= mysqli_query($koneksi,"select * from absensi where id_absen='$id_absen'");	 	
        while($absen=mysqli_fetch_array($dataAbsen)){        
          $jam_absenkerja= $absen['jam_datang'];
          $jam_absenpulang= $absen['jam_pulang'];
        }
        //ALGORITMA HITUNG JAM KERJA
        $dat1= strtotime($jam_absenkerja);
        $pulang1= strtotime($jam_pulang);
        $selisihjam = $pulang1-$dat1;  
        $menitjam = 60*($selisihjam / (60 * 60));
        $jumlah_jamkerja = number_format($menitjam,);    
        $totaljam=$jumlah_jamkerja/60; 
      
        //ALGORITMA HITUNG TELAT
        $jam24=date('24:00:00');
        $tambahjam = strtotime($jam24);
        

        $pulang2= strtotime($jam_shiftpulang);        
        $dat2= strtotime($jam_pulang);

        // if($id_shift==2){        
        // $pulang2 = strtotime($jam_shiftpulang, time() + (60 * 60 * 24));
        // }     

        $selisihtelat = $pulang2-$dat2;  
        $menittelat = 60*($selisihtelat/ (60 * 60));
        $pulangcepat = number_format($menittelat,0);
        $jam = $pulangcepat/60;
        if ($menittelat>0){
          $status_pulang = "Pulang lebih cepat $pulangcepat menit";
        } else {
          $status_pulang = "Tepat Waktu";
        }
       
   
    if($hasil>$r)
      { 
        echo "<script>
        alert('GPS Anda terdeteksi diluar Zona Kerja!');
        window.location.href='../../absensi.php?module=home';
        </script>";
        
      }
      else
        {		
          $folderPath = "../../img/upload/absensi/";   
          $saiki = date('dmYHis');
          $image_parts = explode(";base64,", $img);
          $image_type_aux = explode("image/", $image_parts[0]);
          $image_type = $image_type_aux[1];  
          $image_base64 = base64_decode($image_parts[1]);
          $fileName = $user_name."_pulang".$saiki.'.png';
          $file = $folderPath . $fileName;
          file_put_contents($file, $image_base64);  

        	$simpanAbsen = mysqli_query($koneksi, "update absensi SET
          tgl_pulang='".$tanggal_pulang."',
          jam_pulang='".$jam_pulang."',
          foto_pulang='".$fileName."',
          status_pulang='".$status_pulang."',
          latlong_pulang='".$latlong_pulang."',
          jumlah_jam_kerja='".$totaljam."'
          where id_absen = ".$id_absen) or die(mysqli_error($koneksi));



        echo "<script>
          alert('Absen Pulang Berhasil!');
          window.location.href='../../absensi.php?module=home';
          </script>";    
        } 
      }   



  
?>