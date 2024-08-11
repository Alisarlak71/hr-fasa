<?php

namespace App\Jobs;


use App\Services\Sms\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $cellphone;
    public string $body;

    public function __construct(string $cellphone, string $body)
    {
        $this->cellphone = $cellphone;
        $this->body = $body;
    }

    public function handle(Sms $sender)
    {
        $sender->send($this->cellphone, $this->body);
    }
}
