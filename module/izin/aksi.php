<?php
 
	session_start();

    include "../../lib/config.php";
    include "../../lib/koneksi.php";
	
	//AKSI_UBAH_PASSWORD

		 // Ambil Data yang Dikirim dari Form
		 $nama_file = $_FILES['bukti']['name'];
		 $ukuran_file = $_FILES['bukti']['size'];
		 $tipe_file = $_FILES['bukti']['type'];
		 $tmp_file = $_FILES['bukti']['tmp_name'];
		 $path = "../../img/upload/bukti_ijin/" . $nama_file;
		 $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		 $allow = array('png','jpg', 'jpeg', 'pdf', 'doc');

		 date_default_timezone_set('Asia/Jakarta');
		 $id_peg = $_POST['user_id'];
		 $jenis = $_POST['jenis'];
		 $alasan = $_POST['alasan'];
		 $tgl_mulai = $_POST['mulai_izin'];
		 $jam_mulai = $_POST['jam_mulai'];
		 $tgl_selesai = $_POST['selesai_izin'];
		 $jam_selesai = $_POST['jam_selesai'];
 
		 $tgl1 = strtotime($tgl_mulai); 
		 $tgl2 = strtotime($tgl_selesai); 
		 $jarak = $tgl2 - $tgl1;
		 $jml = $jarak / 60 / 60 / 24;
		 $hasil = $jml + 1;
 
 			 $maxid = "select max(id_izin) AS idiz from izin";
			 $querymax = mysqli_query($koneksi, $maxid);
			 $count = $querymax->fetch_assoc();
			 $newid = $count['idiz'] + 1;
		 

		if (in_array($ext, $allow)) {	 
			if ($ukuran_file <= 5000000) {
				if (move_uploaded_file($tmp_file, $path)) {
					$simpan = mysqli_query($koneksi, "insert into izin 
					(id_izin, id_peg, jml_izin, mulai_izin, jam_mulai, selesai_izin, jam_selesai, jenis_izin, keterangan_izin, bukti_izin) values 
					('$newid', '$id_peg', '$hasil', '$tgl_mulai', '$jam_mulai', '$tgl_selesai', '$jam_selesai', '$jenis', '$alasan', '$nama_file')") or die(mysqli_error($koneksi));
					
				

					// $querysimpan="1";

					if ($simpan) {
						// Jika Berhasil, Lakukan :
						echo "<script> alert('Data Ijin Berhasil Masuk'); 
						window.location = '../../adminweb.php?module=izin';</script>";
					} else {
						// Jika Gagal, Lakukan :
						echo "<script> alert('Data Gagal disimpan');";
					}
				} else {
					// Jika gambar gagal diupload, Lakukan :
					echo "<script> alert('File gagal disimpan!');</script>";
				} 
			} else {
				// Jika ukuran file lebih dari 5MB, lakukan :
				echo "<script> alert('Ukuran file melebihi 5 MB'); 
				window.location = '../../adminweb.php?module=izin';</script>";
			}
		} else {
			// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
			echo "<script> alert('Data Bukti Izin harus berbentuk JPG/JPEG/PNG'); window.location = '../../adminweb.php?module=izin';</script>";
		}
		
		



	
