<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Module;
use App\Models\lessonContent;

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
        $SelectedLanguage = $SupportedLanguages[$currentUser->selected_language];
        $TranslatableParts = [];
        $OldTranslatableValues = [];

        foreach($instance->GetTranslatables() as $translatable)
        {
            $uniqueId = $translatable . $SelectedLanguage['Language_code'];
            $TranslatableParts[] = $uniqueId;
            $OldTranslatableValues[$uniqueId] = $instance->$uniqueId;

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
        $language = $data['language'];

        $class = $this->getEloquentModelFromString($type);
        $SupportedLanguages = config('languages');

        $instance = $class::find($id);
        foreach($instance->GetTranslatables() as $translatable){
            $loc = $translatable . $SupportedLanguages[$language]['Language_code'];
            $instance->update([ $loc => $data[$loc] ]);
        }

        return redirect('/');
    }
}
