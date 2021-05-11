<?php

namespace Wikichua\Dashing\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    public $menu;
    public $activePatterns;
    public $groupActive;

    public function __construct($menu = '', $activePatterns = [])
    {
        $this->menu = $menu;
        $this->activePatterns = $activePatterns;
    }

    public function render()
    {
        if ('' == $this->menu) {
            return view('dashing::components.menu');
        }
        $group = '/'.implode('|', $this->activePatterns).'/';
        $this->groupActive = preg_match($group, request()->route()->getName()) ? true : false;

        return view('dashing::components.menus.'.$this->menu);
    }
}
