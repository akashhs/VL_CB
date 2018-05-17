<?php

//var_dump($_POST);
    $mobile= $_POST['phon_number'];
   $smsgatewaycenter_com_url = ""; //SMS Gateway Center API URL
    //$smsgatewaycenter_com_mask = "SGCSMS"; //Your Approved Sender Name / Mask
    $api_key = "";


function smsgatewaycenter_com_Send($mobile, $sendmessage, $debug=false){
        global $smsgatewaycenter_com_url,$api_key,$parameters;        
        $parameters.= 'method=sms';
        $parameters.= '&api_key='.$api_key;
        $parameters.= '&to='.urlencode($mobile);
        $parameters.= '&sender=';
        $parameters.= '&message='.urlencode($sendmessage);
        $apiurl =  $smsgatewaycenter_com_url.$parameters;
        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
       
        if ($debug) {
          //  echo "Response: <br><pre>" . $curl_scraped_page . "</pre><br>";
        }
        return($curl_scraped_page);
    }

    /////////////////////////////////////////////////////////////////////////////
    //      Function to generate and append OTP code within the message        //
    /////////////////////////////////////////////////////////////////////////////
    function smsgatewaycenter_com_OTP($length = 4, $chars = '0123456789'){
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)){
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1}) $string .=  $r;
        }
        return $string;
    }

    
    $debug = true; //Set to true if you want to see the response

?>
