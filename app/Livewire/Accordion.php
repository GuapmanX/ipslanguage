<?php

namespace App\Livewire;

use Livewire\Component;

class Accordion extends Component
{
    public $show = false;
    public $text;
    public $percentage;
    public $language;
    
    public function mount($text,$language,$percentage)
    {
        $this->text = $text;
        $this->language = $language;
        $this->percentage = $percentage;
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
