<?php

use Illuminate\Support\Facades\Route;
//use Livewire\Volt\Volt;
//use App\Models;
use App\Models\Course;
//use App\Models\Lesson;
//use Illuminate\Support\Facades\DB;


require(base_path('resources\php\LanguageDataCompiler.php'));
$SupportedLanguages = require(base_path('resources\php\Languages.php'));

//$CourseLangs = Course::first()->GetLanguages($SupportedLanguages);
//$ModuleLangs = Course::first()->GetModules[1]->GetLanguages($SupportedLanguages);
//$Content = Course::first()->GetModules[1]->GetLessons[2]->GetLessonContent()->GetLanguages($SupportedLanguages);

//dd(Course::first()->GetModules[1]->GetLessons[2],Course::first()->GetModules[1]->GetLessons[2]->GetLessonContent);
//dd(Course::first()->Modules[1]->Lessons[4]->LessonContent[0]->Lesson);

Route::get('/', function () {
    return view('home');
});
