<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $style;

    /**
     * Create a new component instance.
     */
    public function __construct($style = 'fill')
    {
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.button');
    }
}
