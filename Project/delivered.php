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
  window.location='login.php';
 </script>
 <?php
 } 
  $count_del=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered'");
  $del_count=@mysql_num_rows($count_del);
 if($del_count==0)
 {
 ?>
  <script>
  alert('No Delivered Reports At this time !!');
  window.location='loghome.php';
 </script>
 <?php
 }
  if(!isset($_GET['page']) || $_GET['page'] == ''  || $_GET['page'] <= '0')
  {
   $page ="1";
  }
  else
  {
   $page = intval($_GET['page']);
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
 function logoutcon()
 {
  var conlog = confirm('Are you sure you want to log out !!');
  if(conlog)
  {
   alert(window.location="logout.php");
  }
  else
  {
   return false;
  }
 }
 function check()
 {
  if(document.getElementById('selpid').value == 'selpid' && document.getElementById('seldate').value == 'seldate')
  {
   alert('Select any option !!');
   return false;
  }
 }
 </script>
</head>
 <?php 
  $count=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Waiting'");
  $order_count=@mysql_num_rows($count);
  $count_del=@mysql_query("SELECT * from t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered'");
  $del_count=@mysql_num_rows($count_del);
 ?>

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
      <div id="subsidebar2"><a href="reports.php">Order Reports<?php echo' ('.$order_count.')';?></a> 
      </div>
      <div id="subsidebar2"><a href="stock.php">Stock Reports</a> 
      </div>
      <div id="subsidebar2"><a href="backup.php">Back UP</a> 
      </div>
      <div id="subsidebar5">Archive
      <ul>
      <?php
       $get_date= @mysql_query("SELECT DISTINCT bck_archive FROM t_backup_trn WHERE username= '$username' ORDER BY bck_archive DESC ")or die(mysql_error());
       $num_date= @mysql_num_rows($get_date);
       for($i=0;$i<$num_date;$i++)
       {
        $date= @mysql_result($get_date,$i,'bck_archive');
      ?>
      <li><a href="backupdisplay.php?date=<?php echo $date;?>"><?php echo $date;?></a></li>
      <?php
       }
      ?>
      </ul>
      </div>
      <div id="subsidebar2"><a href="mail.php">Send Mail</a> 
      </div>
      <div id="subsidebar2"><a href="" onclick="logoutcon();">Log out</a> 
      </div>
    </div>
    <!-- end #sidebar1 -->
  </div>

 <div id="mainContent">
   <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right">Delivered Reports</div>
      <div id="middletxt1">
      <form name="frm_rpt" id="frm_rpt" action="" method="post">
        <table width="100%" border=0>
          <tr>
           <td width="245" height="37"><div align="right"><strong>Product Id : </strong></div></td>
           <td><select name="selpid" id="selpid" style="width:180px;">
               <option value="selpid">- Select Product ID -</option>
               <?php
                 $get_pid= @mysql_query("SELECT DISTINCT prd_id FROM t_orders_trn WHERE username= '$username' AND ord_deliverystatus= 'Delivered'")or die(mysql_error());
                $num_pid= @mysql_num_rows($get_pid);
                for($i=0;$i<$num_pid;$i++)
                {
                 $pid= @mysql_result($get_pid,$i,'prd_id');
               ?>
	       <option value="<?php echo $pid;?>"><?php echo $pid;?></option>
               <?php
                }
               ?>
              </select>
	      </td>
              </tr>
          <tr>
           <td width="245" height="37"><div align="right"><strong>Order Date : </strong></div></td>
           <td><select name="seldate" id="seldate" style="width:180px;">
               <option value="seldate">- Select Order Date -</option>
               <?php
                $get_date= @mysql_query("SELECT DISTINCT ord_odate FROM t_orders_trn WHERE ord_deliverystatus= 'Delivered' AND username= '$username' ORDER BY ord_odate DESC")or die(mysql_error());
                $num_date= @mysql_num_rows($get_date);
                for($i=0;$i<$num_date;$i++)
                {
                 $odate= @mysql_result($get_date,$i,'ord_odate');
               ?>
	       <option value="<?php echo $odate;?>"><?php echo $odate;?></option>
               <?php
                }
               ?>
              </select>
	      </td>
              </tr>
              <tr>
                 <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="submit" id="submitMain" name="submitMain" value="Display" Onclick="return check();" />
                 &nbsp;&nbsp;&nbsp;
                 </td>
              </tr>
              </table>
      </form>
      </div>
      </div>

     <div id="middletxt">
       <div id="middletxtheader" align="right">Orders</div>
        <!-- end #middletxt -->
      <form name="frm_report" id="frm_report" method="post" action="">
      <table border="1" cellpadding="0" cellspacing="0" width="685" height="300">
       <tr>
        <th align="center">Product ID</th>
        <th align="center">Product ordered</th>
        <th align="center">Customer name</th>
        <th align="center">Date</th>
        <th align="center">Address</th>
       </tr>
 <?php
 $adjacents = 3;
	
	/* Setup vars for query. */
	$targetpage = "reports.php"; 	//your file name  (the name of this file)
	$limit = 4; 								//how many items to show per page
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
		
 	$query="SELECT COUNT(*) as num FROM t_orders_trn WHERE username = '$username' AND ord_deliverystatus= 'Delivered'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$num = @mysql_num_rows($total_pages);
	$total_pages = $total_pages[$num];
	//echo $total_pages;
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 2;						//last page minus 1
	
	$get= @mysql_query("SELECT * FROM t_orders_trn WHERE username='$username' AND ord_deliverystatus= 'Delivered' LIMIT $start, $limit ")or die(mysql_error());
        $num = @mysql_num_rows($get);
	
    for($i=0;$i<$num;$i++)
    {
     $row= @mysql_result($get,$i,'row_id');
     $prid= @mysql_result($get,$i,'prd_id');
     $cust_fname=@mysql_result($get,$i,'ord_fname');
     $cust_lname=@mysql_result($get,$i,'ord_lname');
     $cust_name=$cust_fname." ".$cust_lname;
     $oqty=@mysql_result($get,$i,'ord_qty');
     $oprice=@mysql_result($get,$i,'ord_price');
     $odate=@mysql_result($get,$i,'ord_odate');
     $oddate=@mysql_result($get,$i,'ord_ddate');
     $email=@mysql_result($get,$i,'ord_email');
     $badd=@mysql_result($get,$i,'ord_baddress');
     $sadd=@mysql_result($get,$i,'ord_saddress');
     $mobile=@mysql_result($get,$i,'ord_mobile');
     $phone=@mysql_result($get,$i,'ord_phone');
  ?>
   <tr>
    <td width="80"><?php echo $prid;?></td>
    <input type="hidden"  name="hdnrid<?php echo $i; ?>" id="hdnrid<?php echo $i; ?>" value="<?php echo $row; ?>"> 
    <td width="200">Quantity ordered : <?php echo $oqty;?><br/>Total Price : <?php echo $oprice;?></td>
    <td width="150"><?php echo $cust_name;?></td>
    <td width="250">Ordered Date : <?php echo $odate;?><br/>Delivery Date : <?php echo $oddate;?>    </td>
    <td width="250"><p align="center">Billing Address : <br/><?php echo $badd;?><br/>
                                      Shipping Address : <br/><?php echo $sadd;?><br/>
                                      Email ID : <br/><?php echo $email;?><br/>
				      <br/>Mob : <?php echo $mobile;?> <br/>Ph : <?php echo $phone;?> </p>
    </td>
 </tr>
<?php
    }
?>
      </table>
     </form>
 <input type="hidden"  name="hdnprdnum" id="hdnprdnum" value="<?php echo $num; ?>">

 <?php
    $pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">  Previous  </a>";
		else
			$pagination.= "<span class=\"disabled\">  Previous  </span>";	
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">  $counter  </span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">  $counter  </a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">  $counter  </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">  $counter  </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?&page=$lpm1\">  $lpm1  </a>";
				$pagination.= "<a href=\"$targetpage?&page=$lastpage\">  $lastpage  </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">  1  </a>";
				$pagination.= "<a href=\"$targetpage?page=2\">  2  </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
				  
				  echo "cou=".$counter;
				  echo "page=".$page;
					if ($counter == $page)
						$pagination.= "<span class=\"current\">  $counter  </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">  $counter  </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">  $lpm1  </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">  $lastpage  </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">  $counter  </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">  $counter  </a>";					
				}
			}
		}
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">  Next </a>";
		else
			$pagination.= "<span class=\"disabled\">  Next </span>";
		$pagination.= "</div>\n";		
	}
?>
<div id="middletxtheader" align="right">
<?php  echo $pagination;  ?> 
</div>
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
  if(isset($_POST['submitMain']))
  {
   $dpid=$_POST['selpid'];
   $ddate=$_POST['seldate'];
   echo "<script>window.location='deliveredproduct.php?pid=$dpid&date=$ddate'</script>";
  }
 ?>

</body>
</html>