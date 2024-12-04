<?php
$phone ='09563472173';

 function send($phone,$message,$key){
   $send = json_decode(file("https://MingSms.mingming13.repl.co?phone=$phone&message=$message&key=$key"));
   return $send->status==200?true:false;
 }

$message=urlencode('Your OTP is 32131232');
$key = 'reporma_tagumpay_scholar';

send($phone,$message,$key);

?>