<?php

namespace App\Livewire;

use Livewire\Component;

class Accordion extends Component
{
    public $show = false;
    public $search;
    
    public function mount($search)
    {
        $this->search = $search;
    }

    public function ToggleRow()
    {
        $this->show = ($this->show == true) ? false : true;
    }

    public function render()
    {
        return view('livewire.accordion');
    }
}
