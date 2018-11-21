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
  alert(window.location='login.php');
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
 // function validation.
 function done()
 {
  if(document.getElementById("selpid").value == "selpid")
  {
   alert("Select Product ID !!");
   document.getElementById("selpid").focus();
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
      <div id="subsidebar2"><a href="logout.php" onclick="isConfirmlog();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxt">
        <form action="" method="post" name="frm_login" id="frm_login" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Price Master Display Page.</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Required  &nbsp; </span></div></td>
                  </tr>
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Product Id : </strong></div></td>
                    <td><select name="selpid" id="selpid" style="width:180px;">
                        <option value="selpid">- Select Product ID -</option>
                        <?php
                        $get_pid= @mysql_query("SELECT prd_id FROM t_price_mst WHERE username= '$username' ")or die(mysql_error());
                        $num_pid= @mysql_num_rows($get_pid);
                        for($i=0;$i<$num_pid;$i++)
                        {
                         $pid= @mysql_result($get_pid,$i,'prd_id');
                        ?>
			 <option value="<?php echo $pid;?>"><?php echo $pid;?></option>
                        <?php
                        }
                        ?>
                      </select></td>
                  </tr>
              <tr>
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Display" Onclick="return done(this.form);hidediv();" />
                 &nbsp;&nbsp;&nbsp;
                 </td>
              </tr>
              </table></td>
            </tr>
          </table>
        </form>
      </div>
      </div>
 
 <?php
  if($_POST['submitMain'])
  {
   $pid=$_POST['selpid'];
   $get= @mysql_query("SELECT * FROM t_price_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
   $num = @mysql_num_rows($get);
   for($i=0;$i<$num;$i++)
   {
    $prid= @mysql_result($get,$i,'prd_id');
    $pact= @mysql_result($get,$i,'price_actual');
    $pdis= @mysql_result($get,$i,'price_discount');
    $pdiscount= @mysql_result($get,$i,'price_discount_type');
   }
  }
 ?>
      <div id="middletxt">
        <form action="" method="post" name="frm_price_disp" id="frm_price_disp" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Product Price Details.</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
                  </tr>
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font> Product Id : </strong></div></td>
                    <td><?php echo $prid; ?></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font> Product Actual Price : </strong></div></td>
                    <td><?php echo $pact; ?></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font> Discount : </strong></div></td>
                     <td><?php echo $pdiscount; ?></td>
                   </tr>
                  <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font> Discounted Price : </strong></div></td>
                    <td><?php echo $pdis; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
		    <a href="priceedit.php?prid=<?php echo $prid; ?>"><input type="button" id="btnedit" name="btnedit" value="Edit"></a>
                      &nbsp;&nbsp;&nbsp;
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
</body>
</html>