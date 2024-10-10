<?php

namespace App\Jobs;

use App\Services\MsegatSmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMsegatSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $phone_no;
    protected $country_id;
    protected $type;
    protected $data;


    public function __construct($phone_no, $country_id,$data,$type=null)
    {
        $this->phone_no = $phone_no;
        $this->country_id = $country_id;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(MsegatSmsService $sms_service): void
    {
        $sms_service->reminderSms($this->phone_no, $this->country_id,$this->data);

    }

}
