<?php

namespace App\Services\Sms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class KavehNegar implements Sms
{
    private Client $client;
    private string $token;
    private string $sender;

    public function __construct()
    {
        $this->token = config('context.sms.drivers.kavehnegar.token');
        $this->sender = config('context.sms.drivers.kavehnegar.sender');
        $this->client = new Client([
            'timeout' => config('context.sms.drivers.kavehnegar.timeout'),
        ]);
    }

    /**
     * @inheritDoc
     * @throws GuzzleException
     */
    public function send(string $cellphone, string $body): void
    {
        $this->client->post($this->url('sms/send.json'), [
            RequestOptions::FORM_PARAMS => [
                'sender' => $this->sender,
                'receptor' => $cellphone,
                'message' => $body,
            ],
        ]);
    }

    /**
     * @inheritDoc
     * @throws GuzzleException
     */
    public function otp(string $cellphone, string $token): void
    {
        $this->client->post($this->url('verify/lookup.json'), [
            RequestOptions::FORM_PARAMS => [
                'receptor' => $cellphone,
                'template' => 'fasaverify',
                'token' => $token,
            ],
        ]);
    }

    private function url(string $endpoint): string
    {
        return config('context.sms.drivers.kavehnegar.url') . "/v1/$this->token/$endpoint";
    }
}
