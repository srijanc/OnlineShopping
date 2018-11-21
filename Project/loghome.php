<?php   
 session_start();
 include("config/config.php");
 if(isset($_SESSION['user']))
 {
  $username=$_SESSION['user'];
 //echo "User name :".$username;
 } else {
 ?>
 <script>
  alert('You Are Not Logged In !! Please Login to access this page');
  window.location='login.php';
 </script>
 <?php
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <script type="text/javascript" src="js/functions.js"></script>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "online.css";
 </style>
 <script language="javascript">
 // function for comfirm box !!
 function logoutcon()
 {
  var conlog = confirm('Are you sure you want to log out !!');
  if(conlog)
  {
   alert(window.location="logout.php");
  }
  else
  {
  return false;
  }
 }
 </script>
</head>

 <?php 
   $count=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Waiting'");
   $order_count=@mysql_num_rows($count);
   $count_del=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered'");
   $del_count=@mysql_num_rows($count_del);
 ?>

<body class="twoColFixLtHdr">
<div id="header">
  <!-- end #header -->
</div>
<div id="container">
  <div id="container1"></div>
  <div id="sidebar1">
    <div id="subsidebar1">
      <div id="subsidebar3"> Navigation </div>
      <div id="subsidebar2"><a href="productmaster.php">Product Master</a>
      </div>
      <div id="subsidebar2"><a href="pricemaster.php">Price Master</a> 
      </div>
      <div id="subsidebar4">Display
      <ul><li><a href="productdisplay.php">Product Master</a></li>
          <li><a href="pricedisplay.php">Price Master</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="reports.php">Order Reports<?php echo' ('.$order_count.')';?></a> 
      </div>
      <div id="subsidebar2"><a href="delivered.php">Delivery Reports<?php echo' ('.$del_count.')';?></a> 
      </div>
      <div id="subsidebar2"><a href="stock.php">Stock Reports</a> 
      </div>
      <div id="subsidebar2"><a href="backup.php">Back UP</a> 
      </div>
      <div id="subsidebar5">Archive
      <ul>
      <?php
        $get_date= @mysql_query("SELECT DISTINCT bck_archive FROM t_backup_trn WHERE username= '$username' ORDER BY bck_archive DESC")or die(mysql_error());
        $num_date= @mysql_num_rows($get_date);
        for($i=0;$i<$num_date;$i++)
        {
         $date= @mysql_result($get_date,$i,'bck_archive');
      ?>
      <li><a href="backupdisplay.php?date=<?php echo $date;?>"><?php echo $date;?></a></li>
      <?php
        }
      ?>
      </ul>
      </div>
      <div id="subsidebar2"><a href="mail.php">Send Mail</a> 
      </div>
      <div id="subsidebar4">Account Settings
      <ul><li><a href="changepassword.php">Change Password</a></li>
          <li><a href="accountsettings.php">Account Details</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="login.php" onclick="logoutcon();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right">Welcome</div>
      <div id="middletxt1">
       <div align="center"><img src="images/onlinebanner.jpeg" alt="Online Shopping" width="600" height="100"/> </div>
      </div>
      </div>
      <div id="middletxt">
       <div id="middletxtheader" align="right"></div>
        <!-- end #middletxt -->
       <div align="center"><img src="images/shopping-online.jpg" alt="Shopping Bag" width="580" height="420" align="center" /> </div>
      </div>
    </div>
    <!-- end #mainContent -->
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <div id="footer">
    (C) Copyright Srijan Vasu Vipul P. Limited
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</div>
</body>
</html>