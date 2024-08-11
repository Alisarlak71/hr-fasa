<?php

namespace App\Services\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->app->singleton(Sms::class, function () {
            /** @var SmsFactory $factory */
            $factory = $this->app->make(SmsFactory::class);
            return $factory->create(config('context.sms.driver'));
        });
    }
}
