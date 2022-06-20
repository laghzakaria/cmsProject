<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    public $src;
    public $title;
    public $description;
    public $content;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src="",$title="",$description="",$content="")
    {
        $this->src=$src;
        $this->title=$title;
        $this->description=$description;
        $this->content=$content;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
