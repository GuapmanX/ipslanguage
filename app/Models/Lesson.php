<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    protected $table = "cp_lessons";
    private $ContentLinkTable = "cp_lesson_revisions";

    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

    public function LessonContent()
    {
        return $this->belongsToMany(lessonContent::class,$this->ContentLinkTable);
    }
}
