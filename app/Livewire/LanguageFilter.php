<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use LanguageCompiler\LanguageDataCompiler;
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
        $SupportedLanguages = config('languages');
        $user = Auth::user();
        $selectedLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$user->selected_language));

        return view('livewire.language-filter',[
            'SupportedLanguages' => $user->is_admin ? $SupportedLanguages : $selectedLanguages
        ]);
    }
}
