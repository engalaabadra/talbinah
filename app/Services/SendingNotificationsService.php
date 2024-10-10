<?php

namespace App\Services;
use Modules\Auth\Entities\User;
use Modules\Notification\Entities\Notification;

class SendingNotificationsService{
    public function sendNotification($data,$user_id,$type=null){
        $notification=collect();
        if(!$type) $typeNotification = $data['type'];
        else $typeNotification = $type;

        $user=User::where('id',$user_id)->first();
        if(!$user) return 404;
        $fcmToken = $user->fcm_token;
        $data['user_id']=$user_id;
        if(!$type) $enteredData=exceptData($data,['reservation_id','reservation','visit_id','type','start_time','end_time','date','doctor_name','doctor_image']);
        else $enteredData=exceptData($data,['reservation','visit_id','doctor_name','doctor_image']);

        if($type) $notification = Notification::create($enteredData);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('services.firebase.server_key');
            $info = [
                "to" => $fcmToken,
                "data" => [
                    "title" => $data['title'],
                    "body" => $data['body'], 
                    'type'=>$typeNotification,
                    'reservation_id'=>isset($data['reservation']) ? $data['reservation']->id : null,
                    'start_time'=>isset($data['reservation']) ? $data['reservation']->start_time : null,
                    'end_time'=>isset($data['reservation']) ? $data['reservation']->end_time : null,
                    'date'=>isset($data['reservation']) ? $data['reservation']->date : null,
                    'doctor_name'=>isset($data['doctor_name']) ? $data['doctor_name'] : null,
                    'doctor_image'=>isset($data['doctor_image']) ? $data['doctor_image'] : null,
                    "sound" => "default",
                    "click_action"=>"Message"
                ],
                'notification'=>[
                    "title" => $data['title'],
                    "body" => $data['body'],
                    "sound" => "default"
                ]
            ];
        
        $encodedData = json_encode($info);
   
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return 'حدث خطا ما اثناء الارسال من خلال الفايبربيس';
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        if($type) $notification->type = $typeNotification;
        if(!$type){
            $notification['title'] = $data['title'];
            $notification['body'] = $data['body'];
            $notification['user_id'] = $user_id;
            $notification['type'] = $typeNotification;
        }
        return json_decode($notification);
    }
}
