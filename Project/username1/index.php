<?php   
 include("../config/config.php");
 $username="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Shopping</title>
<link href="../css/Webpage.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="all">
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
      <div id="subsidebar3">Welcome</div>
       <div align="center"><a href="../Main.php?un=<?php echo base64_encode($username);?>"><img src="../images/click.jpg" alt="Online Shopping" width="180" height="200" /></a></div>
       <div align="center"><img src="../images/1.jpg" alt="Online Shopping" width="180" height="400" /> </div>
    </div>
    <!-- end #sidebar1 -->
  </div>
 <?php
    $get= @mysql_query("SELECT * FROM t_custreg_mst WHERE username= '$username'")or die(mysql_error());
    $num = @mysql_num_rows($get);
    for($i=0;$i<$num;$i++)
    {
     $email= @mysql_result($get,$i,'log_email');
     $add= @mysql_result($get,$i,'log_address');
     $country= @mysql_result($get,$i,'log_country');
     $mob= @mysql_result($get,$i,'log_mobile');
     $phone= @mysql_result($get,$i,'log_phone');
     $about= @mysql_result($get,$i,'log_about_us');
    }
 ?>
  <div id="mainContent">
    <div id="mainContent1">
    <div id="middletxtheadermain">
      <div id="middletxtheader" align="right"></div>
      <div id="middletxt1">
       <div align="left"><img src="../images/Welcome.jpg" alt="Online Shopping" width="600" height="150" /> </div>
      </div>
      </div>
      <div id="middletxt">
       <div id="middletxtheader" align="right"></div>
        <!-- end #middletxt -->
<table border="0" cellpadding="0" cellspacing="0" width="685" height="400">
	<!-- MSTableType="layout" -->
	<tr>
		<td align="left" ><img src="../images/aboutus.jpg" alt="About us" width="200" height="200" /></td>
                <td ><p align="center"><strong><?php echo $about;?></strong></p></td>
	</tr>
	<tr>
          <td ><p align="center"><strong>Address : <br/><?php echo $add; ?><br/>
                    Country : <?php echo $country;?><br/>
                    E-mail : <?php echo $email;?><br/>
                    Mobile No : <?php echo $mob;?><br/>
                    Phone No : <?php echo $phone;?><br/></strong></p>
                </td>
		<td align="right"><img src="../images/contactus.jpg" alt="Contact us" width="200" height="200" /></td>
	</tr>
</table>
      </div>
    </div>
    <!-- end #mainContent -->
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <div id="footer">
    © Copyright Rishi Systems P. Limited
    <!-- end #footer -->
  </div>
  <!-- end #container -->
</div>
</body>
</html>