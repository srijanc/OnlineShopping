 <?php
 $img = $_GET['img'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/Webpage.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "Webpage.css";
 </style>
</head>

<body class="twoColFixLtHdr">
 <div id="mainContent1" align="left">
  <div id="middletxtheadermain" align="left">
   <div id="middletxtheader" align="Center">Image</div>
    <div id="middletxt1" align="left">
     <div align="center"><img src="images/products/<?php echo $img; ?>" alt="Product image !!" width=200 height=200 /> </div>
    </div>
   </div>
 <div id="footer">
  (C) Copyright Srijan Vasu Vipul P. Limited
 <!-- end #footer -->
  </div>
 </div>
</body>
</html>