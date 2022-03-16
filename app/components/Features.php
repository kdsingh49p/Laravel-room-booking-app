<?php
namespace App\components;

 class Features {
public static function sendEmailNotification($to,$subject,$msg){
      Yii::$app->mailer->compose()
    ->setFrom('info@needindia.co.in')
    ->setTo($to)
    ->setSubject($subject)
    ->setTextBody($msg)
//    ->setHtmlBody('<b>HTML content</b>')
    ->send();
    return $message = Yii::$app->mailer->compose();   

  }
  public static function sendEmailNotificationHtml($to,$subject,$msg){
      Yii::$app->mailer->compose()
    ->setFrom('info@needindia.co.in')
    ->setTo($to)
    ->setSubject($subject)
    // ->setTextBody($msg)
   ->setHtmlBody($msg)
    ->send();
    return $message = Yii::$app->mailer->compose();   

  }
public static function ConfigSms($mobile="", $messageOrder=""){
        $authKey="Need01";
        $mobileNumber = $mobile;
        $message = $messageOrder;
        $senderId = "NEEDIM";
        $route = 2;
        $postData = array(
        'user' => $authKey,
        'password' => 'EVQGCD67',
        'msisdn' => $mobileNumber,
        'sid' => $senderId,
        'msg' => $message,
        'fl' => 0,
        'gwid' => $route,
        );
        // print_r($postData);
        // exit;
        $url="http://trackmysms.com/vendorsms/pushsms.aspx";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
        echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        // var_dump($output);
        // exit;
        if($output){
            $return['output'] = $output;
            if($output==1){
                return TRUE;
            }
        }
  }
}