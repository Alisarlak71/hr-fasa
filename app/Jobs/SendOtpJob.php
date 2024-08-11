<?php

namespace App\Jobs;

use App\Services\Sms\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $cellphone;
    public string $token;

    public function __construct(string $cellphone, string $token)
    {
        $this->cellphone = $cellphone;
        $this->token = $token;
    }

    public function handle(Sms $sender)
    {
        $sender->otp($this->cellphone, $this->token);
    }
}
