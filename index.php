<?php
//include file
include_once 'user_agent.php';
 
//create an instance of UserAgent class
$ua = new UserAgent();
 
//if site is accessed from mobile, then redirect to the mobile site.
if($ua->is_mobile()){
    header("Location:index_hp.php"); //ini link untuk mobile
    //echo "ANDA MENGGUNAKAN ANDROID";
    exit;
}else{
    header("Location:index_pc.php?module=home"); //ini link untuk yang bukan mobile
    //echo "ANDA MENGGUNAKAN LAPTOP";
    exit;
}
?>