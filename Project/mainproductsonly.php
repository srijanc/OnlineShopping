<?php
  session_start();
  if(isset($_SESSION['sid']))
  {
    $sid=$_SESSION['sid'];
  }
    include("config/config.php");
    $username=base64_decode($_GET['un']);
    $count=@mysql_query("SELECT * from t_product_mst WHERE username='$username'");
    $pcount=@mysql_num_rows($count);
   if($_GET['un']=="" || $pcount == 0 ){ ?>
   <script>
   alert('No Products Avilable At this time!!');
   window.location='Main.php?un=<?php echo base64_encode($username);?>';
 </script>
 <?php
 } else {
  $username=base64_decode($_GET['un']);
  $cat=$_GET['cat'];
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Shopping</title>
<link href="css/Webpage.css" rel="stylesheet" type="text/css" />
<link href="css/flyout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/flyout.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<style type="text/css" media="all">
@import "Webpage.css";
</style>
<script language="javascript">

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
      <div id="subsidebar3"> Category </div>
<div id="subsidebar2"><a href="Main.php?un=<?php echo base64_encode($username);?>"><b>All</b></a></div>
<div id="wrapper">
 <?php
   $get_catgry=mysql_query("SELECT DISTINCT(prd_cat) FROM t_product_mst WHERE username = '$username' AND prd_status='Available' ")or die(mysql_error());
   $num_cat=mysql_num_rows($get_catgry);
   for($i=0;$i<$num_cat;$i++)
   {
    //echo$i;
    $category = @mysql_result($get_catgry,$i,'prd_cat');
   
  ?>
<div id="subsidebar2">
  <dl class="dropdown">
    <dt id="<?php echo $i;?>-ddheader" class="upperdd" onmouseover="ddMenu('<?php echo $i;?>',1)" onmouseout="ddMenu('<?php echo $i;?>',-1)"><?php echo $category;?></dt>
    <dd id="<?php echo $i;?>-ddcontent" onmouseover="cancelHide('<?php echo $i;?>')" onmouseout="ddMenu('<?php echo $i;?>',-1)">
        <?php
                      $get_scatgry=mysql_query("SELECT DISTINCT(prd_sub_cat)  FROM t_product_mst WHERE prd_cat='$category' AND username = '$username' AND prd_status='Available'  ")or die(mysql_error());
                        $num_scat=@mysql_num_rows($get_scatgry);
                        ?>
      <ul>
        <?php for($j=0;$j<$num_scat;$j++)
              {
               $sub_category=mysql_result($get_scatgry,$j,'prd_sub_cat');
       ?>
        <li><a href="mainproduct.php?cat=<?php echo $category;?>&sub=<?php echo $sub_category?>&un=<?php echo base64_encode($username);?>" class="underline"><?php echo $sub_category;?></a></li>
 <?php
              }
 ?>
      </ul>
    </dd>
   </dl>
</div>
 <?php
  }
 ?>

</div><!-- end #wrapper class -->
    </div>
    <!-- end #sidebar1 -->
  </div>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader">Welcome</div>
      <div id="middletxt1">
      <div align="left"><img src="images/Welcome.jpg" alt="Online Shopping" width="600" height="150" /> </div>
      </div>
      </div>
    <?php
    $cartcount=@mysql_query("SELECT * from t_cart_temp WHERE username='$username' AND s_id='$sid'");
    $ccount=@mysql_num_rows($cartcount);
    ?>
      <div id="middletxt">
       <div id="middletxtheader"><a href="Main.php?un=<?php echo base64_encode($username);?>">Category</a> -> <?php echo $cat;?>
       <div style="float:right;"><img src="images/cart.gif"><a href="cart.php?un=<?php echo base64_encode($username); ?>">Shopping Cart (<?php  echo $ccount;  ?>)</a>
       </div>
       </div>
       <!-- end #middletxt -->
	<form name="frm_main" id="frm_main" method="post" action="">
      <table border="1" cellpadding="0" cellspacing="0" width="685" height="300">
<?php
	    
	 $adjacents = 3;
	
	 /* Setup vars for query. */
	 $targetpage = "mainproductsonly.php"; 	//your file name  (the name of this file)
	 $limit = 2; 								//how many items to show per page
	 if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	 else
		$start = 0;								//if no page var is given, set start to 0
	 
	$query="SELECT COUNT(*) as num FROM t_product_mst WHERE username= '$username' AND prd_cat= '$cat' AND prd_status='Available' ";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$num = @mysql_num_rows($total_pages);
	$total_pages = $total_pages[num];
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
			
		
?>
<?php
    $get= @mysql_query("SELECT * FROM t_product_mst WHERE username= '$username' AND prd_cat= '$cat' AND prd_status='Available' LIMIT $start, $limit ")or die(mysql_error());
    $num = @mysql_num_rows($get);
	
    for($i=0;$i<$num;$i++)
    {
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
     //$psdis= @mysql_result($get,$i,'prd_sdis');
     //$pldis= @mysql_result($get,$i,'prd_ldis');
     //$pqtyavb= @mysql_result($get,$i,'prd_qtyavb');
     $pstatus= @mysql_result($get,$i,'prd_status');
     $pdel= @mysql_result($get,$i,'prd_delivery_mode');
     $pdlead= @mysql_result($get,$i,'prd_delivery_leadtime');
     //$psep= @mysql_result($get,$i,'prd_sep');
 ?>
 <tr>
    <td align="center" width="40"><input type="checkbox" name="chk<?php echo $i; ?>" id="chk<?php echo $i; ?>" value="<?php echo $prid; ?>"></td>
    <td width="110"><p align="Center">Product Name<br/><?php echo $psname;?></td></p>
    <td><p align="center">
    <a onclick="javascript:window.open('image.php?img=<?php echo $pimg; ?>','newWin','width=500,height=280');" >
    <img id="" src="images/products/<?php echo $pimg; ?>" width=50 height=50 /></a>
    </p></td>
    <td width="250"><p align="center">Discription : 
                    <?php if($pcolor=="") { } else {?>
	            Color : <?php echo $pcolor;?> <br/>
	            <?php } ?>
                    <?php if($pbrand=="") { } else {?>
	            Brand : <?php echo $pbrand;?> <br/></p>
	            <?php } ?>
    </td>
    <td width="220"><p align="left"><br/>
        Quantity Avilable : <?php echo $pqty;?> <br/>
        Your Order :<select name="selqty<?php echo $i;?>" id="selqty<?php echo $i;?>" style="width:100px;">
                     <option value="selqty">- Select -</option>
	
	</select><br/>
        Delivery Mode : <?php echo $pdel;?> <br/>
        Delivery Lead Time : <?php echo $pdlead;?> Days<br/></p>
    </td>
 <?php
    $get_price= @mysql_query("SELECT * FROM t_price_mst WHERE username= '$username' AND prd_id='$prid' ")or die(mysql_error());
    $num_price = @mysql_num_rows($get_price);
    for($j=0;$j<$num_price;$j++)
    {
     $pact= @mysql_result($get_price,$j,'price_actual');
     $pdis= @mysql_result($get_price,$j,'price_discount');
     $pdiscount= @mysql_result($get_price,$j,'price_discount_type');
    ?>
    <td width="130"><p align="left">Price : <?php echo $pact;?> <br/>
	<?php
        if($pdiscount=="Yes")
	{
	?>
        Discount : <?php echo $pdis;?> <br/>
	<?php
	}
	?>
    </td>
    <?php } ?>
 </tr>
<?php
}
?>
 <tr>
  <td align="center" colspan="10">
   <input type="submit" name="sub" id="sub" value="Add To Cart" onclick="return chkprdval();"></td>
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
    if(document.getElementById("chk"+j).checked)
    {
    if(document.getElementById('selqty'+j).value=="selqty")
   {
    alert("Please select the quantity");
    return false;
   }
    }
  }
  if(count==0)
  {
   alert("Please select any one product");
   return false;
  }
  
 }
