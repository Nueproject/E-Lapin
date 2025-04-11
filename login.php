<?php
// untuk memasukkan file koneksi.php
include "lib/koneksi.php";
// menangkap variabel POST dari form login / index.php
$username = $_POST['username'];
$pass = $_POST['password'];
// pastikan username dan password adalah berupa huruf atau angka.

    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND pass='$pass'");
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    // Apabila username dan password ditemukan
    if ($ketemu > 0) {
        session_start();

        $_SESSION['username'] = $r['username'];
        $_SESSION['passuser'] = $r['password'];

        //include file
        include_once 'user_agent.php';
        
        $jab = $r['jabatan'];
        //create an instance of UserAgent class
        $ua = new UserAgent();
        if ($jab=="admin"){ 

            header("Location:ngadimin.php?module=home"); 
                exit;
            } else if ($jab=="Magang"){
                header("Location:absensi_magang.php?module=home"); //ini link login magang
                exit;
            } else {

                //if site is accessed from mobile, then redirect to the mobile site.
                if($ua->is_mobile()){
                    header("Location:absensi.php?module=home"); //ini link untuk mobile
                    //echo "ANDA MENGGUNAKAN ANDROID";
                    exit;
                }else{
                    header("Location:adminweb.php?module=home"); //ini link untuk yang bukan mobile
                    //echo "ANDA MENGGUNAKAN LAPTOP";
                    exit;
                }
            } //else ke admin atau user

    } else {
        echo "<center>LOGIN GAGAL! <br>
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
        echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
    }


    

?>
