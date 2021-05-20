<?php

namespace Wikichua\Dashing\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        $alerts = app(config('dashing.Models.Alert'))->query()
            ->checkBrand()->orderBy('created_at', 'desc')->where('receiver_id', auth()->id())->take(25)->get();
        $unread_count = $alerts->where('status', 'u')->count();

        return view('dashing::components.notification')->with(compact('alerts', 'unread_count'));
    }
}
