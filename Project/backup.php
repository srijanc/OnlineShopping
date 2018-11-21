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
  $count_del=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered'");
  $del_count=@mysql_num_rows($count_del);
 if($del_count==0)
 {
 ?>
  <script>
  alert('No Delivered Products this time !! You Cannot Create Back up');
  window.location='loghome.php';
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
  function check()
  {
   if(document.getElementById('seldate').value == 'seldate')
   {
    alert('Select Start Date !!');
    return false;
   }
   if(document.getElementById('seledate').value == 'seledate')
   {
    alert('Select End Date !!');
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
      <div id="subsidebar2"><a href="stock.php">Stock Reports</a> 
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
      <div id="subsidebar2"><a href="" onclick="logoutcon();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>

<div id="mainContent">
  <div id="mainContent1">
   <div id="middletxtheadermain">
     <div id="middletxtheader" align="right">Back Up </div>
      <div id="middletxt1">
      <form name="frm_rpt" id="frm_rpt" action="" method="post">
       <table width="100%" border=0>
        <tr>
           <p align="center">Generate and Archive the back up of order transactions.</p>
           <td height="34" colspan="2"></td>
           <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
        </tr>
        <tr>
         <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Start Date : </strong></div></td>
         <td><select name="seldate" id="seldate" style="width:180px;">
             <option value="seldate">- Select Order Date -</option>
             <?php
              $get_date= @mysql_query("SELECT DISTINCT ord_odate FROM t_orders_trn WHERE ord_deliverystatus= 'Delivered' AND username= '$username' ORDER BY ord_odate DESC ")or die(mysql_error());
              $num_date= @mysql_num_rows($get_date);
              for($i=0;$i<$num_date;$i++)
              {
               $odate= @mysql_result($get_date,$i,'ord_odate');
             ?>
             <option value="<?php echo $odate;?>"><?php echo $odate;?></option>
             <?php
              }
             ?>
             </select>
         </td>
        </tr>
        <tr>
         <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>End Date : </strong></div></td>
         <td><select name="seledate" id="seledate" style="width:180px;">
             <option value="seledate">- Select Order Date -</option>
             <?php
              $get_date= @mysql_query("SELECT DISTINCT ord_odate FROM t_orders_trn WHERE ord_deliverystatus= 'Delivered' AND username= '$username' ORDER BY ord_odate DESC")or die(mysql_error());
              $num_date= @mysql_num_rows($get_date);
              for($i=0;$i<$num_date;$i++)
              {
               $odate= @mysql_result($get_date,$i,'ord_odate');
             ?>
             <option value="<?php echo $odate;?>"><?php echo $odate;?></option>
             <?php
              }
             ?>
             </select>
        </td>
        </tr>
        <tr>
         <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="submit" id="submitMain" name="submitMain" value="Back Up" Onclick="return check(this.form);" />
         </td>
        </tr>
       </table>
      </form>
      </div>
     </div>

  <div id="middletxt">
   <div id="middletxtheader" align="right"></div>
    <!-- end #middletxt -->
   <div align="center"><img src="images/backup.jpg" alt="back up" width="400" height="350" align="center" /> </div>
   </div>
   </div>
    <!-- end #mainContent -->
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <div id="footer">
    (C) Copyright Rishi Systems P. Limited
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</div>

 <?php
  if(isset($_POST['submitMain']))
  {
   $today=date("d-m-Y");
   $start_date=$_POST['seldate'];
   $sdate=date("Y-m-d",strtotime($start_date));
   $end_date=$_POST['seledate'];
   $edate=date("Y-m-d",strtotime($end_date));
   if($edate<$sdate)
   {
    echo "<script>alert('End date should be Greater than Start Date !!')</script>";
    echo "<script>window.location='backup.php'</script>";     
   }
   else
   {
    $get= @mysql_query("SELECT * FROM t_orders_trn WHERE username='$username' AND ord_deliverystatus='Delivered'");
    for($i=0;$i<$get;$i++)
    {
     $o_date1= @mysql_result($get,$i,'ord_odate');
     $o_date=date('Y-m-d',strtotime($o_date1));
     if($o_date>=$sdate && $o_date<=$edate)
     {
      $row= @mysql_result($get,$i,'row_id');
      $prid= @mysql_result($get,$i,'prd_id');
      $pname= @mysql_result($get,$i,'ord_pname');
      $fname=@mysql_result($get,$i,'ord_fname');
      $lname=@mysql_result($get,$i,'ord_lname');
      $oqty=@mysql_result($get,$i,'ord_qty');
      $price=@mysql_result($get,$i,'ord_price');
      $odate=@mysql_result($get,$i,'ord_odate');
      $ddate=@mysql_result($get,$i,'ord_ddate');
      $mail=@mysql_result($get,$i,'ord_email');
      $badd=@mysql_result($get,$i,'ord_baddress');
      $sadd=@mysql_result($get,$i,'ord_saddress');
      //$country=@mysql_result($get,$i,'ord_country');
      $mob=@mysql_result($get,$i,'ord_mobile');
      $phone=@mysql_result($get,$i,'ord_phone');
     // Qurey insert into back up table & delete from order table
      $query = mysql_query("INSERT INTO t_backup_trn (prd_id,username,bck_archive,bck_pname,bck_qty,bck_price,bck_fname,bck_lname,bck_odate,bck_ddate,bck_email,bck_baddress,bck_saddress,bck_mobile)
                           VALUES ('$prid','$username','$today','$pname','$oqty','$price','$fname','$lname','$odate','$ddate','$mail','$badd','$sadd','$mob')") or die(mysql_error());
      $del = mysql_query("DELETE from t_orders_trn WHERE username='$username' AND row_id='$row' ") or die(mysql_error());
     }
    }
    echo "<script>alert('Back up created !!')</script>";
    $count_del=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered'");
    $del_count=@mysql_num_rows($count_del);
    if($del_count==0)
   {
 ?>
  <script>
   window.location='loghome.php';
  </script>
 <?php
   } else {
    echo "<script>window.location='backup.php'</script>";
   }
   }
  }
 ?>
</body>
</html>