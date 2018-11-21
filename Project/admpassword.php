<?php   
 session_start();
 include("config/config.php");
 if(isset($_SESSION['admin']))
 {
  $username=$_SESSION['admin'];
 //echo "Admin name :".$username;
 } else {
 ?>
 <script>
  alert('You Are Not Logged In !! Please Login to access this page');
  window.location='adminlogin.php';
 </script>
 <?php
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script type="text/javascript" src="js/functions.js"></script>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/count.js"></script>
 <script type="text/javascript" src="#"></script>
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
    alert(window.location='admlogout.php');
   }
  }
  function check()
  {
  // validating Old Password for non empty !!
  if(document.getElementById("txt_old").value=="")
  {
   alert("Enter old Password !!");
   document.getElementById("txt_old").value = "";
   document.getElementById("txt_old").focus();
   return false;
  }
  // validating Password & Re-Enter Password for non empty , isCharNum(); & isEqual(); & isUcase(); !!
  if(document.getElementById("txt_password").value=="" || document.getElementById("txt_rpassword").value=="" )
  {
   alert("Enter New Password !!");
   document.getElementById("txt_password").value = "";
   document.getElementById("txt_rpassword").value = "";
   document.getElementById("txt_password").focus();
   return false;
  } else if(isCharNum(document.getElementById("txt_password").value) == false || isCharNum(document.getElementById("txt_rpassword").value) == false) {
    alert("Password Should be Lower case Characters & Numbers only !!");
    document.getElementById("txt_password").value = "";
    document.getElementById("txt_rpassword").value = "";
    document.getElementById("txt_password").focus();
    return false;
  } else if (isUcase(document.getElementById("txt_password").value) == false || isUcase(document.getElementById("txt_rpassword").value) == false) {
    alert("Password Should be Lower Case & Number only !!");
    document.getElementById("txt_password").value = "";
    document.getElementById("txt_rpassword").value = "";
    document.getElementById("txt_password").focus();
    return false;
  } else if (isLen(document.getElementById("txt_password").value) <8 || isLen(document.getElementById("txt_rpassword").value) <8){
    alert("Minimum Length Should be of 8 characters !!");
    document.getElementById("txt_password").value = "";
    document.getElementById("txt_rpassword").value = "";
    document.getElementById("txt_password").focus();
    return false;
    } else if (isSpace(document.getElementById("txt_password").value) == false || isSpace(document.getElementById("txt_rpassword").value) == false){
    alert("Space is not allowed !!");
    document.getElementById("txt_password").value = "";
    document.getElementById("txt_rpassword").value = "";
    document.getElementById("txt_password").focus();
    return false;
    } else {
    if(isEqual(document.getElementById("txt_password").value,document.getElementById("txt_rpassword").value)== false){
     alert("Password not match Re-Enter once again !!");
     document.getElementById("txt_password").value = "";
     document.getElementById("txt_rpassword").value = "";
     document.getElementById("txt_password").focus();
     return false;
    }
  }

  }
 </script>  

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
  @import "online.css";
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
      <div id="subsidebar3"> Navigation </div>
      <div id="subsidebar2"><a href="admloghome.php">Home</a>
      </div>
      <div id="subsidebar2"><a href="addcat.php">Add Category</a>
      </div>
      <div id="subsidebar4">Account Settings
      <ul>
          <li><a href="admemail.php">Change Email</a></li>
      </ul>
      </div>
      <div id="subsidebar2"><a href="admdisplay.php">Display Vendors</a> 
      </div>
      <div id="subsidebar2"><a href="adminmail.php">Send Mail</a> 
      </div>
      <div id="subsidebar2"><a href="" onclick="isConfirmlog();" >Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">&nbsp;</div>
      <div id="middletxt1">
        <p>Change your Email Here.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_prd" id="frm_prd" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Enter Details.</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
                  </tr>
                  <tr>
                   <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Old Password : </strong></div></td>
                   <td width="128"><input type="password" name="txt_old" id="txt_old" maxlength="10" style="width:176px;"
                                            onChange="UserCheckAvail(this.value);document.getElementById('txt_old').value=trim(this.value);"/>
                   </td>
                  </tr>
                  <tr>
                   <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>New Password : </strong></div>
                   <td width="128"><input type="password" name="txt_password" id="txt_password" maxlength="10" style="width:176px;"
                    onChange="document.getElementById('txt_password').value=trim(this.value);"/><div class="example">(Minimum 8 characters.)</div></td></td>
                  </tr>
                  <tr>
                   <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Re-Enter New Password : </strong></div></td>
                    <td width="128"><input type="password" name="txt_rpassword" id="txt_rpassword" maxlength="10" style="width:176px;"
                      onChange="document.getElementById('txt_rpassword').value=trim(this.value);"/><div class="example">(Minimum 8 characters.)</div></td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
                      <input type="submit"  id="submitMain" name="submitMain" value="Change" Onclick="return check(this.form);" > 
                      &nbsp;&nbsp;&nbsp;
                      <input type="reset" id="subintr" name="subintr" value="Reset"  /></td>
                  </tr>
              </table></td>
            </tr>
          </table>
        </form>
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

<!-- Code for inserting into data base -->
 <?php
  if(isset($_POST['submitMain']))
  {
   $get= @mysql_query("SELECT * FROM t_admin_mst WHERE adm_username= '$username' ")or die(mysql_error());
   $num= @mysql_num_rows($get);
   for($i=0;$i<$num;$i++)
   {
    $old_password= @mysql_result($get,$i,'adm_password');
   }
   $old=$_POST['txt_old'];
   $password=$_POST['txt_password'];
   if($old_password == $old){
    if($old == $password) {
      echo "<script> alert('Old password and New Password same ,Try Another !!');</script>";
     } else {
      $query = mysql_query("UPDATE t_admin_mst SET adm_password='$password' WHERE adm_username='$username' ")
                           or die(mysql_error());
      echo "<script>alert('Password Changed sucessfully !!');</script>";
     }
    } else {
      echo "<script>alert('Old Password is Wrong !!');</script>";
    }
  }
?>
</body>
</html>