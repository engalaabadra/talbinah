<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Modules\Payment\Traits\PaymentTrait;

class ExternalApiJob implements ShouldQueue
{
    use PaymentTrait;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email;
    public $type;
    public $data;
    /**
     * Create a new job instance.
     */
    public function __construct($email,$type,$data)
    {
        $this->email = $email;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->curl('https://i3mal.com/api/email/'.$this->email.'/'.$this->type.'/'.$this->data);
        
    }
}
