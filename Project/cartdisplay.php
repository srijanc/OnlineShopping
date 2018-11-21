<?php
  session_start();
   include("config/config.php");
   $username=base64_decode($_GET['un']);
   $sid=$_SESSION['sid'];
    $count=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_sid='$sid'");
    $pcount=@mysql_num_rows($count);
   if($_GET['un']=="" || $pcount == 0 ){ ?>
   <script>
   alert('No Products Avilable At this time!!');
   window.location='Main.php?un=<?php echo base64_encode($username);?>';
 </script>
 <?php
 } else {
  $username=base64_decode($_GET['un']);
  $cat=$_GET['cat'];
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Shopping</title>
<link href="css/Webpage.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="all">
</style>
</head>
<body class="twoColFixLtHdr">
<div id="header">
  <!-- end #header -->
</div>
<div id="container">
  <div id="container1"></div>
  <div id="sidebar1">
    <div id="subsidebar1">
      <div id="subsidebar3">Thank You</div>
       <div align="center"><img src="images/bag1.jpeg" alt="Online Shopping" width="180" height="200" /></a></div>
       <div align="center"><img src="images/jump.jpg" alt="Online Shopping" width="180" height="340" /> </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
<?php
  $get= @mysql_query("SELECT * FROM t_orders_trn WHERE username= '$username' AND ord_sid='$sid'")or die(mysql_error());
   $num= @mysql_num_rows($get);
   for($i=0;$i<$num;$i++)
   {
   $fname=@mysql_result($get,$i,'ord_fname');
   //$lname=@mysql_result($get,$i,'ord_lname');
   //$pname=@mysql_result($get,$i,'ord_pname');
   $oqty=@mysql_result($get,$i,'ord_qty');
   $oprice=@mysql_result($get,$i,'ord_price');
   $badd=@mysql_result($get,$i,'ord_baddress');
   $sadd=@mysql_result($get,$i,'ord_saddress');
   //$country=@mysql_result($get,$i,'ord_country');
   $mob=@mysql_result($get,$i,'ord_mobile');
   //$phone=@mysql_result($get,$i,'ord_phone');
   }
  ?>
   <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right"></div>
      <div id="middletxt1">
       <div align="left"><img src="images/thankyou.jpg" alt="Online Shopping" width="600" height="150" /> </div>
      </div>
      </div>
      <div id="middletxt">
       <div id="middletxtheader">Your Details
        <div style="float:right;">
	<a href="./<?php echo $username;?>/index.php"><img src="images/home.png" height="27" width="30"></a></div>
      </div><!-- end #middletxt -->
        <table width="100%" border=0>
	<!-- MSTableType="layout" -->
        <tr>
		<td width="245" height="37"><div align="center"><strong>First Name : </td>
                <td ><?php echo $fname;?></strong></div></td>
	</tr>
	
        <tr>
          <td width="245" height="37"><div align="center"><strong>Billing Address : </td>
          <td ><?php echo $badd; ?></strong>
          </div></td>
        </tr>
        <tr>
         <td width="245" height="37"><div align="center"><strong>Shipping Address : </td>
         <td ><?php echo $sadd; ?></div></strong></td>
        </tr>
        
        <tr>
         <td width="245" height="37"><div align="center"><strong>Mobile No : </td>
         <td ><?php echo $mob;?></strong></div></td>
        </tr>
        
        </table>
         <table border="1" cellpadding="0" cellspacing="0" width="80%" height="50" align="center">
        <tr>
         <th>Product Name</th>
         <th>Quantity Ordered</th>
         <th>Delivery Date</th>
         <th>Price</th>
        </tr>
        <tr>
 <?php
   $get= @mysql_query("SELECT * FROM t_orders_trn WHERE username= '$username' AND ord_sid='$sid'")or die(mysql_error());
   $num= @mysql_num_rows($get);
   $total=0.0;
   for($i=0;$i<$num;$i++)
   {
   $pname=@mysql_result($get,$i,'ord_pname');
   $oqty=@mysql_result($get,$i,'ord_qty');
   $oprice=@mysql_result($get,$i,'ord_price');
   $ddate=@mysql_result($get,$i,'ord_ddate');
   $total+=$oprice;
 ?>
         <td><?php echo $pname;?></td>
         <td><?php echo $oqty;?></td>
         <td><?php echo $ddate;?></td>
         <td><?php echo $oprice;?></td>
        </tr>
<?php   }
 ?>
        <tr>
         <td align="right" colspan="5"><strong>Total Amount : <?php echo $total;?> </strong></td>
        </tr>
         </table>
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

 <?php
  if(isset($_SESSION['sid']))
  {
   $sid=$_SESSION['sid'];
   //if(session_is_registered($sid))
   //{
   session_unset();
   //session_destroy();
   //}
  }
 ?>

</body>
</html>