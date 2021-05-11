<?php

namespace Wikichua\Dashing\Facades;

use Illuminate\Support\Facades\Facade;

class Help extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wikichua\Dashing\Repos\Help::class;
    }
}
