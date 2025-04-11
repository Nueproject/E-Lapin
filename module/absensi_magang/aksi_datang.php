<?php
    date_default_timezone_set('Asia/Jakarta');
    session_start();
    include "../../lib/config.php";
    include "../../lib/koneksi.php";
    

    if($_POST['lokasi']==0){ //validasi SELECT
      echo "<script>
        alert('Lokasi Kantor belum dipilih!');
        window.location.href='../../absensi.php?module=home';
        </script>";
    } else if ($_POST['shift']==0){
      echo "<script>
      alert('Shift Kerja belom dipilih!');
      window.location.href='../../absensi.php?module=home';
      </script>";
    } else if ($_POST['image']==null){
      echo "<script>
      alert('FOTO TIDAK DITEMUKAN!');
      window.location.href='../../absensi.php?module=home';
      </script>";
    } else {

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
          $jam_masukkerja= $shift['jam_datang_shift'];
          $jam_pulangkerja= $shift['jam_pulang_shift'];
        }
        $explode=explode(",",$lat_long_kantor);  
        $lat_kantor = $explode[0]; //untuk tahun
        $long_kantor = $explode[1]; //untuk bulan
        //lokasi Kantor
        $tanggal_datang= date('Y-m-d');
        $tanggal_pulang= "";
        $jam_datang= date('H:i:s');
        $jam_pulang= "";
        $foto_datang= "";
        $foto_pulang= "";
        $status_pulang= "";
        $latlong_datang= "$lat_pegawai,$long_pegawai";
        $latlong_pulang= "";
        $jumlah_jam_kerja= "";

        $a = -7.7388636;
        $b = 110.3640464;
        $hasil = distance($lat_kantor, $long_kantor, $lat_pegawai, $long_pegawai, "K");		 
        
        $maxsid = mysqli_query($koneksi, "select max(id_absen) AS idabsen from absensi");
        $count = $maxsid->fetch_assoc();
        $idakhir = $count['idabsen'];
        $newid = $idakhir + 1;	

        //ALGORITMA HITUNG TELAT
        $dat= strtotime($jam_datang);
        $masuk= strtotime($jam_masukkerja);
        $selisih = $dat-$masuk;  
        $menit = 60*($selisih / (60 * 60));
        $m = number_format($menit,0);
        if ($menit>0){
          $status_datang = "Telat $m menit";
        } else {
          $status_datang = "Tepat Waktu";
        }
        // echo $status_datang;
        // echo "$lokasi <br>";
        // echo "$lat_pegawai <br>";
        // echo "$long_pegawai <br>";
        // echo "$lat_long_kantor <br>";
        // echo "$shift <br>";
        // echo "$nama_pegawai <br>";
        // echo "$r <br>";
        // echo "$hasil <br>";
        // echo $idakhir;  
   
    // print_r($fileName);

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
          $fileName = $user_name."_datang".$saiki . '.png';
          $file = $folderPath . $fileName;
          file_put_contents($file, $image_base64);  

        	$simpanAbsen = mysqli_query($koneksi, "insert into absensi (id_absen, id_peg, id_kantor, id_shift, tgl_datang, tgl_pulang, jam_datang, jam_pulang, foto_datang, foto_pulang, status_datang, status_pulang, latlong_datang, latlong_pulang, jumlah_jam_kerja) 
		      values ('$newid', '$user_id', '$id_kantor', '$id_shift', '$tanggal_datang', '$tanggal_pulang', '$jam_datang', '$jam_pulang', '$fileName', '$foto_pulang', '$status_datang', '$status_pulang', '$latlong_datang', '$latlong_pulang', '$jumlah_jam_kerja')") or die(mysqli_error($koneksi));
		
        
        echo "<script>
          alert('Absen Berhasil!');
          window.location.href='../../absensi.php?module=home';
          </script>";    
        } 
      }   
    }



  
?>