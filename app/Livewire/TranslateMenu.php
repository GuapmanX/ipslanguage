<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models;
use App\Models\Course;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\On;
use LanguageCompiler;
use LanguageCompiler\LanguageDataCompiler;
use Illuminate\Support\Facades\Auth;

class TranslateMenu extends Component
{
    //public $TranslateData = Course::all();


    public $Filter = "All";

    public function mount($default)
    {
        $this->OnTranslateFilterChanged($default);
    }

    public function DrawLessonContent($children)
    {
        $canvas = "";
        foreach($children as $Content)
        {
             $canvas .= $this->DrawAccordionMenu(
                false,
                $Content['Name'],
                $this->CalulateTranslateAverage($Content['TranslateData']),
                "bg-lime-200",
                "",
                $Content['id'],
                "lessonContent"
            );
        }
        return $canvas;
    }


    public function DrawModules($children){
        $canvas = "";
        foreach($children as $Module)
        {
            $canvas .= $this->DrawAccordionMenu(
                false,
                $Module['Name'],
                $this->CalulateTranslateAverage($Module['TranslateData']),
                "bg-amber-100",
                $this->DrawLessonContent($Module['Children']),
                $Module['id'],
                "Module"
            );
        }
        return $canvas;
    }

    public function DrawCourses($Courses)
    {
        foreach($Courses as $Course){
                $this->DrawAccordionMenu(
                    true,
                    $Course['Name'],
                    $this->CalulateTranslateAverage($Course['TranslateData']),
                    "bg-white",
                    $this->DrawModules($Course['Children']),
                    $Course['id'],
                    "Course"
            );
        }
    }

    public function DrawAccordionMenu($Render,$Language,$Percent,$Color,$WhatsInDropdown,$id = 0,$type = "nothing"){

        //$editButton = "<x-edit-button href=\"/edit/id={$id}/type={$type}\">edit</x-edit-button>";
        $editButton = "<x-edit-button href=\"/edit/{$type}/{$id}\">edit</x-edit-button>";

        $Menu = "<div>
                    <x-accordion>
                    <x-slot:bgColor>
                        {$Color}
                    </x-slot:bgColor>
                        <x-slot:language>
                            {$Language}
                            {$editButton}
                        </x-slot:language>

                        <x-slot:percentage>
                                {$Percent}
                        </x-slot:percentage>

                        <x-slot:text>
                            {$WhatsInDropdown}
                        </x-slot:text>
                </x-accordion>
            </div>";

        if($Render)
        {
            echo Blade::render($Menu);
        }
        else
        {
            return $Menu;
        }

    }

    public function CalulateTranslateAverage($arr)
    {
        $TotalPercent = 0;
        foreach($arr as $Data)
        {
            $TotalPercent += $Data['TranslatedPercent'];
        }
        return $TotalPercent/count($arr);
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
