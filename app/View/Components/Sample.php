<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sample extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sample;
    public function __construct($data)
    {
        //
        $this->sample = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sample');
    }
}
