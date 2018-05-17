<?php 
include('include/config.php');
include('send.php');

session_start();

$OTP = $_SESSION['smsgatewaycenterotp'];

   $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
 //  $url = "https://" . $_SERVER['HTTP_HOST'];
 //  $i = 1;
   $ip=$_SERVER["REMOTE_ADDR"];
   $click_id=$_GET['session_id'];
   $utm_source=$_GET['utm_source'];

 // if (preg_match("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent )){
 //        header("location:actions.php?cid=$click_id");
 //       // header("location:mobile.php");
 //        exit;
 //  } else {

   



        if(isset($_POST['phone'])){
            
             if($_POST['otp'] == $_SESSION['smsgatewaycenterotp']){
            
            
          $sql="INSERT INTO `customer` SET  `customer`='".$_POST['customer']."', `email`='".$_POST['email']."', `telephone`='".$_POST['phone']."', `city`='".$_POST['city']."', `status`='1', `clickId`='$click_id',`utm_source`='$utm_source',`agent_browser`='$user_agent',`ip`='$ip', `date_added`=now()";

          $result = mysqli_query($conn,$sql);
          
          $id = mysqli_insert_id($conn);
          
            
            $url = 'www.drbatras.com/campaigns/Lead_Trigger/default.aspx?';
            $query = 'name='.$_POST['customer'].'&mobile='.$_POST['phone'].'&email='.$_POST['email'].'&Ailment=HAIR&city='.$_POST['city'].'&Desc='.$id.''.$utm_source.'&publisher=VL-API%20Hair&Source=42466';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $return = curl_exec($ch);
            curl_close ($ch); 
            
           // $upi = $url.$query;
            //echo $upi;
            
            //echo $return;

               if($return){
              //     $sender_email = $_POST['email'];
              //     $to       =   $sender_email;                 
              //     $subject  =   "Greetings From Dr. Batra";
              //     $headers  =   "From: Better Hair Days With Dr. Batra <drbatra.in>\r\n".
              //                   "MIME-Version: 1.0" . "\r\n" .
              //                   "Content-type: text/html; charset=UTF-8" . "\r\n";
              //     $headers  .=  "Reply-To:$sender_email " . "\r\n";
              //     $headers  .=  "Cc: $sender_email" . "\r\n";
                 // $headers  .="Bcc: $sender_email". "\r\n";
                 // $body="Dear ".$_POST['customer'].", <br/><br/>Thank you for your interest in Dr. Batra’s. You’ve chosen the right way to treat your hair problems.<br/>You should expect a call from us on ".DATE('d-m-Y h:i:s').".<br/> In case you’ve missed our call or you’ve not managed to speak with us, you can give us a call on: ".$_POST['telephone']."<br/> In the meanwhile, if there’s anything that you would like assistance with regarding our services, please feel free to call us. We would be glad to help you.<br/>Wishing you happy hair days.<br/><br/> Regards,<br/> Dr. Batra’s";
              //     $body="Dear ".$_POST['customer'].",<br/><br/>Thank you for your interest in Dr. Batra’s. You’ve chosen the right way to treat your hair problems.<br/>We will be calling you back shortly.<br/> Wishing you happy hair days.<br/><br/> Regards,<br/> Dr. Batra’s";
               


              //     mail($to, $subject, $body, $headers);
              
              $update = "UPDATE `customer` set return=".$return." where id=".$id."";
               
               }


          //..................... PIXEL CODE TRACKING HERE......................// 
                 if(!empty($click_id)){       
                         $url="http://tracking.salesleaf.com/aff_lsr?offer_id=1592&adv_sub=".$id."&transaction_id=".$click_id."";
                         $ch = curl_init();
                         curl_setopt($ch, CURLOPT_URL, $url); 
                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                         $output=curl_exec($ch); 
                         curl_close($ch);
                  } 
                
            //..................... PIXEL CODE TRACKING END HERE......................//
//echo 
             //header("location:thankyou.php");
             //exit;
             echo "<script type='text/javascript'>window.location.href = 'thankyou.php';</script>";
             exit();
             
          }
          else{
              $message="You have entered the wrong OTP";
           echo "<script type='text/javascript'>alert('$message');</script>";
          }

 }




?>
<html lang="en"><head>
<meta charset="utf-8">

<meta content="width=device-width, initial-scale=1" name="viewport">

<title>DrBatra's</title>
<link href="style.css" type="text/css" rel="stylesheet"> 

<script src="https://js.usemessages.com/messageswidgetshell.js" type="text/javascript" id="hubspot-messages-loader" data-loader="hs-scriptloader" data-hsjs-portal="120237" data-hsjs-env="prod"></script><script async="" src="//d1fc8wv8zag5ca.cloudfront.net/2.5.3/sp.js"></script><script src="//bat.bing.com/bat.js" async=""></script><script src="https://connect.facebook.net/signals/config/396669130541302?v=2.8.6&amp;r=stable" async=""></script><script src="https://connect.facebook.net/signals/config/1562322650663413?v=2.8.6&amp;r=stable" async=""></script><script async="" src="//connect.facebook.net/en_US/fbevents.js"></script><script id="hs-analytics" src="//js.hubspot.com/analytics/1516011300000/120237.js"></script><script type="text/javascript" async="" src="//dnn506yrbagrg.cloudfront.net/pages/scripts/0058/8138.js?421114"></script><script type="text/javascript" async="" src="//www.googleadservices.com/pagead/conversion_async.js"></script><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" async="" src="https://s.adroll.com/j/roundtrip.js"></script><script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-KSJ3B"></script><script src="//cdn.optimizely.com/js/13450258.js"></script>

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112919214-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112919214-1');
</script>



