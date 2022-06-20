<?php

namespace App\View\Components;

use Illuminate\View\Component;

class navLink extends Component
{
    public $type;
    public $tab;
    public $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type,$tab,$active)
    {
        $this->type=$type;
        $this->tab=$tab;
        $this->active=$active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
