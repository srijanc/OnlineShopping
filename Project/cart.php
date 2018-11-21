<?php
  session_start();
  if(isset($_SESSION['sid']))
  {
    $sid=$_SESSION['sid'];
  }
  include("config/config.php");
    $username=base64_decode($_GET['un']); 
    $count=@mysql_query("SELECT * from t_cart_temp WHERE username='$username' AND s_id='$sid'");
    $pcount=@mysql_num_rows($count);
    //echo "Product Count".$pcount;
   if($_GET['un']=="" || $pcount == 0 ){ ?>
   <script>
   alert('You have not added any products to cart  !!');
   window.location='Main.php?un=<?php echo base64_encode($username);?>';
 </script>
 <?php
 } else {
  $username=base64_decode($_GET['un']); 
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Shopping</title>
<link href="css/Webpage.css" rel="stylesheet" type="text/css" />
<link href="css/flyout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/cart.js"></script>
<script type="text/javascript" src="js/flyout.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/count.js"></script>
<script type="text/javascript" src="js/ajax_captcha.js"></script>
<script type="text/javascript" src="js/cartvalidation.js"></script>
<style type="text/css" media="all">
@import "Webpage.css";
</style>
<script language="javascript">
  function charcount()
 {
  document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft1'>   100 </span>";
  document.getElementById('static').innerHTML = "Characters Remaining:  <span  id='charsLeft2'>   100 </span>";
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
      <div id="subsidebar3"> Cart Page</div>
      <div id="subsidebar2"><a href="Main.php?un=<?php echo base64_encode($username);?>"><b>Continue Shopping</b></a></div>
       <div align="center"><img src="images/cart.jpg" alt="Online Shopping" width="180" height="200" /> </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Shopping Cart</div>
      <div id="middletxt1">
      <div align="left"><img src="images/Welcome.jpg" alt="Online Shopping" width="600" height="150" /> </div>
      </div>
      </div>
      <div id="middletxt">
       <div id="middletxtheader">Cart Items</div>
        <!-- end #middletxt -->
	<form name="frm_cart" id="frm_cart" method="post" action="">
        <table border="1" cellpadding="0" cellspacing="0" width="685" height="300">
	<!-- MSTableType="layout" -->
<?php
     $get= @mysql_query("SELECT * FROM t_cart_temp WHERE username='$username' AND s_id='$sid'")or die(mysql_error());
     $num = @mysql_num_rows($get);
	 $total=0.0;
     for($i=0;$i<$num;$i++)
     {
      $row= @mysql_result($get,$i,'row_id');
      $prid= @mysql_result($get,$i,'prd_id');
      $cname= @mysql_result($get,$i,'cart_name');
      $cimg= @mysql_result($get,$i,'cart_img');
      $cqty= @mysql_result($get,$i,'cart_qty');
      $cqtyordered= @mysql_result($get,$i,'cart_qtyordered');
      $cact= @mysql_result($get,$i,'cart_act');
      $cdis= @mysql_result($get,$i,'cart_dis');
      $cprice= @mysql_result($get,$i,'cart_price');
 ?>
 <tr>
    <td align="center" width="40"><input type="checkbox" name="chk<?php echo $i; ?>" id="chk<?php echo $i; ?>" value="<?php echo $prid; ?>">
    </td>
    <input type="hidden"  name="hdnrid<?php echo $i; ?>" id="hdnrid<?php echo $i; ?>" value="<?php echo $row; ?>"> 
    <td width="110"><p align="Center">Product Name<br/><?php echo $cname;?></td></p>
    <td><p align="center">
     <img id="" src="images/products/<?php echo $cimg; ?>" width=50 height=50 />
    </p></td>
    <td width="250"><p align="left">Minimum Quantity To order : <?php echo $cqty;?><br/>
	<?php echo "Quantity Ordered By you :".$cqtyordered."<br/>";?>
    </td>
    <td width="105"><p align="left">Price : <?php echo $cact;?> <br/>
	<?php if($cdis=="0.0") { } else {?>
	Discount : <?php echo $cdis;?> <br/>
	<?php } ?>
	Amount to pay : <?php echo $cprice; ?>
    </td>
 </tr>
 <?php
 $total+=$cprice;
  }
 ?>
 <tr>
  <td align="right" colspan="10"> <b>Total Amount To Pay : Rs  <?php echo $total; ?> </b></td>
 </tr>
 <tr>
  <td align="center" colspan="10">
  <a href="Main.php?un=<?php echo base64_encode($username);?>"><input type="button" name="btncontinue" id="btncontinue" value="Continue Shopping"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" name="btnremove" id="btnremove" value="Remove" onclick="return chkprdval();"></td>
 </tr>
</table>
</form>
<input type="hidden"  name="hdnprdnum" id="hdnprdnum" value="<?php echo $num; ?>"> 

<script language="javascript">
 function chkprdval()
 {
  var count=0;
  length=document.getElementById("hdnprdnum").value;
  //alert(length);
    for(j=0;j<length;j++)
  {
   //if(document.getElementById("chk[j]").checked)
   if(document.getElementById("chk"+j).checked)
    {
     count++;
    }
  }
  if(count==0)
  {
   alert("Please select Product to Remove");
   return false;
  }
 }

</script>
 
<div id="middletxtheader">Enter Your Information</div>
      <form name="frm_cust" id="frm_cust" action="" method="post">
        <table width="100%" border=0>
	  <tr>
                    <td height="34" colspan="2"></td>
                    <td colspan="3"><div align="right"><font color="#FF0000">*</font><span class="style3"> Required Fields  &nbsp; </span></div></td>
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
	      <td width="245" height="37"><div align="right"><strong><font color="#FF0000">*</font>E-mail ID: </strong></div></td>
                 <td width="128"><input type="textbox" name="txtsin_email" id="txtsin_email" maxlength="50" style="width:176px;"
                                   onChange="document.getElementById('txtsin_email').value=trim(this.value);"/></td>
	  </tr>
	  <tr>
                 <td><div align="right"><strong><font color="#FF0000">*</font>Billing Address :</strong></div>
                 <p align="right" class="example">(Maximum 100 characters) </p></td>
                 <td colspan="4"><textarea name="ta_badd" id="ta_badd" wrap="physical" cols="45" rows="5" title="Address Should no excide 100 characters !!"
                                  onchange=" document.getElementById('ta_badd').value=trim(this.value);"></textarea><br>
                                  Characters Remaining: <span id="charsLeft1">100</span>
          </tr>
         <tr>
	         <td></td>  
	  	 <td width="245" height="37"><div align="left"><input type="checkbox" name="chksame" id="chksame" value="yes"><strong>&nbsp;Same As above</strong></td>
	 </tr>
	  <tr>
                 <td><div align="right"><strong><font color="#FF0000">*</font>Shipping Address :</strong></div>
                 <p align="right" class="example">(Maximum 100 characters) </p></td>
                 <td colspan="4"><textarea name="ta_sadd" id="ta_sadd" wrap="physical" cols="45" rows="5" title="Address Should no excide 100 characters !!"
                                  onchange=" document.getElementById('ta_sadd').value=trim(this.value);"></textarea><br>
                                  Characters Remaining: <span id="charsLeft2">100</span>
          </tr>
	  
          <tr>
                 <td width="245" height="37"><div align="right"><strong>Mobile No : </strong></div></td>
                 <td width="128"><input  type="textbox" name="txtsin_mob" id="txtsin_mob" maxlength="10" style="width:120px;"
                                   onChange="document.getElementById('txtsin_mob').value=trim(this.value);"/></td>
          </tr>
          
	  
          <tr><br/>
          <td colspan="3" align="center"><input type="submit" name="subbuy" id="subbuy" value="Buy" style="width:100px;" onclick="return done(this.form);">
          </td>
          </tr>
        </table>
      </form>
      </div>
    </div>
    <!-- end #mainContent -->
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <div id="footer">
    © Copyright Srijan Vasu Vipul P. Limited
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</div>
 <?php
	if(isset($_POST['btnremove']))
        {
         for($b=0;$b<$num;$b++)
          {
	    if(isset($_POST['chk'.$b]))
	    {
	      $pid=$_POST['chk'.$b];
	      $r_id=$_POST['hdnrid'.$b];
              $del = mysql_query("DELETE from t_cart_temp WHERE username='$username' AND row_id='$r_id' AND prd_id='$pid' AND s_id='$sid'") or die(mysql_error());
	    }
	  }  
	     $count=@mysql_query("SELECT * from t_cart_temp WHERE username='$username' AND s_id='$sid'");
             $pcount=@mysql_num_rows($count);
	     //echo "ppppp".$pcount;
	     $un=base64_encode($username);
	     if($pcount == 0) {
                echo "<script>alert('Product Removed From Cart !!');</script>";
                echo "<script>window.location='Main.php?un=$un'</script>";
	      } else {
                echo "<script>alert('Products Removed From Cart !!');</script>";
                echo "<script>window.location='cart.php?un=$un'</script>";
	      }
	}
        if(isset($_POST['subbuy']))
        {
		 $fname=$_POST['txtsin_fname'];
		 $lname=$_POST['txtsin_lname'];
		 $mail=$_POST['txtsin_email'];
		 $badd=$_POST['ta_badd'];
		 if($_POST['chksame']=="yes")
		 {
		  $sadd=$_POST['ta_badd'];
		 }
		 else
		 {
		  $sadd=$_POST['ta_sadd'];
		 }
		 $country=$_POST['selcountry'];
		 $mob=$_POST['txtsin_mobcode']."-".$_POST['txtsin_mob'];
                 $phone=$_POST['txtsin_phcode']."-".$_POST['txtsin_pharea']."-".$_POST['txtsin_phone'];
          $odate=date("d-m-Y");
	  $status='Waiting';
	 for($i=0;$i<$num;$i++)
          {
	   $row= @mysql_result($get,$i,'row_id');
     	   $prid= @mysql_result($get,$i,'prd_id');
           $cname= @mysql_result($get,$i,'cart_name');
           $cimg= @mysql_result($get,$i,'cart_img');
           $cqty= @mysql_result($get,$i,'cart_qty');
           $cqtyavb= @mysql_result($get,$i,'cart_qtyavb');
           $cqtyordered= @mysql_result($get,$i,'cart_qtyordered');
           $cact= @mysql_result($get,$i,'cart_act');
           $cdis= @mysql_result($get,$i,'cart_dis');
           $cprice= @mysql_result($get,$i,'cart_price');
	   $total += $cprice;
	   $lead= @mysql_result(@mysql_query("SELECT prd_delivery_leadtime FROM t_product_mst WHERE username='$username' AND prd_id='$prid'"),0,'prd_delivery_leadtime');
	   $qtyavb=@mysql_result(@mysql_query("SELECT prd_qtyavb FROM t_product_mst WHERE username='$username' AND prd_id='$prid'"),0,'prd_qtyavb');
	   $minqty=@mysql_result(@mysql_query("SELECT prd_qty FROM t_product_mst WHERE username='$username' AND prd_id='$prid'"),0,'prd_qty');
	   $pname=@mysql_result(@mysql_query("SELECT prd_lname FROM t_product_mst WHERE username='$username' AND prd_id='$prid'"),0,'prd_lname');
           $allproducts = $allproducts." , ".$pname;
           //echo $allproducts;
	   $ddate = strtotime(date("d-m-Y",strtotime($odate))."+ $lead day");
	   $ddate=date("d-m-Y",$ddate);
	   $qtyavb = $qtyavb - $cqtyordered;
	   if($qtyavb == 0 || $minqty > $qtyavb )
	   {
	   $prdupdate=@mysql_query("UPDATE t_product_mst SET prd_qtyavb='$qtyavb',prd_status='Unavailable' WHERE username='$username' AND prd_id='$prid'");
          // mail() for product stock empty
           $to = @mysql_result(@mysql_query("SELECT log_email FROM t_custreg_mst WHERE username='$username'"),0,'log_email');
           $subject = 'Stock Report';
           $from = 'onlineshopping@rishisys.com';
           $message = 'Hello <br> Your Product ID'.$prid.' <br> Stock has been Empty <br> Thanking you .';
           $header = 'From : < '.$from.' >';
          // echo $message;
           ini_set('sendmail_from','onlineshopping@mymailmail.com');
           if(mail($to,$subject,$message,"From: <{$email}> ")){
             echo "<script>alert('Mail sent')</script>";
	     } else {
              echo "<script>alert('Mail send failure - message not sent')</script>";
	     }
	   } else
	   {
	    $prdupdate=@mysql_query("UPDATE t_product_mst SET prd_qtyavb='$qtyavb' WHERE username='$username' AND prd_id='$prid'");
	   }
	   $query = mysql_query("INSERT INTO t_orders_trn (prd_id,username,ord_pname,ord_qty,ord_price,ord_fname,ord_lname,ord_odate,ord_ddate,ord_email,ord_baddress,ord_saddress,ord_mobile,ord_deliverystatus)
                      VALUES ('$prid','$username','$pname','$cqtyordered','$cprice','$fname','$lname','$odate','$ddate','$mail','$badd','$sadd','$mob','$status')") or die(mysql_error());
           $del = mysql_query("DELETE from t_cart_temp WHERE username='$username' AND row_id='$row' ") or die(mysql_error());
	  }
	  // mail(); for vendors
           $to = @mysql_result(@mysql_query("SELECT log_email FROM t_custreg_mst WHERE username='$username'"),0,'log_email');
           $subject = 'You have an Order';
           $from = 'onlineshopping@rishisys.com';
           $message = 'Hello <br> You have an Order for products '.$allproducts.' <br> Please login to your account for more details. <br> Thanking you .';
           $header = 'From : < '.$from.' >';
           //echo $message;
           ini_set('sendmail_from','onlineshopping@mymailmail.com');
           if(mail($to,$subject,$message,"From: <{$email}> ")){
             echo "<script>alert('Mail sent')</script>";
	     } else {
              echo "<script>alert('Mail send failure - message not sent')</script>";
	     }
  	  // mail(); for Customer
           $to = $mail;
           $subject = 'Your order';
           $from = 'onlineshopping@rishisys.com';
           $message = 'Hello <br> Your you have ordered for this products '.$allproducts.' <br> Total amount is '.$total.' <br> Thanking you <br> Visit Again!! .';
           $header = 'From : < '.$from.' >';
          // echo $message;
           ini_set('sendmail_from','onlineshopping@mymailmail.com');
           if(mail($to,$subject,$message,"From: <{$email}> ")){
             echo "<script>alert('Mail sent')</script>";
	     } else {
              echo "<script>alert('Mail send failure - message not sent')</script>";
	     }
	     $un=base64_encode($username);
 	 echo "<script>alert('Thank You For Shopping !!');</script>";
         echo "<script>window.location='cartdisplay.php?un=$un'</script>";
	}
  ?>
</body>
</html>