</script>
 
<?php
    $pagination = "";
	if($lastpage > 1)
	{	
	        $un=base64_encode($username);
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$prev\">  Previous  </a>";
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
					$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$counter\">  $counter  </a>";					
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
						$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$counter\">  $counter  </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$lpm1\">  $lpm1  </a>";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$lastpage\">  $lastpage  </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=1\">  1  </a>";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=2\">  2  </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">  $counter  </span>";
					else
						$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$counter\">  $counter  </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$lpm1\">  $lpm1  </a>";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$lastpage\">  $lastpage  </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">  $counter  </span>";
					else
						$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$counter\">  $counter  </a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?cat=$cat&sub=$sub&un=$un&page=$next\">  Next </a>";
		else
			$pagination.= "<span class=\"disabled\">  Next </span>";
		$pagination.= "</div>\n";		
	}
?>
<div id="middletxtheader">
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
        if(isset($_POST['sub']))
        {
	  for($b=0;$b<$num;$b++)
          {
	    if(isset($_POST['chk'.$b]))
	    {
              $qtyord=$_POST['selqty'.$b];
      	      $chkbox=$_POST['chk'.$b];
	      if($qtyord=="selqty")
	     {
	      $qtyval="";
	     } else {
	      $qtyval=$qt.$qtyord;
	     }
              $pid=$_POST['chk'.$b];
              $get= @mysql_query("SELECT * FROM t_product_mst WHERE username='$username' AND prd_id='$pid' ")or die(mysql_error());
              $num1 = @mysql_num_rows($get);
              for($i=0;$i<$num1;$i++)
              {
                $psname= @mysql_result($get,$i,'prd_sname');
                $plname= @mysql_result($get,$i,'prd_lname');
                $pimg= @mysql_result($get,$i,'prd_photo');
                $pqty= @mysql_result($get,$i,'prd_qty'); // minimum Qty
                $pqtyavb= @mysql_result($get,$i,'prd_qtyavb'); // avaiable qty
                 $get_price= @mysql_query("SELECT * FROM t_price_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
                 $num_price = @mysql_num_rows($get_price);
                 for($j=0;$j<$num_price;$j++)
                 {
                  $pact= @mysql_result($get_price,$j,'price_actual');
                  $pdis= @mysql_result($get_price,$j,'price_discount');
		  $pdiscount= @mysql_result($get_price,$j,'price_discount_type');
                    if($pdiscount=="Yes") 
		    {
		     $p_price=$qtyval*$pdis;
		    }
		    else
		    {
		     $p_price=$qtyval*$pact;
		     $pdis="0.0";
		    }
		 }
	      }
	      $query = mysql_query("INSERT INTO t_cart_temp (s_id,username,prd_id,cart_name,cart_img,cart_qty,cart_qtyavb,cart_qtyordered,cart_act,cart_dis,cart_price)
                       VALUES ('$sid','$username','$pid','$plname','$pimg','$pqty','$pqtyavb','$qtyval','$pact','$pdis','$p_price')") or die(mysql_error());
	    }  
	  }
	 echo "<script>alert('Products Added to Cart !!');</script>";
         echo "<script>window.location='mainproductsonly.php?un=$un&cat=$cat'</script>";
      	}
  ?>
</body>
</html>