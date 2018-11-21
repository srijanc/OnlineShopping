<?php
 session_start();
 include("config/config.php");
 if($_GET['prid']==""){ ?>
   <script>
   alert('Select the product');
   alert(window.location='productdisplay.php');
 </script>
 <?php
 }
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
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/count.js"></script>
 <script type="text/javascript" src="js/ajax_captcha.js"></script>
 <script type="text/javascript" src="js/productmaster.js"></script>
 <script type="text/javascript" src="js/producteditvalidation.js"></script>
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
 function del()
 {
  var r = confirm('Are you sure you want to Delete this product ??');
  if(!r)
  {
   return false;
  }
  else
  {
  alert(window.location='delete.php');
  }
 }
 function charcount()
 {
  document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft1'>   200 </span>";
  document.getElementById('static1').innerHTML = "Characters Remaining:  <span  id='charsLeft2'>   300 </span>";   
  document.getElementById('static2').innerHTML = "Characters Remaining:  <span  id='charsLeft3'>   500 </span>";
  document.getElementById('static3').innerHTML = "Characters Remaining:  <span  id='charsLeft4'>   100 </span>";   
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
        <p>Please Edit the details of  products here.</p>
      </div>
      </div>
 <?php
  $get= @mysql_query("SELECT * FROM t_product_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
  $num = @mysql_num_rows($get);
  for($i=0;$i<$num;$i++)
  {
   //$row= @mysql_result($get,$i,'row_id');
   $prid= @mysql_result($get,$i,'prd_id');
   $psname= @mysql_result($get,$i,'prd_sname');
   //$plname= @mysql_result($get,$i,'prd_lname');
   $pimg= @mysql_result($get,$i,'prd_photo');
   //$psize= @mysql_result($get,$i,'prd_size');
   //$puom= @mysql_result($get,$i,'prd_uom');
   $pqty= @mysql_result($get,$i,'prd_qty');
   $pcolor= @mysql_result($get,$i,'prd_color');
   $pbrand= @mysql_result($get,$i,'prd_brand');
   $pfeatures= @mysql_result($get,$i,'prd_feature');
   $pcat= @mysql_result($get,$i,'prd_cat');
   //$psubcat= @mysql_result($get,$i,'prd_sub_cat');
   //$psdis= @mysql_result($get,$i,'prd_sdis');
   //$pldis= @mysql_result($get,$i,'prd_ldis');
   //$pqtyavb= @mysql_result($get,$i,'prd_qtyavb');
   $pstatus= @mysql_result($get,$i,'prd_status');
   $pdel= @mysql_result($get,$i,'prd_delivery_mode');
   $pdlead= @mysql_result($get,$i,'prd_delivery_leadtime');
   //$psep= @mysql_result($get,$i,'prd_sep');
  }
 ?>
      <div id="middletxt">
        <form action="" method="post" name="frm_prd_edit" id="frm_prd_edit" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Edit Product Details.</th>
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
                    <td><div align="right"><strong><font color="#FF0000">*</font>Product Short Name : </strong></div></td>
                    <td width="128"><input type="textbox" name="txtprd_sname" id="txtprd_sname"  value="<?php echo $psname; ?>" maxlength="30" style="width:176px;"
                                      onchange="document.getElementById('txtprd_sname').value=trim(this.value);"/></td>
                  </tr>
                  <tr>
                  
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Product Image : </strong></div></td>
                    <td colspan="4"><p><img id="img" src="images/products/<?php echo $pimg; ?>" /></p>
                      <a onclick="javascript:window.open('imageedit.php?prid=<?php echo $prid; ?>&username=<?php echo $username; ?>','newWin','width=500,height=300');" ><b>Change Product Image ? Click Here</b></a> </td>
                  </tr>
                  
                  
                  <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong><font color="#FF0000">*</font>Quantity Available : </strong></div></td>
                           <td><input type="textbox" name="txtqty" id="txtqtyavbl" maxlength="10" value="<?php echo $pqty;?>" style="width:176px;"
                                         onchange=" document.getElementById('txtqty').value=trim(this.value);"/></td>
                  </tr>
                   <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong>Product Color : </strong></div></td>
                    <td><input type="textbox" name="txtclr" id="txtclr" maxlength="50" value="<?php echo $pcolor; ?>" style="width:176px;"
                                       onchange=" document.getElementById('txtclr').value=trim(this.value);"/></td>
                  </tr>
                   <tr>
                    <td><div align="right"></div></td>
                    <td colspan="2"><div class="example">Multiple colors should be separated by ( , )</div></td>
                    <td width="170" class="formInfo">&nbsp;</td>
                    <td width="69">&nbsp;</td>
                  </tr>
                   <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong>Product Brand : </strong></div></td>
                    <td><input type="textbox" name="txtbrnd" id="txtbrnd" maxlength="50" value="<?php echo $pbrand; ?>" style="width:176px;"
                                         onchange=" document.getElementById('txtbrnd').value=trim(this.value);"/></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong><span class="req"><strong><font color="#FF0000">*</font></strong></span>Product Features :</strong></div>
                      <p align="right" class="example">(Maximum 200 characters) </p></td>
                      <td colspan="4"><textarea name="tafeatures" id="tafeatures" wrap="physical" cols="45" rows="5" title="Product features Should no excide 200 characters !!"
                                       onchange=" document.getElementById('tafeatures').value=trim(this.value);"><?php echo $pfeatures; ?></textarea><br>
                                    Characters Remaining: <span id="charsLeft1"></span></td>
				   </tr> 
                   <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Category : </strong></div></td>
                    <td width="100"><input type="textbox" name="txt" id="txt"  value="<?php echo $pcat; ?>" maxlength="30" style="width:176px;" READONLY></td>
                    <td><select name="selprdcat" id="selprdcat" style="width:180px;" onchange="displaysubcat(this.value);">
                        <option value="selprdcat">Select Category </option>
                        <?php
			//$sel="none";
                        $get_catgry=mysql_query("SELECT DISTINCT cat_category FROM t_category_mst ")or die(mysql_error());
                        $num_cat=mysql_num_rows($get_catgry);
                        for($i=0;$i<$num_cat;$i++)
                        {
                         $cat_category=mysql_result($get_catgry,$i,'cat_category');
                        ?>
			 <option value="<?php echo $cat_category;?>" <?php //echo $sel; ?>><?php echo $cat_category;?></option>
                        <?php
                        }
                        ?>
                      
                  </tr>
                  
                  <tr>
                    <td height="22"><div align="right"><strong><font color="#FF0000">*</font>Product Status : </strong></div></td>
                    <td colspan="4">
		     <?php
		       if($pstatus == 'Available')
		       { ?>
		     <input type="radio" name="rdostatus" id="rdoactive" value="Available"  checked/>Active
                     <input type="radio" name="rdostatus" id="rdoinactive" value="Unavailable"/>Inactive</td>
		     <?php } else {  ?>
		     <input type="radio" name="rdostatus" id="rdoactive" value="Available"/>Active
                      <input type="radio" name="rdostatus" id="rdoinactive" value="Unavailable" checked />Inactive</td>
		      <?php } ?>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Mode of Delivery  : </strong></div></td>
                 	<td><select name="selmode" id="selmode" style="width:180px;">
                        <option value="selmode">Select Mode of Deliver</option>
			<option value="Road Way" <?php if($pdel=="Road Way") echo "selected"; ?>>Road Way</option>
                        <option value="Air way" <?php if($pdel=="Air way") echo "selected"; ?>>Air way</option>
                        <option value="Hand deliver" <?php if($pdel=="Hand deliver") echo "selected"; ?>>Hand Delivery</option>
			<option value="Courier" <?php if($pdel == "Courier") echo "selected"; ?>>Courier</option>
                      </select>    </td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Delivery Lead Time : </strong></div></td>
                    <td><input type="textbox" name="txtleadtime" id="txtleadtime" maxlength="20" value="<?php echo $pdlead; ?>" style="width:176px;"
                                         onchange=" document.getElementById('txtleadtime').value=trim(this.value);"/>
		        <p class="example">(Should be in no of days) </p></td>
                  </tr>
                                    
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <input type="hidden" name="img_name2" id="img_name2" />
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
                      <input type="submit" id="submitMain" name="submitMain" value="Update" Onclick="return done(this.form);" > 
                      &nbsp;&nbsp;&nbsp;
                      <input type="reset" name="reset" id="reset">
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
   //getting the values !!
   $username=$_SESSION['user'];
   $pid=$_POST['txtprd_id'];
   //$psname=$_POST['txtprd_sname'];
   //$plname=$_POST['txtprd_lname'];
   //$psize=$_POST['txtsize'];
   //$puom=$_POST['seluom'];
   $pqty=$_POST['txtqty'];
   $pcolor=$_POST['txtclr'];
   $pbrand=$_POST['txtbrnd'];
   $pfeatures=$_POST['tafeatures'];
   $pcat=$_POST['selprdcat'];
   //$psubcat=$_POST['selsubcat'];
   //$psdis=$_POST['tasrtdcpn'];
   //$pldis=$_POST['talngdcpn'];
   //$pqtyavb=$_POST['txtqtyavbl'];
   $pstatus=$_POST['rdostatus'];
   $pdel=$_POST['selmode'];
   $pdlead=$_POST['txtleadtime'];
   //$psep=$_POST['tasep'];
 
   $query = mysql_query("UPDATE t_product_mst
			SET prd_sname='$psname',prd_qty='$pqty',prd_color='$pcolor',prd_brand='$pbrand',prd_feature='$pfeatures',prd_cat='$pcat',prd_status='$pstatus',
			prd_delivery_mode='$pdel',prd_delivery_leadtime='$pdlead',' WHERE username='$username' AND prd_id='$pid'")
			or die(mysql_error());

   echo "<script>alert('Product Details Updated sucessfully !!');</script>";
   echo "<script>window.location='productdisplay.php'</script>";
  }
 ?>

</body>
</html>