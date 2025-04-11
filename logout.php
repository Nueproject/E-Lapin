<?php
include_once 'user_agent.php';
$ua = new UserAgent();

  session_start();
  session_destroy();

  echo "<script>alert('Anda telah keluar dari e-Lapin!'); 
  window.location = 'index.php'</script>";

?>