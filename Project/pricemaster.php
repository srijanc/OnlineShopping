<?php   
 session_start();
 include("config/config.php");
 //echo "User".$_SESSION['user'];
 if(isset($_SESSION['user']))
 {
  $username=$_SESSION['user'];
 //echo "User name :".$username;
 } else{
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
 <script type="text/javascript" src="js/ajax_captcha.js"></script>
 <script type="text/javascript" src="js/pricemastervalidation.js"></script>
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
  function showdiv()
  {
   document.getElementById('discountnmdiv').style.display="block";
   document.getElementById('discountdiv').style.display="block";
  }
  function hidediv()
  {
   document.getElementById('discountnmdiv').style.display="none";
   document.getElementById('discountdiv').style.display="none";
   document.getElementById('txtprc_disprc').value= "";
  }
 </script>
</head>

<body class="twoColFixLtHdr">
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
      <div id="subsidebar4">Display
      <ul><li><a href="productdisplay.php">Product Master</a></li>
          <li><a href="pricedisplay.php">Price Master</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="logout.php" onclick="isConfirmlog();" >Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Price Master</div>
      <div id="middletxt1">
        <p>Please enter the details of  Price products here.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_price" id="frm_price" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Price Master</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
                  </tr>
                  <input type="hidden" name="username1" id="username1" value="" />
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Product Id : </strong></div></td>
                    <td><select name="selpid" id="selpid" style="width:180px;">
                        <option value="selpid">- Select Product ID -</option>
                        <?php
                        $get_pid= @mysql_query("SELECT prd_id FROM t_product_mst WHERE username= '$username' ")or die(mysql_error());
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
                    <td><div align="right"><strong><font color="#FF0000">*</font> Actual Price Of Product : </strong></div></td>
                    <td width="128"><input type="textbox" name="txtprc_actprc" id="txtprc_actprc" maxlength="30" style="width:176px;"
                                      value="" 
                                      onchange="document.getElementById('txtprc_actprc').value=trim(this.value);"/></td>
                  </tr>
                  <tr>
                    <td height="22"><div align="right"><font color="#FF0000">*</font><strong> Discount : </strong></div></td>
                    <td colspan="4"><input type="radio" name="rdo_ses" id="rdoyes" value="Yes" onclick="showdiv();" />Yes
                      <input type="radio" name="rdo_ses" id="rdono" value="No" onclick="hidediv();" />No</td>
                  </tr>
                  <tr><td><div id="discountnmdiv" style="display:none;" >
                    <div align="right"><font color="#FF0000">*</font><strong> Discounted Price Of Product : </strong></div></div></td>
                    <td width="128"><div id="discountdiv" style="display:none;" ><input type="textbox" name="txtprc_disprc" id="txtprc_disprc" maxlength="30" style="width:176px;"
                                      value=""
                                      onchange="document.getElementById('txtprc_disprc').value=trim(this.value);"/></div></td>
                  </tr>                 
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <input type="hidden" name="img_name2" id="img_name2" />
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;
                      <input type="submit" id="submitMain" name="submitMain" value="Submit" Onclick="return done(this.form);" > 
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
   $pid=$_POST['selpid'];
   $pact=$_POST['txtprc_actprc'];
   $pdis=$_POST['txtprc_disprc'];
   $pcurrency=$_POST['selcury'];
   $pdiscount=$_POST['rdo_ses'];
   $psdate=$_POST['txt_sdate'];
   $pedate=$_POST['txt_edate'];
   
    $get=mysql_query("select * from t_price_mst where username='$username' AND prd_id = '$pid' ");
    if(mysql_num_rows($get)==0)
    {
     $query = mysql_query("INSERT INTO t_price_mst(username,prd_id,price_actual,price_discount,price_discount_type)
                          VALUES ('$username','$pid','$pact','$pdis','$pdiscount')")
                          or die(mysql_error());
      echo "<script>alert('Price Details inserted sucessfully !!');</script>";
    } else {
     $query = mysql_query("UPDATE t_price_mst SET price_actual='$pact',price_discount='$pdis',price_discount_type='$pdiscount'
                          WHERE username='$username' AND prd_id='$pid'  ")
                          or die(mysql_error());
      echo "<script>alert('Price Details Updated sucessfully !!');</script>";
    }
  }
 ?>
  
</body>
</html>