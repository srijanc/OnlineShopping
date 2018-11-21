<?php   
 session_start();
 include("config/config.php");
 if($_GET['prid']=="")
 {
 ?>
  <script>
  //alert('<?php echo $_GET['prid']; ?>');
  alert('Please select the product to delete');
  alert(window.location='http://localhost/rishi/productdisplay.php');
  </script>
 <?php
 }
 if(isset($_SESSION['user']))
 {
  $username=$_SESSION['user'];
  $pid=$_GET['prid'];
 //echo "User name :".$username;
 //echo "pid : ".$pid;
 }
 $status=@mysql_result(@mysql_query("SELECT ord_deliverystatus FROM t_orders_trn WHERE username='$username' AND prd_id='$pid'"),0,'ord_deliverystatus');
 if($status=='Waiting')
 {
  echo "<script>alert('Product Cannot be deleted Until it is Delivered !!');</script>";
  echo "<script>window.location='productdisplay.php';</script>";
 } else {
  $img1= @mysql_query("SELECT prd_photo from t_product_mst WHERE username='$username' AND prd_id='$pid' ") or die(mysql_error());
  $imgdel=@mysql_result($img1,'prd_photo');
  $imgdel1='images/products/'.$imgdel.'';
  unlink($imgdel1);
  
  $del = mysql_query("DELETE from t_product_mst WHERE username='$username' AND prd_id='$pid' ") or die(mysql_error());
  $del1 = mysql_query("DELETE from t_price_mst WHERE username='$username' AND prd_id='$pid' ") or die(mysql_error());
  
  if(mysql_affected_rows()==0){
  echo "<script>alert('Product Deletion Failed !!');</script>";
  echo "<script>window.location='productdisplay.php';</script>";
  } else {
  echo "<script>alert('Product Deleted Sucessfully !!');</script>";
  echo "<script>window.location='productdisplay.php';</script>";
  }
 } 
 ?>