<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use App\Models\lessonRevisions;
use App\Models\User;

pest()->extend(Tests\TestCase::class)
 // ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function login($user = null)
{
    return test()->actingAs($user ?? User::factory()->create());
}

function SelectRandomLanguage($languages){
    $selected = rand(0, sizeof($languages) - 1);
    $current = 0;
    foreach($languages as $language)
    {
        if($selected == $current){
            return $language;
        }
        $current++;
    }
}

function CheckChildrenPercent($arr,$desiredPercent){
            foreach($arr as $Translatable){
               expect($Translatable['TranslatedPercent'])->toBe($desiredPercent);
          }
}

function GetChildrenPercent($arr){
            $totalPercent = 0;
            $totalAmount = 0;
            foreach($arr as $Translatable){
               $totalPercent += $Translatable['TranslatedPercent'];
               $totalAmount += 1;
          }
    return $totalPercent/$totalAmount;
}

function CheckChildrenFullyTranslated($arr){
            $totalPercent = 0;
            $totalAmount = 0;
            foreach($arr as $Translatable){
               $totalPercent += $Translatable['TranslatedPercent'];
               $totalAmount += 1;
          }
    return ($totalPercent/$totalAmount) == 100;
}

function CreateCourses($amount,$translated)
{
    for( $int = 0; $int < $amount; $int += 1)
    {
        $LessonRevision = null;

        if($translated){
            $LessonRevision = lessonRevisions::factory()->translate()->create();
        }else{
            $LessonRevision = lessonRevisions::factory()->create();
        }

            $LessonContent = $LessonRevision->Content;
            $Lesson = $LessonRevision->Lesson;
            $Module = $Lesson->Module;
            $Course = $Module->Course;
    }
}