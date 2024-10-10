<?php

namespace App\Services;

use App\Jobs\ExternalApiJob;
use App\Mail\SendingMessage;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;
use Modules\Payment\Traits\PaymentTrait;

// use Illuminate\Support\Facades\Mail;

class SendingMessagesService
{
    use PaymentTrait;
    public function sendToEmail($data)
    {
        $this->curl('https://i3mal.com/api/email','post',[],$data);
    //    dispatch(new ExternalApiJob($email,$type,$data));

    }

    public function sendToPhone($data)
    {
        // $BRAND_NAME = config('app.name');
        // $basic = new \Vonage\Client\Credentials\Basic(config('services.vonage.key'), config('services.vonage.pass'));
        // $client = new \Vonage\Client($basic);
        // $phoneCode = $this->findIntroPhone($user->country_id);
        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($phoneCode . $user->phone_no, $BRAND_NAME, $data['code'])
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }


    public function sendToPhoneWattsapp($phone_no, $message)
    {
        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $twilioNumber = config('services.twilio.twilio_from');

        $twilio = new Client($accountSid, $authToken);

        $messageTest = $twilio->messages
            ->create("whatsapp:+201150585593", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => 'Your appointment is coming up on July 21 at 3PM'
                )
            );
        $twilio->messages->create('+201094224862', [
            'from' => $twilioNumber,
            'body' => $messageTest
        ]);

    }

    public function sendMessage($data)
    {
        if (isset($data['email'])) {
            $this->sendToEmail($data);
        }
        return true;
    }

    public function sendingMessage($data)
    {
        $resultSending = $this->sendMessage($data);
        if (!$resultSending) return serverError(0);
        return $resultSending;
    }
}
