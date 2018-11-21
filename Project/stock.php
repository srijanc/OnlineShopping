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
      <div id="subsidebar2"><a href="loghome.php">Home</a>
      </div>
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
      <div id="subsidebar2"><a href="backup.php">Back UP</a> 
      </div>
      <div id="subsidebar5">Archive
      <ul>
      <?php
       $get_date= @mysql_query("SELECT DISTINCT bck_archive FROM t_backup_trn WHERE username= '$username' ORDER BY bck_archive DESC ")or die(mysql_error());
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
      <div id="subsidebar2"><a href="logout.php" onclick="logoutcon();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
 
    <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right">Stock Reports</div>
      <div id="middletxt1">
       <p>Over all stock reports of the product</p>
      </div>
      </div>
 
     <div id="middletxt">
       <div id="middletxtheader" align="right">Present Stock </div>
        <!-- end #middletxt -->
      <form name="frm_stock" id="frm_stock" method="post" action="">
      <table border="1" cellpadding="0" cellspacing="0" width="685" height="300">
       <tr>
        <th align="center">Product ID</th>
        <th align="center">Product Name</th>
        <th align="center">Quantity Avaiable</th>
        <th align="center">Product Status</th>
        <th align="center"></th>
       </tr>

 <?php
    $get= @mysql_query("SELECT * FROM t_product_mst WHERE username='$username'")or die(mysql_error());
    $num = @mysql_num_rows($get);
    for($i=0;$i<$num;$i++)
    {
     $prid= @mysql_result($get,$i,'prd_id');
     $psname= @mysql_result($get,$i,'prd_sname');
     $plname= @mysql_result($get,$i,'prd_lname');
     $pqtyavb= @mysql_result($get,$i,'prd_qty');
     $pstatus= @mysql_result($get,$i,'prd_status');
 ?>
       <tr>
        <td width="80"><?php echo $prid;?></td>
        <td width="200"><?php echo $psname?></td>
        <td width="150"><?php echo $pqtyavb;?></td>
        <td width="150"><?php echo $pstatus;?></td>
        <td align="center"><a href="productedit.php?prid=<?php echo $prid; ?>"><input type="button" id="btnedit" name="btnedit" value="Edit"></a></td>
       </tr>
 <?php
    }
 ?>
      </table>
      </form>	
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