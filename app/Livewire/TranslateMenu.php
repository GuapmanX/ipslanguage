<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\On;
use LanguageCompiler\LanguageDataCompiler;
use Illuminate\Support\Facades\Auth;

class TranslateMenu extends Component
{

    public $Filter = "All";

    public function mount($default)
    {
        $this->OnTranslateFilterChanged($default);
    }

    public function CalulateTranslateAverage($arr)
    {
        $TotalPercent = 0;
        foreach($arr as $Data)
        {
            $TotalPercent += $Data['TranslatedPercent'];
        }
        return round($TotalPercent/count($arr));
    }

    #[On('FilterChanged')]
    public function OnTranslateFilterChanged($NewFilter){
        $this->Filter = $NewFilter;
    }

    public function render()
    {
        $SupportedLanguages = config('languages');
        $CurrentUser = Auth::user();

        $FilteredLanguages = [];
        if($this->Filter == "All")
        {
            if($CurrentUser->is_admin){
                $FilteredLanguages = $SupportedLanguages;
            }
            else
            {
                $FilteredLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$CurrentUser->selected_language));
            }
        }
        else
        {
            $FilteredLanguages[] = $SupportedLanguages[$this->Filter];
        }

        $courses = Course::with('Modules.Lessons.LessonContent')->get();
        
        $Tree = LanguageDataCompiler::CreateTranslatedTree($courses,$FilteredLanguages);
        return view('livewire.translate-menu',[
         'Courses' => $Tree
        ]
    );
    }
}
