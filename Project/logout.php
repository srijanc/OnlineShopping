<?php
 session_start();
 echo "user ".$_SESSION['user'];
 echo "<script>window.location='startup.html';</script>";
 /*if(session_is_registered('txt_username'))
 {
 session_unset();
 session_destroy();
 echo "<script>window.location='login.php';</script>";
 }
 else
 {
 echo "session not set";
 }*/
?>