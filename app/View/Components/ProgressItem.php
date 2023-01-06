<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgressItem extends Component
{
    public $label, $done, $last, $link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $done, $link = '#', $last = null)
    {
        $this->label = $label;
        $this->done = $done;
        $this->last = $last;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-item');
    }
}
