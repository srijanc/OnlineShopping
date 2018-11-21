<?php   
 session_start();
 include("config/config.php");
 if($_GET['prid']=="")
 {
 ?>
 <script>
   alert('You Are Not Logged In !! Please Login to access this page');
   alert(window.location='login.php');
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
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Online Shopping</title>
 <link href="css/online.css" rel="stylesheet" type="text/css" />
 <style type="text/css" media="all">
 @import "online.css";
 </style>
 <script language="javascript">
 // validating Product image for non empty !!
 function done()
 {
  if(!(document.getElementById("fileimage").value))
  {
   alert("Browse Product image !!");
   document.getElementById("fileimage").focus();
   return false;
  } 
 }
 </script>
</head>

<body class="twoColFixLtHdr">
<div id="header">
  <!-- end #header -->
</div>

 <?php
  $get= @mysql_query("SELECT * FROM t_product_mst WHERE username= '$username' AND prd_id='$pid' ")or die(mysql_error());
  $num = @mysql_num_rows($get);
  for($i=0;$i<$num;$i++)
  {
   $row= @mysql_result($get,$i,'row_id');
   $prid= @mysql_result($get,$i,'prd_id');
   $pimg= @mysql_result($get,$i,'prd_photo'); 
  }
?>
 <div id="middletxtheader">Change Image for the Product</div>
 <div id="middletxt1">
  <form name="img" id="img" method="post" enctype="multipart/form-data">
   <img id="img" src="images/products/<?php echo $pimg; ?>" />
   <br>
   <input type="file" name="fileimage" id="fileimage" maxlength="50" value="" style="width:176px;"
                         onchange=" document.getElementById('fileimage').value=trim(this.value);"/>
   <div class="example">  Image Size Should not Exceed 350000bytes.</div>
   <br/><br/>		
   <input type="submit" id="submitMain" name="submitImage" value="Update Image" Onclick="return done(this.form);" > 		  
  </form>
 </div>
 <?php
  $photoid=$row;
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

 <?php
 if(isset($_POST['submitImage']) && ($size < 350000))
 {
  $pimg=$imageval; // after renaming 
  $query = mysql_query("UPDATE t_product_mst SET prd_photo='$pimg' WHERE username='$username' AND prd_id='$pid'")
			or die(mysql_error());
  echo "<script>alert('Image Updated sucessfully !!');</script>";
  echo "<script>window.close();</script>";
 }
 ?>
</body>
</html>