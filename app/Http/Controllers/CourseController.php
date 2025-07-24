<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LanguageCompiler\LanguageDataCompiler;

use function Pest\Laravel\instance;

class CourseController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    private function getOnlyEnglish(Course $instance){
        $engVals = [];
        foreach($instance->getTranslatables() as $translatable){
            $engVals[$translatable] = $instance->$translatable;
        }
        return $engVals;
    }

    private function getTranslatables(array $SelectedLanguages, Course $instance)
    {
        $TranslatableParts = [];
        $OldTranslatableValues = [];

        foreach($SelectedLanguages as $language)
        {
                foreach($instance->GetTranslatables() as $translatable)
                {
                    $uniqueId = $translatable . $language['Language_code'];
                    $TranslatableParts[] = $uniqueId;
                    $OldTranslatableValues[$uniqueId] = $instance->$uniqueId;

                }
        }
        return [
            'TranslatableParts' => $TranslatableParts,
            'OldTranslatableValues' => $OldTranslatableValues
        ];
    }

    private function updateTranslatables(array $SelectedLanguages, array $requestData, array $SupportedLanguages, Course $instance){
        foreach($SelectedLanguages as $language)
        {
            foreach($instance->GetTranslatables() as $translatable){
                $loc = $translatable . $SupportedLanguages[$language['Language']]['Language_code'];
                $instance->update([ $loc => $requestData[$loc] ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $currentUser = Auth::user();

        $instance = Course::find($id);

        $SupportedLanguages = config('languages');
        $SelectedLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$currentUser->selected_language));

        if($currentUser->is_admin)
        {
            //gives access to all languages to admins
            $SelectedLanguages = $SupportedLanguages;
        }

        $TranslatableData = $this->getTranslatables($SelectedLanguages, $instance);


         return view('edit-translations',[
            'email' => $currentUser->email,
            'translatable_type' => "Course",
            'translatable_id' => $id,
            'translatables' => $TranslatableData['TranslatableParts'],
            'old_values' => $TranslatableData['OldTranslatableValues'],
            'english_values' => $instance->getTranslatables(),
            'english_text' => $this->getOnlyEnglish($instance)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id)
    {
        $requestData = request()->all();
        $currentUser = Auth::user();
        $instance = Course::find($id);

        $SupportedLanguages = config('languages');
        $SelectedLanguages = LanguageDataCompiler::ReturnLanguageArray(explode(',',$currentUser->selected_language));

        if($currentUser->is_admin)
        {
            //gives access to all languages to admins
            $SelectedLanguages = $SupportedLanguages;
        }

        $this->updateTranslatables($SelectedLanguages,$requestData,$SupportedLanguages,$instance);

        return redirect('/');
    }
}
