<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\Traits\User\WalletMethods;
use Modules\Reservation\Traits\ReservationTrait;
use App\Services\SendingNotificationsService;
use App\Services\SendingMessagesService;
use Modules\Payment\Traits\PaymentTrait;
use Modules\Payment\Entities\PaymentLog;
use Modules\Movement\Traits\MovementTrait;
use Modules\Auth\Entities\User;
use Modules\Wallet\Traits\User\WalletTrait;

class PaymentMethodService{
        use ReservationTrait,PaymentTrait,MovementTrait,WalletMethods,WalletTrait;

    public function getDataPayment(){
        $token=getTokenPayment();
        $payment=Http::baseUrl('https://api.moyasar.com/v1')
                    ->withBasicAuth(config("services.moyasar.key_live"),'')
                    ->get('payments/{$id}')
                    ->json();
        return $payment;
    }
    public function getCapturePayment(){
        $capture = Http::baseUrl('https://api.moyasar.com/v1')
                    ->withHeaders([
                        'Authorization' => 'Basic {$token}',
                    ])
                    ->post('payments/{$id}/capture')
                    ->json();
        return $capture;

    }

    public function getStatusTap($tapId){
        $url = "https://api.tap.company/v2/charges/".$tapId;
        $header = array(config('services.tap.secret'),'accept : application/json');
        $data = $this->curl($url, $method = 'get', $header, $postdata = null, $timeout = 60);
       $status = json_decode($data)->status;
       if ($status == "CAPTURED"){
           return response()->json(['status' => true]);
       }
       return response()->json(['status' => false]);
    }
    public function dataPaymentCallback(){
        $headers= [
            "Content-Type:application/json",
            config('services.tap.secret'),
        ];
        
         
        $ch=curl_init();
        $url="https://api.tap.company/v2/charges/".tapId();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        $response=json_decode($output);
        if($response&&isset($response->errors)){
         return $response->errors;
        }
        return $response;

    }
    public function callback($reservationId){//type=1 : reservation , type=2 : wallet
        $response = $this->dataPaymentCallback();
        if(isset($response->errors)) return $response->errors;
        $reservation = Reservation::where('id',$reservationId)->first();
        $doctor=User::where('id',$reservation->doctor_id)->first();
        $paymentLog = PaymentLog::create(['reservation_id'=>$reservationId,'transaction_id'=>$response->id,'customer_id'=>$response->customer->id,'source'=>json_encode($response->source),'status'=>$response->status]);
        if($response->status == 'CAPTURED'){
            $this->paidReservation($doctor,$reservation);
            $dataNotification = [
                'title'=> trans('messages.New Reservation'),
                'body'=> trans('messages.You have received a new reservation from : ') . $reservation->user->full_name,
                'reservation'=>$reservation,
                'doctor_name'=>$reservation->doctor->full_name,
                'doctor_image'=>$reservation->doctor->image,
            ];
            $type='New Reservation';
            app(SendingNotificationsService::class)->sendNotification($dataNotification,$reservation->doctor_id,$type);

            $capture = Http::baseUrl('https://api.moyasar.com/v1')
                    ->withHeaders([
                        'Authorization' => 'Basic {$token}',
                    ])
                    ->post('payments/{$id}/capture')
                    ->json();
            //send to email doctor
            $data=[
                'email'=>$reservation->doctor->email,
                'type'=>'new-reservation',
                'user'=>$reservation->user->full_name,
                'user_birth_date'=>$reservation->user->profile ? $reservation->user->profile->birth_date : null,
                'doctor'=>$reservation->doctor->full_name,
                'reservation_date'=>$reservation->date,
                'reservation_start_time'=>$reservation->start_time,
                'reservation_end_time'=>$reservation->end_time,
                'reservation_problem'=>$reservation->problem,
                'to'=>'doctor'
            ];
            app(SendingMessagesService::class)->sendingMessage($data);

            //send to email user
            $data=[
                'email'=>$reservation->user->email,
                'type'=>'new-reservation',
                'user'=>$reservation->user->full_name,
                'doctor'=>$reservation->doctor->full_name,
                'reservation_date'=>$reservation->date,
                'reservation_start_time'=>$reservation->start_time,
                'reservation_end_time'=>$reservation->end_time,
                'to'=>'user'
            ];
            app(SendingMessagesService::class)->sendingMessage($data);

            //add a movement
            $nameMovement = trans('messages.A reservation has been added via credit card');
            $typeMovement = '-1';
            $role = 'user';
            $model = 'not wallet';
            $this->createMovement($model,$reservation->price,$reservation->doctor_id,$nameMovement,$typeMovement,$role,$reservation->id,$paymentLog->id);
    
            return $reservation;
        }else{
            return $response->status;
        }
                
            
    }
    public function callbackWallet($id,$price){
        $response = $this->dataPaymentCallback();
        if(isset($response->errors)) return $response->errors;
        $wallet = Wallet::where('id',$id)->first();
        $paymentLog = PaymentLog::create(['wallet_id'=>$wallet->id,'transaction_id'=>$response->id,'customer_id'=>$response->customer->id,'source'=>json_encode($response->source),'status'=>$response->status]);
        if($response->status == 'CAPTURED'){
            $model=new Wallet();//model->wallet
            $this->addIntoWalletCallback($model,$price,$id);

        $capture = Http::baseUrl('https://api.moyasar.com/v1')
                ->withHeaders([
                    'Authorization' => 'Basic {$token}',
                ])
                ->post('payments/{$id}/capture')
                ->json();
        //add a movement
        $nameMovement = trans('messages.adding into wallet');
        $typeMovement = '1';//Deposition
        $role = 'user';
        $this->createMovement($model,$price,$wallet->user_id,$nameMovement,$typeMovement,$role,null,$paymentLog->id);
        return $wallet;
        }else{
            return $response->status;
        } 
    }
    
    

}