</head>
<body class="free_signup_page"><div id="StayFocusd-infobar" style="display: none; top: 0px;">
    
    <span id="StayFocusd-infobar-msg"></span>
    <span id="StayFocusd-infobar-links">
        <a id="StayFocusd-infobar-never-show">hide forever</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a id="StayFocusd-infobar-hide">hide once</a>
    </span>
</div><style type="text/css">html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important;right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container .shadow{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;right:0;content:""}#hubspot-messages-iframe-container .shadow.active{width:400px;height:400px;background:radial-gradient(ellipse at bottom right,rgba(29,39,54,.16) 0,rgba(29,39,54,0) 72%)}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important}</style>
    

<main id="content" role="main">
<div id="free_signup_container">
<div class="container signup">
<div class="signup_header">
<div class="logo">
<a href="#">
<img height="104" src="drb.png" width="175">
</a>
</div>
</div>
<div class="signup_container">
<div class="signup_info">
<h2 style="color:#000;">Leaders in Hair Loss Treaments and Hair Transplantation</h2>
</div>
<div class="signup_form">
<div class="form_wrapper">
<form action="" id="account_create" method="post">
<div class="row">
<div class="field-container">
<input class="example flex-input margin-10" id="Name" name="customer" placeholder="Name" type="text" pattern="^[^-\s][a-zA-Z0-9_\s-]+$" value='<?php echo $_POST['customer']; ?>' required />
</div>
<div class="field-container">
<input class="example flex-input margin-10"  id="PhoneNumber" name="phone" placeholder="Mobile Number"  maxlength="10" type="number" pattern="^\d+$" value='<?php echo $_POST['phone']; ?>' required/>
</div>
<!-- om new row for otp input and generate button -->

	<div class="row">
		<div class="field-container">
			<input class="example flex-input margin-10" style="width:268px;" id="otp" name="otp" placeholder="OTP" type="text" required />
		</div>
		<div class="field-container">
			<button id="generateOtpBtn" style="padding:0.5em; width: 269.5px;" class="">Generate OTP</button>
		</div>

		</div>

<!-- end of om row for otp input and generate button -->


</div>
<div class="row">
<div class="field-container">
<input class="example flex-input margin-10" id="Name" name="email" placeholder="Email" type="email" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.(com|in|info|net)$" value='<?php echo $_POST['email']; ?>' required>
</div>
<div class="field-container">
<input class="example flex-input margin-10" id="City" name="city" placeholder="City" type="text" value='<?php echo $_POST['city']; ?>' required>

</div>

</div>
<!-- TODO: I don't think this option exists anymore... -->

<div class="row">
<div class="field-container">
<button id="btn1" class="create-account-button margin-10" type="submit" >Submit</button>

</div>
</div>
</form>
</div>
</div>
</div>
</div>
<div data-video-height="1" data-video-width="1" id="wistia_407bc3c2b5" style="width:1px;height:1px;">&nbsp;</div>
<section id="pricing-questions">
<div class="field-conainer">
<div class="column">
<div class="pricing-question">
<h1>Treatment Results</h1>
<p>
Being so strikingly focused on patient care and well-being, our patients are at the core of everything that we do. This is the reason that we have been able to achieve a positive treatment outcome of 91% (as audited by the US-based agency American Quality Assessors-AQA). Moreover, our overall patient satisfaction as audited by AQA is over 87%. We have been able to achieve successful treatment outcomes because of the following :
</p>
</div>
<div class="pricing-question">
	
		<p>
			Honest assessment of the patient’s case: We do an honest assessment of the patient’s case before starting the treatment. We only take up those cases where we confidently feel that we can make a difference, giving us a higher success rate with the cases that we accept to treat.
		</p>
		<p>Well- trained doctors: All our doctors undergo over 500 hours of Continuing Medical Education (CME) in a year (as against 150 hours CME at other institutes) so that there is continual improvement in patient care and treatment.</p>
		<p>E-medical records : As all medical records are saved throughout a patient's lifetime, patients need not carry their reports to see our doctors across any of our clinics in India and abroad. Having over 10 lakh cases in our IT system, cross referencing becomes much faster, thereby deriving a better cure for you through our past experience and a better treatment outcome as well.</p>
		<p>Medical board: Our patients get access to a Medical Board which includes super specialist MDs from top 12 specialties, all of whom have 30 plus years of medical experience and are leading experts in their field of medicine. Second opinions and cross referencing of cases amongst the 350 full-time homeopathic doctors at Dr Batra’s™ is another reason for our top class medical outcomes.</p>
		<p>Scientific and transparent monitoring of outcome: At Dr Batra’s™, to monitor treatment outcomes, we use sophisticated machines and advanced technology like video microscopy for hair, spirometry for breathing disorders (asthma) and proprietary technologies such as Dr Batra’s™ M.O.S.T and 3D skin assessment devices for dermatological problems. Our scientific monitoring of treatment effectively reveals the success and pace of treatment. Our treatment monitoring systems are transparent and shared with our patients.</p>
		<p>Tele-homeopathy: Dr Batra’s™ was the first to pioneer tele-homeopathy to facilitate doctor-patient interaction through video-conferencing for consultation or a second opinion across various geographies. Tele-homeopathy allows us to fully leverage the expertise and experience of the 350 full time doctors who work with us. Patients can consult the doctors through a video conference or can even get a second opinion from our expert medical board by using this facility.</p>
		<p>Audited results for transparency: We have commissioned AQA to audit, verify and measure all our treatment outcomes. We publish these verified outcomes regularly so that our patients are aware of our updated success rates and can know what sort of broad treatment outcomes to expect. Published below are our latest audited outcome scores.</p>
		
	
