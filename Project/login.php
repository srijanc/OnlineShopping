<?php   
 session_start();
 include("config/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/functions.js"></script>
 <style type="text/css" media="all">
 @import "online.css";
 </style>
<script language="javascript">
  function check()
  {
   if(document.getElementById("txt_username").value ==="")
   {
    alert('Please Enter user name !!'); 
    document.getElementById("txt_username").focus();
    return false;
   }
   if(document.getElementById("txt_password").value ==="")
   {
    alert('Please Enter password !!');
    document.getElementById("txt_password").focus();
    return false;
   }
   if (isUcase(document.getElementById("txt_username").value) === false || isUcase(document.getElementById("txt_password").value) === false)
   {
    alert("Username and Password not match!!");
    document.getElementById("txt_username").value = "";
    document.getElementById("txt_password").value = "";
    document.getElementById("txt_username").focus();
    return false;
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
      <div id="subsidebar2"><a href="Startup.html">Home</a>
      </div>
      <div id="subsidebar2"><a href="signup.php">Sign Up</a> 
      </div>
      <div id="subsidebar2"><a href="aboutus.php">About Us</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Login Page</div>
      <div id="middletxt1">
        <p>Please enter the Login details.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_login" id="frm_login" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear"></th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Required  &nbsp; </span></div></td>
                  </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>User Name : </strong></div></td>
                 <td width="128"><input type="textbox" name="txt_username" id="txt_username" maxlength="20" style="width:176px;"
                                   onChange="document.getElementById('txt_username').value=trim(this.value);"/>
                                   <div class="example">(Only Lower case Allowed.)</div></td>
              </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Password : </strong></div></td>
                 <td width="128"><input type="password" name="txt_password" id="txt_password" maxlength="20" style="width:176px;"
                                   onChange="document.getElementById('txt_password').value=trim(this.value);"/></td>
              </tr>
              <tr>
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Login" Onclick="return check(this.form);" />
                 &nbsp;&nbsp;&nbsp;
                 </td>
              </tr>
              </table></td>
            </tr>
          </table>
        </form>
 
 <?php
 if(isset($_POST['submitMain']))
 {
   $user =$_POST['txt_username'];
   $password=$_POST['txt_password'];
   $query = mysql_query("SELECT * FROM t_custreg_mst WHERE username = '$user' AND log_password = '$password' ")
   or die(mysql_error());
   if(mysql_num_rows($query)>0)
   {
     $_SESSION['user']=$user;
     echo "<script>window.location='loghome.php';</script>";
   }
   else
   {
     echo '<div align="center"><strong><font color="#FF0000">User Name & Password not match !!</font></Strong></div>';
   }
}
@mysql_close($con);
?>
        <div align="right"><a href="forgetpassword.php">Forgot Your Password ?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div align="center"><img src="images/loginImage.jpg" alt="Login Please" width="300" height="200" /> </div>
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
</body>
</html>