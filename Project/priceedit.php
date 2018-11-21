<?php   
 session_start();
 include("config/config.php");
 if($_GET['prid']==""){
 ?>
  <script>
  alert('Select the product');
  alert(window.location='pricedisplay.php');
 </script>
 <?php
 }
 //echo "User".$_SESSION['user'];
 if(isset($_SESSION['user']) && isset($_GET['prid']))
 {
  $username=$_SESSION['user'];
  $pid=$_GET['prid'];
 //echo "User name :".$username;
 //echo "pid : ".$pid;
 }
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script type="text/javascript" src="js/functions.js"></script>
 <script type="text/javascript" src="js/ajax_captcha.js"></script>
 <script type="text/javascript" src="js/priceeditvalidation.js"></script>
 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "online.css";
 </style>
 
 <script language="javascript">
 //function for comfirm box !!
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
 function showdiv()
 {
  document.getElementById('discountnmdiv').style.display="block";
  document.getElementById('discountdiv').style.display="block";
  document.getElementById('txtprc_disprc').value="";
 }
 function hidediv()
 {
  document.getElementById('discountnmdiv').style.display="none";
  document.getElementById('discountdiv').style.display="none";
  document.getElementById('txtprc_disprc').value="";
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
      <div id="middletxtheader">Product Master</div>
      <div id="middletxt1">
        <p>Please Edit the price of  products here.</p>
      </div>
      </div>

 <?php
  $get= @mysql_query("SELECT * FROM t_price_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
  $num = @mysql_num_rows($get);
  for($i=0;$i<$num;$i++)
  {
   $prid= @mysql_result($get,$i,'prd_id');
   $pact= @mysql_result($get,$i,'price_actual');
   $pdis= @mysql_result($get,$i,'price_discount');
   $pdiscount= @mysql_result($get,$i,'price_discount_type');
  }
 ?>
 <div id="middletxt">
        <form action="" method="post" name="frm_price" id="frm_price" enctype="multipart/form-data">
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
                 <input type="hidden" name="username" id="username" value="" />
                 <tr>
                   <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Product Id : </strong></div></td>
                   <td width="128"><input type="textbox" name="txtprd_id" id="txtprd_id" maxlength="10"  value="<?php echo $prid?>" style="width:176px;" READONLY>
                 </tr>
                 <tr>
                   <td><div align="right"><strong><font color="#FF0000">*</font> Actual Price Of Product : </strong></div></td>
                   <td width="128"><input type="textbox" name="txtprc_actprc" id="txtprc_actprc" maxlength="30" style="width:176px;"
                                     value="<?php echo $pact; ?>" 
                                     onchange="document.getElementById('txtprc_actprc').value=trim(this.value);"/></td>
                 </tr>
		 <!-- Seasonal Discount -->
		 <tr>
                  <td height="22"><div align="right"><font color="#FF0000">*</font><strong> Discount : </strong></div></td>
		  <?php
		   if($pdiscount == 'Yes')
		  { ?>
		  <td colspan="4"><input type="radio" name="rdo_ses" id="rdoyes" value="Yes" checked onclick="showdiv();" />Yes
                  <input type="radio" name="rdo_ses" id="rdono" value="No" onclick="hidediv();" />No</td>
		  </tr>
                  <tr><td><div id="discountnmdiv">
                  <div align="right"><font color="#FF0000">*</font><strong>Discount Price Of Product : </strong></div>
                  </div></td>
                  <td width="128"><div id="discountdiv" ><input type="textbox" name="txtprc_disprc" id="txtprc_disprc" maxlength="30" style="width:176px;"
                                                          value="<?php echo $pdis; ?>"
                                                          onchange="document.getElementById('txtprc_disprc').value=trim(this.value);"/></div>
                  </td>
                 </tr>
		 <?php } else {  ?>
		  <td colspan="4"><input type="radio" name="rdo_ses" id="rdoyes" value="Yes" onclick="showdiv();" />Yes
                  <input type="radio" name="rdo_ses" id="rdono" value="No" checked onclick="hidediv();" />No</td>
		</tr>
                <tr><td><div id="discountnmdiv" style="display:none;" >
                 <div align="right"><font color="#FF0000">*</font><strong> Discounted Price Of Product : </strong></div></div></td>
                  <td width="128"><div id="discountdiv" style="display:none;" >
                  <input type="textbox" name="txtprc_disprc" id="txtprc_disprc" maxlength="30" style="width:176px;"
                                                          value="" onchange="document.getElementById('txtprc_disprc').value=trim(this.value);"/></div>
                  </td>
                </tr>
		 <?php } ?>
		 <tr>
                    <td><div align="right" style="padding-top:45px;"><span class="req">*</span><strong> Verification&nbsp;Code :</strong></div></td>
                    <td colspan="4"><p><img id="imgCaptcha" src="js/create_image.php" /><span class="style4">(letters are case sensitive )</span></p>
                      <input type="text" id="txtcaptcha" name="txtcaptcha" maxlength="10" size="10" onchange="getParam(document.frm_price);document.getElementById('txtcaptcha').value=trim(this.value);" />
                      <span id="newImg"> Can't see image ? <a onclick="getphoto(document.frm_price)" href="javascript:void(0);" class="imglink">Load a new image</a></span>
                      <div name="divVeriCode" id="divVeriCode">Enter the code as shown in the image</div>
                      <div id="result"></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <input type="hidden" name="img_name2" id="img_name2" />
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;
                      <input type="submit" id="submitMain" name="submitMain" value="Update" Onclick="return done(this.form);" > 
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

<?php
 if($_POST['submitMain'])
 {
  //getting the values !!
  $username=$_SESSION['user'];
  $pact=$_POST['txtprc_actprc'];
  $pdis=$_POST['txtprc_disprc'];
  $pdiscount=$_POST['rdo_ses'];

  $get=mysql_query("select * from t_price_mst where username='$username' AND prd_id = '$pid' ");
  $query = mysql_query("UPDATE t_price_mst SET price_actual='$pact',price_discount='$pdis',
                       price_discount_type='$pdiscount' WHERE username='$username' AND prd_id='$pid'  ")
                       or die(mysql_error());
  echo "<script>alert('Price Details Updated sucessfully !!');</script>";
  echo "<script>window.location='pricedisplay.php'</script>";
  }
?>

</body>
</html>