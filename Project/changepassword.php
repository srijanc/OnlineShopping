<?php   
 session_start();
 include("config/config.php");
 //echo "User".$_SESSION['user'];
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
 <script type="text/javascript" src="js/changepassword.js"></script>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "online.css";
 </style>
 <script language="javascript">
 // function for comfirm box !!
 function isConfirmlog()
 {
  var r = confirm('Are you sure you want to log out !!');
  if(!r)
  {
   return false;
   
  }
  else
  {
   alert(window.location='logout.php');
  }
 }
 </script>
</head>

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
      <div id="subsidebar4">Account Settings
      <ul>
          <li><a href="accountsettings.php">Account Details</a></li>
      </ul>
      </div>
      <div id="subsidebar2"><a href="" onclick="isConfirmlog();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>

<div id="mainContent">
 <div id="mainContent1">
  <div id="middletxtheadermain">
   <div id="middletxtheader" align="right">Account Settings</div>
      <div id="middletxt1">
       <p>Change your Password Here.</p>
       </div>
    </div>

  <div id="middletxt">
  <form action="" method="post" name="frm_change" id="frm_change" enctype="multipart/form-data">
  <table width="100%" border=0>
   <tr>
    <th colspan="5" id="formhedear">Please Enter the Details</th>
   </tr>
   <tr>
    <td height="34" colspan="2"></td>
    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
   </tr>
   <tr>
    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Old Password : </strong></div></td>
    <td width="128"><input type="password" name="txt_old" id="txt_old" maxlength="20" style="width:176px;"
                     onChange="UserCheckAvail(this.value);document.getElementById('txt_old').value=trim(this.value);"/>
    </td>
   </tr>
   <tr>
    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>New Password : </strong></div>
    <td width="128"><input type="password" name="txt_password" id="txt_password" maxlength="20" style="width:176px;"
                    onChange="document.getElementById('txt_password').value=trim(this.value);"/><div class="example">(Minimum 8 characters.)</div></td></td>
   </tr>
   <tr>
    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Re-Enter New Password : </strong></div></td>
    <td width="128"><input type="password" name="txt_rpassword" id="txt_rpassword" maxlength="20" style="width:176px;"
                     onChange="document.getElementById('txt_rpassword').value=trim(this.value);"/><div class="example">(Minimum 8 characters.)</div></td></td>
    </tr>
    <tr>
     <td colspan="5" align="center">  <input type="submit" id="submitchange" name="submitchange" value="Change" Onclick="return done(this.form);" />
      &nbsp;&nbsp;&nbsp; <input type="reset" id="btnreset" name="btnreset" value="Reset" />
     </td>
    </tr>
   </table>
  </form><br/>
        <div align="center"><img src="images/ChangePassword.png" alt="change password" width="200" height="200" /></div>
        <!-- end #middletxt -->
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
  $get= @mysql_query("SELECT * FROM t_custreg_mst WHERE username= '$username' ")or die(mysql_error());
  $num= @mysql_num_rows($get);
  for($i=0;$i<$num;$i++)
  {
   $old_password= @mysql_result($get,$i,'log_password');
  }
  if($_POST['submitchange']){
   $old=$_POST['txt_old'];
   $password=$_POST['txt_password'];
   if($old_password == $old){
    if($old == $password) {
      echo "<script> alert('Old password and New Password same ,Try Another !!');</script>";
     } else {
      $query = mysql_query("UPDATE t_custreg_mst SET log_password='$password' WHERE username='$username' ")
                           or die(mysql_error());
      echo "<script>alert('Password Changed sucessfully !!');</script>";
      echo "<script>  window.location='loghome.php';</script>";
     }
    } else {
      echo "<script>alert('Old Password is Wrong !!');</script>";
    }
  }
?>

</body>
</html>