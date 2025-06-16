<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    protected $table = "cp_lessons";
    private $ContentLinkTable = "cp_lesson_revisions";
    

    public function GetLessonContent()
    {

        $Link = DB::selectOne("select * from {$this->ContentLinkTable} where lesson_id = {$this->id}");
        if($Link)//some links don't exist so this checks for that
        {
            $LinkClass = lessonRevisions::find($Link->id);
            $Content = DB::selectOne("select * from cp_lesson_contents where id = {$LinkClass->lesson_content_id}");
            return lessonContent::find($Content->id);
        }
        else{
            return false;
        }
    }
}
