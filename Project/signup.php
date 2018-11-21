 <?php   
 include("config/config.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Shopping</title>
<link href="css/online.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/count.js"></script>
<script type="text/javascript" src="js/ajax_captcha.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
<script type="text/javascript" src="js/signupvalidation.js"></script>
<style type="text/css" media="all">
@import "online.css";
</style>
<script language="javascript">
  function charcount()
 {
  document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft1'>   100 </span>";
  document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft2'>   400 </span>";
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
      <div id="subsidebar2"><a href="aboutus.php">About Us</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Sign Up Page</div>
      <div id="middletxt1">
        <p>Create your account here.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_signup" id="frm_signup" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Please enter Your details.</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Required  &nbsp; </span></div></td>
                  </tr>
                 <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>First Name : </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_fname" id="txtsin_fname" maxlength="30" style="width:176px;"
                                   onChange="document.getElementById('txtsin_fname').value=trim(this.value);"/></td>
              </tr>
               <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Last Name : </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_lname" id="txtsin_lname" maxlength="30" style="width:176px;"
                                   onChange="document.getElementById('txtsin_lname').value=trim(this.value);"/></td>
              </tr>
                <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Gender : </strong></div></td>
                 <td width="128"><input type="radio" name="rd_gen" id="rd_male" value="Male">Male &nbsp;&nbsp;&nbsp;&nbsp;
                                 <input type="radio" name="rd_gen" id="rd_female" value="Female">Female</td>
              </tr>
                <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>E-mail : </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_email" id="txtsin_email" maxlength="50" style="width:176px;"
                                   onChange="document.getElementById('txtsin_email').value=trim(this.value);"/></td>
              </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>User Name : </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_username" id="txtsin_username" maxlength="20" style="width:176px;"
                                  onChange="UserCheckAvail(this.value);document.getElementById('txtsin_username').value=trim(this.value);"/>
                                  <div class="example">(Only Lower case Allowed.)</div>
                     <span name="userChange" id="userChange" style="color:red;">&nbsp;</span></td>
              </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Password : </strong></div>
                 <td width="128"><input type="password" name="txtsin_password" id="txtsin_password" maxlength="20" style="width:176px;"
                                   onChange="document.getElementById('txtsin_password').value=trim(this.value);"/><div class="example">(Minimum 8 characters.)</div></td></td>
              </tr>
              <tr>
                 <td><div align="right"><strong><font color="#FF0000">*</font>Address :</strong></div>
                 <p align="right" class="example">(Maximum 100 characters) </p></td>
                 <td colspan="4"><textarea name="ta_add" id="ta_add" wrap="physical" cols="45" rows="5" title="Address Should no excide 100 characters !!"
                                  onchange=" document.getElementById('ta_add').value=trim(this.value);"></textarea><br>
                                  Characters Remaining: <span id="charsLeft1">100</span>
              </tr>
              <tr>
                 <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Mobile No : </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_mob" id="txtsin_mob" maxlength="10" style="width:120px;"
                                   onChange="document.getElementById('txtsin_mob').value=trim(this.value);"/></td>
              </tr>
              
              <tr>
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Sign Up" Onclick="return done(this.form);" />
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
<!-- Insertion for Data Base !! -->
<?php
  if(isset($_POST['submitMain']))
  {
   // geting today's date !!
   $today = getdate();
   
   $wday=$today[wday];
   $mon=$today[mon];
   $year=$today[year];
   $date = $year.":".$mon.":".$wday;
   //echo "date : " . $date;
   //getting the values !!
   $fname=$_POST['txtsin_fname'];
   $lname=$_POST['txtsin_lname'];
   $gender=$_POST['rd_gen']; // after renaming
   $email=$_POST['txtsin_email'];
   $username=$_POST['txtsin_username'];
   $password=$_POST['txtsin_password'];
   $add=$_POST['ta_add'];
   $mob=$_POST['txtsin_mob'];

    $get= @mysql_query("SELECT * FROM t_admin_mst")or die(mysql_error());
    $num= @mysql_num_rows($get);
    for($i=0;$i<$num;$i++)
    {
     $adm_email= @mysql_result($get,$i,'adm_email');
    }
    // mail function
    $to = $adm_email;
    $subject = 'Your password';
    $from = 'onlineshopping@rishisys.com';
    $message = 'Hello '.$fname.',<br> You Have an new Vendor with username <strong>'.$username.'.</strong> <br> So please create an URL for that username .
                For more details login to your system. Thanking you ..';
    $header = 'From : < '.$from.' >';
    //echo $message;
    ini_set('sendmail_from','onlineshopping@mymailmail.com');
    if(mail($to,$subject,$message,"From: <{$email}> "))
      echo "<script>alert('Mail sent')</script>";
     else
      echo "<script>alert('Mail send failure - message not sent')</script>";

   $query = mysql_query("INSERT INTO t_custreg_mst
    (log_fname,log_lname,log_gender,log_email,username,log_password,log_address,log_mobile,log_regdate)
    VALUES ('$fname','$lname','$gender','$email','$username','$password','$add','$mob','$date')")
    or die(mysql_error());
    echo "<script>alert('Your account has been created !!');</script>";
  }
 ?>
</body>
</html>