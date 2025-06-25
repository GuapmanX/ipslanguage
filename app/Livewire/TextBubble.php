<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TextBubble extends Component
{
    public $name;
    public $surname;

    public function mount($name,$surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function render()
    {
        return view('livewire.text-bubble');
    }
}
