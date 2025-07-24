<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Module;
use App\Models\lessonContent;
use LanguageCompiler\LanguageDataCompiler;

use function PHPSTORM_META\type;

class EditController extends Controller
{
    //
    private function getEloquentModelFromString($type)
    {
        if($type == "Course"){
            return Course::class;
        }
        elseif($type == "Module"){
            return Module::class;
        }
        elseif($type == "lessonContent")
        {
            return lessonContent::class;
        }
        else{
            return false;
        }
    }

    public function index($id,$type)
    {
        $id = intval($id);

        $currentUser = Auth::user();

        $class = $this->getEloquentModelFromString($type);
        
        $instance = $class::find($id);

        $SupportedLanguages = config('languages');
        $SelectedLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$currentUser->selected_language)); //[$SupportedLanguages[$currentUser->selected_language]];
        $TranslatableParts = [];
        $OldTranslatableValues = [];

        if($currentUser->is_admin)
        {
            //gives access to all languages to admins
            $SelectedLanguages = $SupportedLanguages;
        }

        foreach($SelectedLanguages as $language)
        {
                foreach($instance->GetTranslatables() as $translatable)
                {
                    $uniqueId = $translatable . $language['Language_code'];
                    $TranslatableParts[] = $uniqueId;
                    $OldTranslatableValues[$uniqueId] = $instance->$uniqueId;

                }
        }

        return view('edit-translations',[
            'email' => $currentUser->email,
            'Language' => $currentUser->selected_language,
            'is_admin' => $currentUser->is_admin,
            'translatable_type' => $type,
            'translatable_id' => $id,
            'translatables' => $TranslatableParts,
            'old_values' => $OldTranslatableValues
        ]);
    }

    public function store(){
        $data = request()->all();
        $type = $data['type'];
        $id = intval($data['id']);
        $currentUser = Auth::user();


        $class = $this->getEloquentModelFromString($type);
        $SupportedLanguages = config('languages');
        $SelectedLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$currentUser->selected_language));

        if($currentUser->is_admin)
        {
            //gives access to all languages to admins
            $SelectedLanguages = $SupportedLanguages;
        }

        $instance = $class::find($id);
        foreach($SelectedLanguages as $language)
        {
            foreach($instance->GetTranslatables() as $translatable){
                $loc = $translatable . $SupportedLanguages[$language['Language']]['Language_code'];
                $instance->update([ $loc => $data[$loc] ]);
            }
        }

        return redirect('/');
    }
}
