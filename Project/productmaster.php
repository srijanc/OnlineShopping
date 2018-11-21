<?php   
 session_start();
 include("config/config.php");
 //echo "User".$_SESSION['user'];
 if(isset($_SESSION['user']))
 {
  $username=$_SESSION['user'];
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
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/count.js"></script>
 <script type="text/javascript" src="js/ajax_captcha.js"></script>
 <script type="text/javascript" src="js/productmaster.js"></script>
 <script type="text/javascript" src="js/productmastervalidation.js"></script>
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
  function charcount()
  {
   document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft1'>   200 </span>";
   document.getElementById('static1').innerHTML = "Characters Remaining:  <span  id='charsLeft2'>   300 </span>";   
   document.getElementById('static2').innerHTML = "Characters Remaining:  <span  id='charsLeft3'>   500 </span>";
   document.getElementById('static3').innerHTML = "Characters Remaining:  <span  id='charsLeft4'>   100 </span>";   
  }
 // to display sub category function
  function showdiv()
  {
   document.getElementById('subcat1nmdiv').style.display="block";
   document.getElementById('subcat1div').style.display="block";
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
      <div id="subsidebar2"><a href="loghome.php">Home</a>
      </div>
      <div id="subsidebar2"><a href="pricemaster.php">Price Master</a>
      </div>
      <div id="subsidebar4">Display
      <ul><li><a href="productdisplay.php">Product Master</a></li>
          <li><a href="pricedisplay.php">Price Master</a></li></ul>
      </div>
      <div id="subsidebar2"><a href="logout.php">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Product Master</div>
      <div id="middletxt1">
        <p>Please enter the details of  products here.</p>
      </div>
      </div>
      <div id="middletxt">
        <form action="" method="post" name="frm_prd" id="frm_prd" enctype="multipart/form-data">
          <table width="100%" border=0>
            <tr>
              <td height="22"><table width="100%" border=0>
                  <tr>
                    <th colspan="5" id="formhedear">Product Master</th>
                  </tr>
                  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Mandatory	Fields &nbsp; </span></div></td>
                  </tr>
                  <input type="hidden" name="username" id="username" value="" />
                  <tr>
                    <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>Product Id : </strong></div></td>
                    <td width="128"><input type="textbox" name="txtprd_id" id="txtprd_id" maxlength="10"  value="" style="width:176px;"
                                           onChange="PrdIDCheckAvail(this.value);document.getElementById('txtprd_id').value=trim(this.value);"/>
                     <span name="pidChange" id="pidChange" style="color:red;">&nbsp;</span></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font>Product Name : </strong></div></td>
                    <td width="128"><input type="textbox" name="txtprd_sname" id="txtprd_sname"  value="" maxlength="30" style="width:176px;"
                                      onchange="document.getElementById('txtprd_sname').value=trim(this.value);"/></td>
                  </tr>
                  <tr>
                  
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Product Image : </strong></div></td>
                    <td><input type="file" name="fileimage" id="fileimage" maxlength="50" value="" style="width:176px;"
                          onchange=" document.getElementById('fileimage').value=trim(this.value);"/>
                          <div class="example">  Image Size Should not Exceed 350000bytes.</div></td>
                  </tr>
                               
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Quantity Available : </strong></div></td>
                    <td><input type="textbox" name="txtqty" id="txtqty" maxlength="10" value="" style="width:176px;"
                            onchange=" document.getElementById('txtqty').value=trim(this.value);"/></td>
                  </tr>
                   <tr>
                    <td><div align="right"><span class="req"><strong></strong></span><strong>Product Color : </strong></div></td>
                    <td><input type="textbox" name="txtclr" id="txtclr" maxlength="50" value="" style="width:176px;"
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
                    <td><input type="textbox" name="txtbrnd" id="txtbrnd" maxlength="20" value="" style="width:176px;"
                                         onchange=" document.getElementById('txtbrnd').value=trim(this.value);"/></td>
                  </tr>
                   <tr>
                    <td><div align="right"><strong><font color="#FF0000">*</font>Product Features :</strong></div>
                      <p align="right" class="example">(Maximum 200 characters) </p></td>
                      <td colspan="4"><textarea name="tafeatures" id="tafeatures" wrap="physical" cols="45" rows="5" title="Product features Should not excide 200 characters !!"
                                       onchange=" document.getElementById('tafeatures').value=trim(this.value);"></textarea><br>
                                    Characters Remaining: <span id="charsLeft1">200</span>
                    </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Category : </strong></div></td>
                    <td><select name="selprdcat" id="selprdcat" style="width:180px;" onchange="showdiv();displaysubcat(this.value);">
                        <option value="selprdcat">Select Category</option>
                        <?php
                        $get_catgry=mysql_query("SELECT DISTINCT cat_category FROM t_category_mst")or die(mysql_error());
                        $num_cat=mysql_num_rows($get_catgry);
                        for($i=0;$i<$num_cat;$i++)
                        {
                         $cat_category=mysql_result($get_catgry,$i,'cat_category');
                        ?>
			 <option value="<?php echo $cat_category;?>"><?php echo $cat_category;?></option>
                        <?php
                        }
                        ?>
                      </select></td>
                 
                    <td colspan="3" class="formInfo">&nbsp;</td>
                  </tr>
                   
                  <tr>
                    <td height="22"><div align="right"><strong><font color="#FF0000">*</font>Product Status : </strong></div></td>
                    <td colspan="4"><input type="radio" name="rdostatus" id="rdoactive" value="Available" />Active
                      <input type="radio" name="rdostatus" id="rdoinactive" value="Unavailable" checked />Inactive</td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Mode of Delivery  : </strong></div></td>
                    <td><select name="selmode" id="selmode" style="width:180px;">
                        <option value="selmode">Select Mode of Deliver</option>
			<option value="Road Way">Road Way</option>
                        <option value="Air way">Air way</option>
                        <option value="Hand deliver">Hand delivery</option>
			<option value="Courier">Courier</option>
                      </select>    </td>
                  </tr>
                  <tr>
                    <td><div align="right"><span class="req"><strong><font color="#FF0000">*</font></strong></span><strong>Delivery Lead Time : </strong></div></td>
                    <td><input type="textbox" name="txtleadtime" id="txtleadtime" maxlength="20" value="" style="width:176px;"
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
   $photo = mysql_query ("SELECT MAX(row_id) FROM t_product_mst");
   $photoid = mysql_result($photo,0,'max(row_id)')+1;
  ?>
  <!-- Upload of image section -->
  <?php
   // function to get the characters after .!!
   function getExtension($str)
  {
   $i = strrpos($str,".");
   if (!$i)
   {
     return "";
   }
   $len = strlen($str) - $i;
   $ext = substr($str,$i+1,$len);
   return $ext;
  }
   if ($_SERVER["REQUEST_METHOD"] == "POST")
   {
   $image=$_FILES['fileimage']['name'];
   
   if (isset ($_FILES['fileimage']['name']))
   {   
     $imagename = $_FILES['fileimage']['name']; //original image
     $source = $_FILES['fileimage']['tmp_name']; //source image 
     $type=$_FILES['fileimage']['type'];
     $size=$_FILES['fileimage']['size'];
     if ($size > 350000){
       echo "<script>alert('Size should not excide 350000bytes !!');</script>";
     }
     else
     {
     $extension = getExtension($imagename);
     $extension = strtolower($extension);
     if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") ) 
 	{
          // if file extension is not .jpg, .jpeg, .png, .gif
          echo "<script>alert('Image Extenction Should be .jpg, .jpeg, .png, .gif only !!');</script>";
        } else {
          $target = "images/products/$photoid._".$photoid.".jpg";
          move_uploaded_file($source, $target);
          

          //$imagepath = $imagename;
          $save =  "images/products/$photoid._".$photoid.".jpg"; //This is the new file you saving
          $file =  "images/products/$photoid._".$photoid.".jpg"; //This is the original file

          list($width, $height) = getimagesize($file) ; 

          $tn = imagecreatetruecolor($width, $height) ; 
          $image = imagecreatefromjpeg($file) ; 
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

          imagejpeg($tn, $save, 200) ; 

          $save =  "images/products/" .$photoid.".jpg"; //This is the new file you saving
          $file = "images/products/$photoid._".$photoid.".jpg"; //This is the original file

          list($width, $height) = getimagesize($file) ; 

          $modwidth = 150; 
          $modheight = 140; 
          $tn = imagecreatetruecolor($modwidth, $modheight) ; 
          $image = imagecreatefromjpeg($file) ; 
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

          imagejpeg($tn, $save, 200) ; 
          $imageval=$photoid.".jpg";
          unlink("images/products/$photoid._".$photoid.".jpg");
          }
     }
}
}
?>
<!-- Code for inserting into data base -->
 <?php
  if(isset($_POST['submitMain']) && ($size < 350000) && !$imageval=="")
  {
   //getting the values !!
   $username=$_SESSION['user'];
   $pid=$_POST['txtprd_id'];
   $psname=$_POST['txtprd_sname'];
   $pimg=$imageval; // after renaming
   $pqty=$_POST['txtqty'];
   $pcolor=$_POST['txtclr'];
   $pbrand=$_POST['txtbrnd'];
   $pfeatures=$_POST['tafeatures'];
   $pcat=$_POST['selprdcat'];
   $pstatus=$_POST['rdostatus'];
   $pdel=$_POST['selmode'];
   $pdlead=$_POST['txtleadtime'];
      
   $query = mysql_query("INSERT INTO t_product_mst
    (username,prd_id,prd_sname,prd_photo,prd_qty,prd_color,prd_brand,prd_feature,prd_cat,prd_status,prd_delivery_mode,prd_delivery_leadtime)
    VALUES ('$username','$pid','$psname','$pimg','$pqty','$pcolor','$pbrand','$pfeatures','$pcat','$pstatus','$pdel','$pdlead')")
    or die(mysql_error());
    echo "<script>alert('Product Details inserted sucessfully !!');</script>";
  }
?>
</body>
</html>