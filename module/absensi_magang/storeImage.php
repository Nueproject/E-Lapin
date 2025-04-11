<?php
    date_default_timezone_set('Asia/Jakarta');
    session_start();
    include "../../lib/config.php";
    include "../../lib/koneksi.php";
    
    $img = $_POST['image'];
    $folderPath = "upload/";

    $datauser= mysqli_query($koneksi,"select * from user where username='".$_SESSION['username']."'");	 	
    while($user=mysqli_fetch_array($datauser)){        
      $user_id= $user['id'];
      $nama_pegawai= $user['nama_pegawai']; 	
    }
    $saiki = date('dmYhis');
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $nama_pegawai."_".$saiki . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
    print_r($fileName);
  
?>