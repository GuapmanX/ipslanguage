<?php

namespace App\Livewire;

use App\Models\Course;
use LanguageCompiler\LanguageDataCompiler;
use Livewire\Component;

class UserDisplay extends Component
{

    public $users;
    public $courses;

    public function GetChildrenPercent($arr){
            $totalPercentage = 0;
            $totalAmount = 0;
            foreach($arr as $Translatable){
               $totalPercentage += $Translatable['TranslatedPercent'];
               $totalAmount += 1;
            }
        return $totalPercentage/$totalAmount;
    }

    public function GetLanguagePercentage($language)
    {
        $SupportedLanguages = config('languages');
        $Languages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$language));
        $Tree = LanguageDataCompiler::CreateTranslatedTree($this->courses,$Languages);


        $totalPercentage = 0;
        $totalAmount = 0;

        foreach($Tree as $Course)
        {
            $totalPercentage += $this->GetChildrenPercent($Course['TranslateData']);
            $totalAmount += 1;

            foreach($Course['Children'] as $Module)
            {
                $totalPercentage += $this->GetChildrenPercent($Module['TranslateData']);
                $totalAmount += 1;

                foreach($Module['Children'] as $Content)
                {
                    $totalPercentage += $this->GetChildrenPercent($Content['TranslateData']);
                    $totalAmount += 1;
                }
            }
        }
        return $totalPercentage/$totalAmount;
    }

    public function mount($users)
    {
        $this->users = $users;
        $this->courses = Course::with('Modules.Lessons.LessonContent')->get();
    }

    public function render()
    {

        //$totalPercentage = $this->GetLanguagePercentage('German');
        return view('livewire.user-display',[
            'users' => $this->users,
        ]);
    }
}
