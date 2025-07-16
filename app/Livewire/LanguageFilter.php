<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageFilter extends Component
{
    
    public $SelectedFilter ='';

    public function ChangeFilter($newfilter)
    {
        $this->SelectedFilter = $newfilter;
        return $this->dispatch("FilterChanged", NewFilter: $this->SelectedFilter);
    }

    public function render()
    {

        return view('livewire.language-filter');
    }
}
