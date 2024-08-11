<?php

namespace App\Services\Sms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Magfa implements Sms
{
    private string $password;
    private string $username;
    private string $domain;
    private string $sender;

    public function __construct()
    {
        $this->username = config('context.sms.drivers.magfa.username');
        $this->password = config('context.sms.drivers.magfa.password');
        $this->domain = config('context.sms.drivers.magfa.domain');
        $this->sender = config('context.sms.drivers.magfa.sender');
    }

    /**
     * @inheritDoc
     * @param string $cellphone
     * @param string $body
     */
    public function send(string $cellphone, string $body): void
    {
        $url = config('context.sms.drivers.magfa.url') . 'send';

        $data = [
            "senders" => [$this->sender],
            "messages" => [$body],
            "recipients" => [$cellphone]
        ];
        $ch = curl_init($url);

        $header = ['Accept: application/json'];
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . "/" . $this->domain . ":" . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $post_data = json_encode($data);
        $header[] = 'Content-Type: application/json';

        $post_data = gzencode($post_data);
        $header[] = 'Content-Encoding: gzip';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * @inheritDoc
     * @param string $cellphone
     * @param string $token
     */
    public function otp(string $cellphone, string $token): void
    {
        $url = config('context.sms.drivers.magfa.url') . 'send';

        $data = [
            "senders" => [$this->sender],
            "messages" => [trans('messages.sms.otp_template', ['token' => $token])],
            "recipients" => [$cellphone]
        ];
        $ch = curl_init($url);

        $header = ['Accept: application/json'];
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . "/" . $this->domain . ":" . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $post_data = json_encode($data);
        $header[] = 'Content-Type: application/json';

        $post_data = gzencode($post_data);
        $header[] = 'Content-Encoding: gzip';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
