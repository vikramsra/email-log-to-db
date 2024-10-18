<?php

namespace Vikramsra\EmailLogToDb;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSent;
use Vikramsra\EmailLogToDb\Listeners\LogSentEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageSent::class => [
            LogSentEmail::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
