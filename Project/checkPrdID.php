<?php
  session_start();
  include("config/config.php");
  
   $username=$_SESSION['user'];
   $pid=$_REQUEST['pid'];
  //echo "user : ". $username;
  $get_pid= @mysql_query("SELECT * FROM t_product_mst WHERE username='$username' AND prd_id='$pid' ");

   //$get_pid= @mysql_query("SELECT * FROM t_product_mst WHERE prd_id='$pid' ");
   $num_rows=mysql_num_rows($get_pid);
?>
    <input type="hidden" name="noofrows" id="noofrows" value="<?php echo $num_rows; ?>" />
<?php
 if($num_rows>0 && $pid!=""){
    echo "Product ID Already Exists"; 
    }
 if($num_rows==0 && $pid!=""){
    echo "Product ID Is Available";
    }
?>