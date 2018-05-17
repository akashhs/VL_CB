<?php
session_start();
include('send.php');
include 'inc/detect.php';
$os = Detect::os();
// Get the name & version of browser
$browser =  Detect::browser();
// Get the name of the brand
$brand = Detect::brand();
// Gets the device type ('Computer', 'Phone' or 'Tablet')
$device_type =  Detect::deviceType();
$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$ip=$_SERVER["REMOTE_ADDR"];
$OTP = $_SESSION['smsgatewaycenterotp'];
//echo $OTP;
//DATABASE HERE//
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'chatbot');
$conn = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// $Name = $_POST['name'];
// $Mobile= $_POST['phon_number'];
// $Email= $_POST['email'];
//var_dump($_POST);
if(isset($_POST['phon_number'])){
	 if($_POST['otp'] == $_SESSION['smsgatewaycenterotp']){
$query = "INSERT INTO `users` (`name`,`phon_number`,`email`,`city`,`ip`,`browser`,`devicetype`,`os`,`devicename`) values ('".$_POST['name']."','".$_POST['phon_number']."','".$_POST['email']."','".$_POST['city']."','$ip','$browser','$device_type','$os','$brand')";
echo $query;

$sql = mysqli_query($conn,$query); }
else{
              $message="You have entered the wrong OTP";
           echo "<script type='text/javascript'>alert('$message');</script>";
          }
}

mysqli_close($conn);
?>