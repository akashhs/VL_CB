
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="build/botui.min.css">
  <link rel="stylesheet" href="build/botui-theme-default.css">
  <link rel="stylesheet" href="build/styles.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <style type="text/css">
      input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
  </style>
</head>

<body>
  <div class="botui-app-container" id="hello-world">
    <bot-ui></bot-ui>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="build/botui.js"></script>
  <script>
    var botui = new BotUI('hello-world');
    var data = [] ;
    var name ; var email;
    var phone ;
    var otp; var otp_ver;
    var city;
    // botui.message.add({
    //   loading: true
    // }).then(function (index) {
    //   setTimeout(function () {
    //     botui.message.update(index, {
    //       content: 'Hello World from bot!',
    //       loading: false
    //     }).then(function () {
    //       botui.message.add({
    //         delay: 2000,
    //         loading: true,
    //         content: 'Delayed Hello World'
    //       });
    //     });
    //   }, 5000);
    // });

    botui.message.add({
      content: 'Hi, Welcome to valueleaf'
    }).
    then(async function (res) {
      console.log('res', res)
      var slog_words = ["fuck off" , "Fuck Off"];
      var reg = /^[a-zA-Z]*\s[a-zA-Z]*$/;
      var name1;
      name1 = await askName();
      console.log('name1: ', name1);
      for(var name in slog_words){
        console.log('words',slog_words[name])
      }
      if(reg.test(name1.value) == true && name1.value != "fuck off" && name1.value != "Fuck Off"){
        //data['phone'] = res.value;
        console.log(name1.value);
        console.log('working..');
        return name1;
      
      }
       else {
        do {
          name1 = await name_ver();
         console.log('name_ver code', name1);
          //data['phone'] = phone.value;
        } while(reg.test(name1.value) == false || name1.value =="fuck off" || name1.value == "Fuck Off"); 
        return name1; 
        }
    })
    .then(function (res) {
      //data.push(res.value);
      name = res.value;
      ///console.log(name);

      botui.message.add({
        content: 'Hi ' + res.value
      })
    }).then(async function (res) {
      console.log('res', res)
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      var email1;
      email1 = await askEmail();
      console.log('email1: ', email1);
      if(reg.test(email1.value) == true){
        //data['phone'] = res.value;
        console.log('working..');
        return email1;
      }
       else {
        do {
          email1 = await email_ver();
         console.log('email_ver code');
          //data['phone'] = phone.value;
        } while(reg.test(email1.value)  == false); 
        return email1; 
        }
    }).then(async function (res) {
      console.log('after regular expression', res);
      var fillter = /^[6-9]\d{9}$/;
      email = res.value;
      var phone1 = await askPhone();
      if(phone1.value.length == 10){
          console.log('fl',fillter.test(phone1.value));
        //data['phone'] = res.value;
        return phone1;
      } else {
        do {
          phone1 = await phone_ver(res)
          console.log('phone: ', typeof(phone1.value));
          console.log('fl1',fillter.test(phone1.value));
          //data['phone'] = phone.value;
        } while(phone1.value.length !=10); 
        return phone1; 
      }
    }). then(function(res) {
       phone = res.value;
       console.log('phone',phone);
       $.ajax({

            url: 'sms.php',  
            type: "POST",
            data: {'phon_number': phone},
            // dataType: 'Text',
            success: function(data) {
              otp_ver =data;
             // alert(data);
                console.log("---------------------");
               // return data;
               // alert("Mesage has been sent to " + phone);
                //window.location.href = 'test.php';
                // $('.results').html(formdata.name);
            return otp_ver;
            },
            error: function(data) {
                alert('Please enter the correct data')
            }
        });
        
    }).then(async function (res) {
      //email = res.value;
      var otp1 = await otpValidate(res);
      console.log('otp', otp1)
      var otp_re = otp_ver;
      console.log(otp_re);
      if (otp1.value.length != 4 && otp1.value == otp_re ) {
           console.log(otp1.value == otp_re);
          return otp1 ;
      } else {
          do {
              otp1 = await otp_veri(res);
              console.log('otp1', otp1);
            }while(otp1.value != otp_re);
          // return otp1; 
        }
      console.log('otp2', otp1.value);
      return otp1; 
    }).then(function (res) {
      otp = res.value;
      botui.message.add({
        icon : 'globe',
        loading: true,
        delay: 1000,
        content: 'Please Enter your City'
      });

    }).then(function () {         
      return botui.action.text({
        delay: 2000,
        action: {
          cssClass: 'search',
          placeholder: 'Enter city name here'
        }
      })
    }).then(function (res) {
      //console.log('city ', res)
      //data.push(res.value);
      city = res.value;
      console.log(name);
      console.log(email);
      console.log(phone);
      console.log(otp);
      console.log(city);
        var formdata = 'name=' + name +
            '&email=' + email +
            '&phon_number=' + phone;
      //console.log(data);
       var formdata_json = JSON.stringify(formdata);
        var json_data = "pTableData=" + formdata_json;
        //console.log(formdata_json);
        $.ajax({

            url: 'config.php',  
            type: "POST",
            data: {'name': name , 'email': email , 'phon_number': phone, 'otp':otp, 'city': city},
            // dataType: 'Text',
            success: function(data) {
                console.log("---------------------");
                alert("data has been sent" + formdata_json);
               // window.location.href = 'config.php';
                // $('.results').html(formdata.name);
               

            },
            error: function(data) {
                alert('Please enter the correct data')
            }

        });

    }).then(function () {
      botui.message.add({
        loading: true,
        delay: 1000,
        content: "Thank you, Our Customer Support Will call you soon"
      })
    }).then(function () {
      botui.message.add({
        loading: true,
        delay: 1000,
        content: 'Try our new product ![valueleaf](http://valueleaf.com/img/logo.png)'
      })
    })
    // .then(function () {
    //   botui.message.add({
    //     // loading: true,
    //     // delay: 2000,
    //     content: '[valueleaf](https://valueleaf.com)'
    //   })
    // })
    .then(function () {
      botui.action.button({
        delay:2000,
        action: [{
          text: 'Thank you',
          value: 'nohing'
        }]
      })
    });
    function askName(res){

      botui.message.add({
        loading: true,
        delay: 2000,
        content: "Please enter your Name"
      })
      test1 =  botui.action.text({
        loading: true,
        delay: 3000,
        action: {
          icon : 'user',
          placeholder: 'Enter your name please'
        }
      });
        return test1;
       }
        function name_ver(res){

      botui.message.add({
        loading: true,
        delay: 2000,
        content: "Please Enter Valid Name"
      })
      test1 =  botui.action.text({
        loading: true,
        delay: 3000,
        action: {
          icon : 'user',
          placeholder: 'Enter your name please'
        }
      });
        return test1;
       }
    function askPhone(res) {
     
      //data.push(res.value);
      // email = res.value;
      //console.log(email);
      botui.message.add({
        loading: true,
        delay: 2000,
        content: 'Please Enter your Phone Number'
      });
        test = botui.action.text({
        delay:2500,
        action: {
           icon: 'phone',
          sub_type: 'number',
          placeholder: 'Phone Number',
          
        }
      })
  
      // console.log('Promise test:',test)
      return test

    }
    function phone_ver(res) {
     
      //data.push(res.value);
      // email = res.value;
      //console.log(email);
      botui.message.add({
        loading: true,
        delay: 2000,
        content: 'Please give a valid 10-digit phone number. e.g.. 9876543210'
      });
        test = botui.action.text({
        delay:2500,
        action: {
          icon: 'phone',
          sub_type : 'number',
          placeholder: 'Phone Number'
        }
      })
  
      // console.log('Promise test:',test)
      return test

    }
     function askEmail() {
      botui.message.add({
        loading: true,
        delay: 2000,
        content: "Please enter your email"
      });
     test = botui.action.text({
        delay: 3000,
        action: {
          //sub_type: 'email',
          icon: 'envelope',
          placeholder: 'Enter Your email'
        }
     })
  
      // console.log('Promise test:',test)
      return test

    }
    function email_ver() {
     botui.message.add({
        loading: true,
        delay: 2000,
        content: "Please give a enter Valid Email id. Ex john@XXX.com"
      });
     test = botui.action.text({
        delay: 3000,
        action: {
          //sub_type: 'email',
          icon :'envelope',
          placeholder: 'Enter Your email'
        }
     })
  
      // console.log('Promise test:',test)
      return test;

    }
  function otpValidate() {
      botui.message.add({
        loading: true,
        delay: 1000,
        content: 'Please Enter your OTP'
      });
      test =  botui.action.text({
        delay: 2000,
        action: {
          icon : 'unlock',
          placeholder: 'OTP here'
        }
      })
      return test
    }
    function otp_veri() {
      botui.message.add({
        loading: true,
        delay: 1000,
        content: 'Looks like you have entered a wrong OTP!!!.Try again...'
      });
      test =  botui.action.text({
        delay: 2000,
        action: {
          icon : 'unlock',
          placeholder: 'OTP here'
        }
      })
      return test
    }
  </script>

</body>
</html>