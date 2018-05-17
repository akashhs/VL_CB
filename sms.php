<?php 
session_start();
include 'send.php';
$_SESSION['smsgatewaycenterotp'] = smsgatewaycenter_com_OTP();

$OTP = $_SESSION['smsgatewaycenterotp'];
 
//var_dump($_POST);

//echo $_POST['phon_number'];
//$_SESSION['smsgatewaycenterotp'] = smsgatewaycenter_com_OTP();
//$OTP = $_POST['otp'];
//echo $_POST['otp'];
$number = $_POST['phon_number'];
//echo $_SESSION['smsgatewaycenterotp'];
//$text = 'Hi There, how are you?'; 
$sms_api_result = smsgatewaycenter_com_Send($number, 'Your OTP is '.$OTP.'. Do not share your OTP with anyone',$debug);

?>
<?php echo $OTP ;?>