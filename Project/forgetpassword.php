<?php   
 include("config/config.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "online.css";
 </style>
 <script type="text/javascript" src="js/functions.js"></script>
 <script type="text/javascript" src="js/forgetpassword.js"></script>
 <script language='javascript'>
  // validating User Name for non empty &  !!
  function done()
  {
   if(document.getElementById("txt_username").value == "")
   {
    alert("Enter User Name !!");
    document.getElementById('txt_username').focus();
    return false;
   }
   else
   {
    // validatins product ID already exit !!
    var noofrows = document.getElementById('noofrows').value;
    if(noofrows==0)
    {
     alert("User Name Does not Exists !!"); 
     document.getElementById("txt_username").focus();
     return false;
    }
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
      <div id="subsidebar2"><a href="login.php">Login</a>
      </div>
      <div id="subsidebar2"><a href="signup.php">Sign up</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right">Note :</div>
      <div id="middletxt1">
       <p> Please enter your User Name. <br> Password will be mailed to your E-mail ID check it and Login again.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_password" id="frm_password" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Please enter Your User Name.</th>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Required  &nbsp; </span></div></td>
                  </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>User Name : </strong></div></td>
                 <td width="128"><input type="textbox" name="txt_username" id="txt_username" maxlength="20" style="width:176px;"
                                  onChange="UserAvail(this.value);document.getElementById('txt_username').value=trim(this.value);"/>
                     <span name="userChange" id="userChange" style="color:red;">&nbsp;</span></td>
              </tr>
              <tr>
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Submit" Onclick="return done(this.form);" />
                 &nbsp;&nbsp;&nbsp;
                  <input type="reset" id="btnreset" name="btnreset" value="Reset" />
                 </td>
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

 <?php
 if(isset($_POST['submitMain']))
 {
  $user=$_POST['txt_username'];
  //echo $user;
  $get_user= @mysql_query("SELECT log_fname,log_email,log_password FROM t_custreg_mst WHERE username= '$user' ")or die(mysql_error());
  $num_user= @mysql_num_rows($get_user);
  for($i=0;$i<$num_user;$i++)
  {
   $fname= @mysql_result($get_user,$i,'log_fname');
   $email= @mysql_result($get_user,$i,'log_email');
   $password = @mysql_result($get_user,$i,'log_password');
  }
 // mail function
  $to = $email;
  $subject = 'Your password';
  $from = 'onlineshopping@rishisys.com';
  $message = 'Hello '.$fname.',<br> You had requested for your password. <br> Your password is <strong> '.$password.'</strong><br> Thanking you ..';
  $header = 'From : < '.$from.' >';
  //echo $message;
   ini_set('sendmail_from','onlineshopping@mymailmail.com');
   if(mail($to,$subject,$message,"From: <{$email}> "))
     echo "<script>alert('Mail sent')</script>";
    else
     echo "<script>alert('Mail send failure - message not sent')</script>";
 }
 ?>

</body>
</html>