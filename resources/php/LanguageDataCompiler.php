<?php

function GiveTranslatedPercent($arr,$Translatables){
    //dd($arr[$WhatToCheck]);
    $result = [];


    foreach ($Translatables as $Translatable)
    {
        $total = sizeof($arr[$Translatable]);
        $translated = 0;
        foreach($arr[$Translatable] as $Translation)
        {
            if(!empty($Translation['Data']))
            {
                $translated += 1;
            }
        }
        $result[$Translatable] = [
            'Translatable' => $Translatable,
            'LanguageData' => $arr[$Translatable],
            'TranslatedPercent' => ($translated/$total) * 100

        ];
    }
    /*$total = sizeof($arr[$WhatToCheck]);
    $translated = 0;
    foreach($arr[$WhatToCheck] as $Translation)
    {
        if(!empty($Translation['Data']))
        {
            $translated += 1;
        }
    }
    $result = [
        'Translatable' => $WhatToCheck,
        'LanguageData' => $arr[$WhatToCheck],
        'TranslatedPercent' => ($translated/$total) * 100

    ];*/

    return $result;
}

function CreateTranslatedTree($Courses,$SupportedLanguages){
    $Data = [];



    for($CourseINT = 0; $CourseINT < count($Courses); $CourseINT++)
    {
       $CourseObject = $Courses[$CourseINT];
       $Data[$CourseINT] = [
        "Object" => $CourseObject,"Children" => [],
        "TranslateData" => GiveTranslatedPercent($CourseObject->GetLanguages($SupportedLanguages),$CourseObject->GetTranslatables()),
        "Name" => $CourseObject->title,
        "id" => $CourseObject->id
        ]; 
       $Modules = $Courses[$CourseINT]->Modules; //$Courses[$CourseINT]::with('GetModules')->get();
       for($ModuleINT = 0; $ModuleINT < count($Modules); $ModuleINT++)
        {
            $ModuleObject = $Modules[$ModuleINT];
            $Data[$CourseINT]["Children"][$ModuleINT] = [
                "Object" => $ModuleObject,"Children" => [],
                "TranslateData" => GiveTranslatedPercent($ModuleObject->GetLanguages($SupportedLanguages),$ModuleObject->GetTranslatables()),
                "Name" => $ModuleObject->title,
                "id" => $ModuleObject->id
            ];

            $Lessons = $ModuleObject->Lessons;
            for($LessonInt = 0; $LessonInt < count($Lessons); $LessonInt++)
            {
                
                $Content = $Lessons[$LessonInt]->LessonContent;
                foreach($Content as $Contents) {
                    //dd($Contents);
                    if ($Contents){
                        $Data[$CourseINT]["Children"][$ModuleINT]["Children"][$LessonInt] = [
                            "Object" => $Contents,"Children" => [],
                            "TranslateData" => GiveTranslatedPercent($Contents->GetLanguages($SupportedLanguages),$Contents->GetTranslatables()),
                            "Name" => $Contents->title,
                            "id" => $Contents->id
                        ];
                    }
                };
            }

        }
    }
    return $Data;
}