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
 <script type="text/javascript" src="js/ajax_captcha.js"></script>
 <script type="text/javascript" src="js/productmaster.js"></script>
 <script type="text/javascript" src="js/productmastervalidation.js"></script>
 <script language="javascript">
 // function for comfirm box !!
 function logoutcon()
 {
  var conlog = confirm('Are you sure you want to log out !!');
  if(conlog)
  {
   alert(window.location="admlogout.php");
  }
  else
  {
  return false;
  }
 }
  function check()
  {
   if(document.getElementById("selemail").value == "selemail")
   {
    alert("Select Email ID !!");
    document.getElementById("selemail").focus();
    return false;
   }
   if(document.getElementById("txt_sub").value =="")
   {
    alert('Please Enter Subject !!');
    document.getElementById("txt_sub").focus();
    return false;
   }
    if(document.getElementById("tamsg").value =="")
   {
    alert('Please Enter Message !!');
    document.getElementById("tamsg").focus();
    return false;
   }
  }
  function charcount()
  {
   document.getElementById('static1').innerHTML = "Characters Remaining:  <span  id='charsLeft2'>   500 </span>";   
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
      <ul><li><a href="admemail.php">Change Email</a></li>
          <li><a href="admpassword.php">Change Password</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="admdisplay.php">Display Vendors</a> 
      </div>
      <div id="subsidebar2"><a href="adminmail.php">Send Mail</a> 
      </div>
      <div id="subsidebar2"><a href="admlogout.php" onclick="logoutcon();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Mail Page</div>
      <div id="middletxt1">
        <p align="left">Enter the Subject and Message. </br> You can mail only to Your Vendors</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_mail" id="frm_mail" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Mail.</th>
                  </tr>
                  <tr>
                   <td></td>
                  </tr>
                  <tr>
                    <td width="245" height="37"><div align="right"><strong>Select Email : </strong></div></td>
                    <td><select name="selemail" id="selemail" style="width:300px;">
                        <option value="selemail">- Select Email id -</option>
                        <?php
                        $get_email= @mysql_query("SELECT log_email FROM t_custreg_mst")or die(mysql_error());
                        $num= @mysql_num_rows($get_email);
                        for($i=0;$i<$num;$i++)
                        {
                         $email= @mysql_result($get_email,$i,'log_email');
                        ?>
			 <option value="<?php echo $email;?>"><?php echo $email;?></option>
                        <?php
                        }
                        ?>
                      </select></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong>Subject : </strong></div></td>
                    <td width="128"><input type="textbox" name="txt_sub" id="txt_sub"  value="" maxlength="30" style="width:300px;"
                                      onchange="document.getElementById('txt_sub').value=trim(this.value);"/></td>
                  </tr>
                   <tr>
                    <td><div align="right"><strong>Message :</strong></div>
                      <p align="right" class="example">(Maximum 500 characters) </p></td>
                      <td width="128"><textarea name="tamsg" id="tamsg" wrap="physical" cols="45" rows="5" title="Message Should not excide 500 characters !!"
                                       onchange=" document.getElementById('tamsg').value=trim(this.value);"></textarea><br>
                                    Characters Remaining: <span id="charsLeft1">500</span></td>
                    </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
                      <input type="submit" id="submitMain" name="submitMain" value="Send  " Onclick="return check(this.form);" > 
                      &nbsp;&nbsp;&nbsp;
                      <input type="reset" id="subintr" name="subintr" value="Reset"  /></td>
                  </tr>
              </table></td>
            </tr>
          </table>
        </form>
        <div align="center"><img src="images/mail.png" alt="mail image" width="200" height="150" /> </div>
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
   //getting the values !!
   $vend_email=$_POST['selemail'];
   $sub=$_POST['txt_sub'];
   $message=$_POST['tamsg'];
   
   $get= @mysql_query("SELECT * FROM t_admin_mst")or die(mysql_error());
   $num= @mysql_num_rows($get);
   for($i=0;$i<$num;$i++)
   {
    $adm_email= @mysql_result($get,$i,'adm_email');
   }
    // mail function
    $to = $vend_email;
    $subject = $sub;
    $from = $adm_email;
    $message =  $message.'Thanking you ..';
    $header = 'From : < '.$from.' >';
    //echo $message;
    ini_set('sendmail_from','onlineshopping@mymailmail.com');
    if(mail($to,$subject,$message,"From: <{$email}> "))
      echo "<script>alert('Mail sent')</script>";
     else
      echo "<script>alert('Mail send failure - message not sent')</script>";
    echo "<script>window.location='adminmail.php?un=$username'</script>";
  }
  ?>
</body>
</html>