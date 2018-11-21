<?php
ob_start();
//Continue the session
@session_start();
$sessioncount=$_SESSION['count'];
$captcha=$_REQUEST["txtcaptcha"];
$captchavalue=md5($captcha);
//Make sure that the input come from a posted form. Otherwise quit immediately
if ($_SERVER["REQUEST_METHOD"] <> "POST") 
 die("You can only reach this page by posting from the html form");
//Check if the securidy code and the session value are not blank 
//and if the input text matches the stored text
if (($captchavalue == $sessioncount) && 
    (!empty($captchavalue) && !empty($sessioncount)) ) 
{
 echo "ok";
} 
else 
{
//echo "<input type='hidden' name='noofrows' id='noofrows' value='echo $_SESSION['count'];' />";
echo "Enter the code as shown in the image";
}
ob_flush();
?>