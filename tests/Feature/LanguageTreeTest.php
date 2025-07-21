<?php

use LanguageCompiler\LanguageDataCompiler;
use App\Models\Course;
use App\Models\lessonRevisions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SebastianBergmann\CodeCoverage\Util\Percentage;

uses(RefreshDatabase::class);

dataset('Percentages',[[0.0, 0, 1],[50.0, 1, 1],[100.0, 1, 0]]);

test('Translate Tree percentage is accessible',function(){
     //Initialization//////////
     $SupportedLanguages = config('languages');
     $LessonRevision = lessonRevisions::factory()->translate()->create();
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

});

 test('Different percentages are accurate',function($percent,$translated,$untranslated){
     //Initialization//////////
     CreateCourses($translated,true);
     CreateCourses($untranslated,false);
     /////////////////////////

     $SupportedLanguages = config('languages');
     $Tree = LanguageDataCompiler::CreateTranslatedTree(Course::all(),$SupportedLanguages);

     $translated = 0;
     $total = 0;

     foreach($Tree as $LoopCourse){
          $total += 1;
          if(!CheckChildrenFullyTranslated($LoopCourse['TranslateData']))
          {
               continue;
          }

          foreach($LoopCourse['Children'] as $LoopModule){
               if(!CheckChildrenFullyTranslated($LoopModule['TranslateData']))
               {
                    break;
               }

               foreach($LoopModule['Children'] as $LoopLesson)
               {
                    if(!CheckChildrenFullyTranslated($LoopLesson['TranslateData']))
                    {
                         break;
                    }

               }
          }
          $translated += 1;
     }
     expect((float)($translated/$total * 100))->toBe($percent);
})->with('Percentages');