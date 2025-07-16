<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $table = "cp_lessons";
    private $ContentLinkTable = "cp_lesson_revisions";
    protected $guarded = ['id'];

    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

    public function LessonContent()
    {
        return $this->belongsToMany(lessonContent::class,$this->ContentLinkTable);
    }
}
