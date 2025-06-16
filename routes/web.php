<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;


require(base_path('resources\php\LanguageDataCompiler.php'));
$SupportedLanguages = require(base_path('resources\php\Languages.php'));

//$CourseLangs = Course::first()->GetLanguages($SupportedLanguages);
//$ModuleLangs = Course::first()->GetModules[1]->GetLanguages($SupportedLanguages);
//$Content = Course::first()->GetModules[1]->GetLessons[2]->GetLessonContent()->GetLanguages($SupportedLanguages);

//dd(CreateTranslatedTree(Course::all(),$SupportedLanguages));
//dd(GiveTranslatedPercent(Course::first()->GetLanguages($SupportedLanguages),Course::first()->GetTranslatables()));
//dd(CreateTranslatedTree(Course::all(),$SupportedLanguages));
//dd($Link);
//dd(Course::all());


Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
