<?php

use LanguageCompiler\LanguageDataCompiler;
use App\Models\Course;
use App\Models\lessonRevisions;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);
/* test('the proper percentage is displayed',function(){
     $languages = require base_path("resources/php/Languages.php");
     $selectedLanguage = [SelectRandomLanguage($languages)];

     $courses = Course::with('Modules.Lessons.LessonContent')->get();
     $tree = LanguageDataCompiler::CreateTranslatedTree($courses,$selectedLanguage);
     
}); */

test('Translate Tree percentage is accessible',function(){
     //Initialization//////////
     //config('Languages')
     $SupportedLanguages = require(base_path('resources\php\Languages.php'));
     $LessonRevision = lessonRevisions::factory()->create();
     $LessonContent = $LessonRevision->Content;
     $Lesson = $LessonRevision->Lesson;
     $Module = $Lesson->Module;
     $Course = $Module->Course;
     /////////////////////////

     
     $Tree = LanguageDataCompiler::CreateTranslatedTree([$Course],$SupportedLanguages);
     
     foreach($Tree as $LoopCourse){
          CheckChildrenPercent($LoopCourse['TranslateData'],100);

          foreach($LoopCourse['Children'] as $LoopModule){
               CheckChildrenPercent($LoopModule['TranslateData'],100);
               foreach($LoopModule['Children'] as $LoopLesson)
               {
                    CheckChildrenPercent($LoopLesson['TranslateData'],100);
               }
          }
     }


     //Cleanup/////////
     $LessonRevision->delete();
     $LessonContent->delete();
     $Lesson->delete();
     $Module->delete();
     $Course->delete();
     /////////////////
});