</div>
<div class="pricing-question"><br/>
<h1>Medical Innovation and Technology</h1><br/>
<p>At Dr Batra’s™, we have always kept our patients at the centre of all medical innovations. Our focus has been to innovate in order to get exceedingly good medical outcomes. Listed below are some of our innovations for our patients:</p>
<p>E-medical records: E-medical records were first introduced at Dr Batra’s™ in 1982 and have consistently undergone innovations since then. Some of the benefits of e-medical records are listed below:</p>

	<p>
		Patients do not have to carry their reports to see our doctors.
	</p>
	<p>
		All medical records are saved for the patient’s lifetime.
	</p>
	<p>
		Our state-of-the-art IT system speeds up and improves medical decision making.
	</p>
	<p>
		Centralised recording of data enables patients to consult our doctors in any of our clinics across the world.
	</p>
	<p>
		With over 10 lakh cases in our IT system, cross referencing becomes much faster, thereby deriving a better cure for patients through our past experience.
	</p>
	<p>
		This assures the standardisation of treatment across all doctors in various geographies.
	</p>


	<h3>Scientific evaluation of treatment outcomes:</h3>
	<p style="color: #9CA8B7; line-height: 30px;"> At Dr Batra’s™, we believe in scientific evidence. We have, therefore, developed and incorporated various scientific treatment measurement tools at our clinics. Some of them are listed below:</p>

<h3>Skin analysis of vitiligo through 3D camera</h3>
<p>Video microscope: It is a simple and painless test that magnifies your hair and scalp 200 times. It gives our doctors an idea of the type of hair loss and scalp condition. It can also be used to predict hair loss even before you experience it.</p>
<p>3D imaging technology: We introduced India’s first 3D imaging device to analyse skin health. With advanced optical technology, this device is a scientific breakthrough that allows the skin to be viewed in 2 and 3 dimensions for more effective diagnosis and treatment of skin disorders. This device can show your response to a treatment in the lower layers of your skin much before it can be seen by the naked eye, thereby speeding up your treatment and helping you save money.</p><br/>
</div>
<div class="pricing-question">
<h1>Patient Experience</h1>
<h3>Patient first philosophy</h3>
<p>
We at Dr Batra’s™ put our patients at the heart of everything we do. While we are extremely gratified to be recognised as the world’s largest chain of homeopathy clinics, we continue to strive incessantly to provide world-class and compassionate care to our patients at every step along their journey with us.

To augment medical treatment outcomes and maximise the benefits we offer to our patients, we address every aspect of our patients’ encounter with us, including their physical comfort, as well as their educational and emotional needs.
</p>
<h3>Mystery audits</h3>
<p>We conduct compliance and patient satisfaction audits on a regular basis. Third-party mystery customers visit our clinics and audit every person involved in patient care. The medical audit department also does a regular review of treatments and processes at Dr Batras™. This helps to keep track of our performance as well as maintain the value of the treatment and convenience provided to the patients.

This has resulted in high patient satisfaction rate at all our clinics.</p>
</div>
</div>
</div>
</section>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
<script src="drbValidation.js"></script>

<script type="text/javascript">
    // code for otp
  $('#generateOtpBtn').on('click', function (e) {
    e.preventDefault();
    var phoneNumber = $("#PhoneNumber").val();
    if(phoneNumber.length == 10){

   var datastring = 'mobile='+phoneNumber;
 
    $.ajax({
      url: "sms.php",
      method: "POST",
      data:datastring,
      success: function (response) {
        setTimeout(() => {
          
        }, 2000);
        alert("OTP sent to your mobile");
         console.log(phoneNumber);
        
        $('#generateOtpBtn').text("Regenerate OTP");

      }
    });
   }
   else {
     alert("Please provide a valid 10 digit number");
   }

  });

  // end of otp code
</script>
</body></html>