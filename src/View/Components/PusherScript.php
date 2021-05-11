<?php

namespace Wikichua\Dashing\View\Components;

use Illuminate\View\Component;

class PusherScript extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        $driver = config('dashing.broadcast.driver');
        if ('' == $driver) {
            return '';
        }
        $config = config('broadcasting.connections.'.$driver);
        $my_encrypted_id = sha1(auth()->check() ? auth()->id() : 0);
        $app_key = $config['key'];
        $cluster = $config['options']['cluster'] ?? '';
        $app_logo = asset('sap/logo.png');
        $app_title = config('app.name').' Web Notification';
        $channel = sha1(config('app.name'));
        $general_event = sha1('general-'.app()->getLocale());

        return view('dashing::components.pusher-script')->with(compact(
            'my_encrypted_id',
            'cluster',
            'app_key',
            'app_logo',
            'app_title',
            'channel',
            'general_event',
            'driver'
        ));
    }
}
