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
   if(document.getElementById("txt_cat").value =="")
   {
    alert('Please Enter Category !!'); 
    document.getElementById("txt_cat").focus();
    return false;
   }
    if(document.getElementById("ta_catdcpn").value =="")
   {
    alert('Please Fill Description of Category !!');
    document.getElementById("ta_catdcpn").focus();
    return false;
   }
  }
  function charcount()
  {
   document.getElementById('static1').innerHTML = "Characters Remaining:  <span  id='charsLeft1'>   100 </span>";   
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
      <div id="subsidebar4">Account Settings
      <ul><li><a href="admemail.php">Change Email</a></li>
          <li><a href="admpassword.php">Change Password</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="admdisplay.php">Display Vendors</a> 
      </div>
      <div id="subsidebar2"><a href="adminmail.php">Send Mail</a> 
      </div>
      <div id="subsidebar2"><a href="adminlogin.php" onclick="isConfirmlog();" >Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Category Page</div>
      <div id="middletxt1">
        <p>Enter the details of  Category.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_addcat" id="frm_addcat" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Category Master</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
                  </tr>
                  <input type="hidden" name="username" id="username" value="" />
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Category : </strong></div></td>
                    <td width="128"><input type="textbox" name="txt_cat" id="txt_cat" maxlength="30"  value="" style="width:176px;"
                                           onChange="document.getElementById('txt_cat').value=trim(this.value);"/>
                  </tr>
                  <tr>
                    <td><div align="right"><font color="#FF0000">*</font><strong>Category Description :</strong></div>
                      <p align="right" class="example">(Maximum 100 characters) </p></td>
                    <td colspan="4"><textarea name="ta_catdcpn" id="ta_catdcpn" wrap="physical" cols="45" rows="5" title="Category Description Should not excide 100 characters!!"
                                    onchange=" document.getElementById('ta_catdcpn').value=trim(this.value);"></textarea><br>
                                    Characters Remaining: <span id="charsLeft1">100</span>
				  </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
                      <input type="submit"  id="submitMain" name="submitMain" value="Add" Onclick="return check(this.form);" > 
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
   $cat=$_POST['txt_cat'];
   $catdec=$_POST['ta_catdcpn'];
   $query = mysql_query("INSERT INTO t_category_mst (cat_category,cat_descreption) VALUES ('$cat','$catdec')")
    or die(mysql_error());
    echo "<script>alert('Category Added sucessfully !!');</script>";
  }
?>
</body>
</html>