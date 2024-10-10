<?php namespace App\Services;


use Illuminate\Support\Facades\Http;
use Modules\Geocode\Entities\Country;

class MsegatSmsService
{
    protected $username;
    protected $password;
    protected $api;

    public function __construct()
    {
        $this->username = config('services.msegat.username');
        $this->password = config('services.msegat.password');
        $this->api = 'https://www.msegat.com/gw/sendsms.php';
    }

    public function sendVerifySms($phoneNumber, $code)
    {
        $message ="كود التفعيل: $code. يرجى استخدامه فورًا.";
        $response = Http::post($this->api, [
            'userName' => $this->username,
            'apiKey' => $this->password,
            'numbers' => $phoneNumber,
            'userSender' => 'Talbinah',
            'msg' => $message,
        ]);

        if ($response->ok()) {
            // SMS sent successfully
            return true;
        }
        // SMS sending failed
        return false;
    }
    public function reminderSms($phoneNumber,$country_id,$data):bool
    {
        $number = fullNumber($phoneNumber,$country_id);
        $message = "مرحبا ، موعدك مع ".$data->start_time." بتلبينة اليوم ".$data->user->full_name.". كن بالوقت.";
        $response = Http::post($this->api, [
            'userName' => $this->username,
            'apiKey' => $this->password,
            'numbers' => $number,
            'userSender' => 'Talbinah',
            'msg' => $message,
        ]);

        if ($response->ok()) {
            // SMS sent successfully
            return true;
        }
        // SMS sending failed
        return false;
    }

    public function sendResetSms($phoneNumber,$country_id,$code)
    {
        $number = fullNumber($phoneNumber,$country_id);
        $message = "رمز تغيير كلمة المرور: $code";
        $response = Http::post($this->api, [
            'userName' => $this->username,
            'apiKey' => $this->password,
            'numbers' => $number,
            'userSender' => 'Talbinah',
            'msg' => $message,
        ]);

        if ($response->ok()) {
            // SMS sent successfully
            return true;
        }
        // SMS sending failed
        return false;
    }
}
