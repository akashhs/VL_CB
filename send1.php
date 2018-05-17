<?php if(isset($_POST['phon_number'])) {
	// $number = $_POST['num'];
	// $sendmessage= $_POST['message'];

 // $query = $db->query("SELECT * FROM facebook_leads ORDER BY id DESC");
 //     if($query->num_rows > 0){
 //    while ($row = mysqli_fetch_array($query)){
      $phone=$_POST['phon_number'];
      $name= $_POST['name'];
      echo $phone;
      // $phone_num = implode(",",$phone);
      // echo "<td>$name</td><br/>";
      // echo "<td>$phone</td><br/>";
      $msg="Your OTP is 1234. Do not share your OTP with anyone.";
            // echo $msg;
      $smsgatewaycenter_com_url = "http://alerts.valueleaf.com/api/v4/?api_key=A5a74fd8e93661163e5c0e3127c493f0b"; //SMS Gateway Center API URL
    global $smsgatewaycenter_com_url,$parameters; 
   $para = 'method=sms&username=vlbatraoectrans&pass=rRFm[D|ao3GVfi&sender=VLFOTP&message='.$msg.'&to='.$_POST['phon_number'].'';
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $smsgatewaycenter_com_url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $para);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $return = curl_exec($ch);
    // header('Location:index.php');
      
    
 }
   ?>