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
 function done()
 {
  if(document.getElementById("selpid").value === "selpid")
  {
   alert("Select Product ID !!");
   document.getElementById("selpid").focus();
   return false;
  }
 }
 function hidediv()
 {
  document.getElementById('hideimg').style.display="none";
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
                    <th colspan="5" id="formhedear">Product Master Display Page.</th>
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
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Display" Onclick="return done(this.form);hidediv();" />
                 &nbsp;&nbsp;&nbsp;
                 </td>
              </tr>
              </table>
        </form>
      </div>
      </div>

 <?php
   if($_POST['submitMain'])
   {
    $pid=$_POST['selpid'];
    $get= @mysql_query("SELECT * FROM t_product_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
    $num = @mysql_num_rows($get);
    for($i=0;$i<$num;$i++)
    {
     $prid= @mysql_result($get,$i,'prd_id');
     $psname= @mysql_result($get,$i,'prd_sname');
     $pimg= @mysql_result($get,$i,'prd_photo');
     $pqty= @mysql_result($get,$i,'prd_qty');
     $pcolor= @mysql_result($get,$i,'prd_color');
     $pbrand= @mysql_result($get,$i,'prd_brand');
     $pfeatures= @mysql_result($get,$i,'prd_feature');
     $pcat= @mysql_result($get,$i,'prd_cat');
     $pstatus= @mysql_result($get,$i,'prd_status');
     $pdel= @mysql_result($get,$i,'prd_delivery_mode');
     $pdlead= @mysql_result($get,$i,'prd_delivery_leadtime');
     }
   }
 ?>
      <div id="middletxt">
        <form action="" method="post" name="frm_prd_disp" id="frm_prd_disp" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Product Details.</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory Fields&nbsp;&nbsp; </span></div></td>
                  </tr>
                  <input type="hidden" name="username" id="username" value="" />
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Product Id : </strong></div></td>
                    <td><?php echo $prid; ?></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font>Product Name : </strong></div></td>
                    <td><?php echo $psname; ?></td>
                  </tr>
                  <tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Product Image : </strong></div></td>
                    <td colspan="4"><p><img id="imgCaptcha" src="images/products/<?php echo $pimg; ?>" /></p></td>
                  </tr>
                  
                  <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong><font color="#FF0000">*</font>Quantity Available : </strong></div></td>
                     <td><?php echo $pqty; ?></td>
                  </tr>
                   <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong>Product Color : </strong></div></td>
                     <td><?php echo $pcolor; ?></td>
                  </tr>
                   <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong>Product Brand : </strong></div></td>
                     <td><?php echo $pbrand; ?></td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Product Features :</strong></div>
                    <td><p align="center"><?php echo $pfeatures; ?></p></td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Category : </strong></div></td>
                     <td><?php echo $pcat; ?></td>
                  </tr>
                                  
                  <tr>
                    <td height="22"><div align="right"><strong><font color="#FF0000">*</font>Product Status : </strong></div></td>
                     <td><?php echo $pstatus; ?></td>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Mode of Delivery  : </strong></div></td>
                     <td><?php echo $pdel; ?></td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Delivery Lead Time : </strong></div></td>
                     <td><?php echo $pdlead; ?>-days</td>
                  </tr>
                  
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" >&nbsp;&nbsp;&nbsp;<!--Onclick="return done(this.form);"-->
                      <a href="productedit.php?prid=<?php echo $prid; ?>"><input type="button" id="btnedit" name="btnedit" value="Edit"></a>
                      &nbsp;&nbsp;&nbsp;
                      <input type="button" id="btndelete" name="btndelete" value="Delete"  onclick="del();" /></td>
                  </tr>
                  <script>
                   function del() {
                   var r = confirm('Are you sure you want to Delete this product ??');
                    if(!r){
                    return false;
                    }
                    else
                    {
                     window.location="delete.php?prid=<?php echo $prid; ?>";
                    }
                    }
                  </script>
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