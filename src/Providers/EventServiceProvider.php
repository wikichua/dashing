<?php

namespace Wikichua\Dashing\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Cache\Events\KeyWritten' => [
            'Wikichua\Dashing\Listeners\LogKeyWritten',
        ],
        'Illuminate\Cache\Events\KeyForgotten' => [
            'Wikichua\Dashing\Listeners\LogKeyForgotten',
        ],
    ];
    public function boot()
    {
    }
}
