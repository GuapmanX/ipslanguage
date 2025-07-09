<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//one lesson has many revisions
class lessonRevisions extends Model
{

    use HasFactory;
    protected $table = "cp_lesson_revisions";

    public function Lesson()
    {
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }

    public function Content()
    {
        return $this->belongsTo(lessonContent::class,'lesson_content_id','id');
    }
}
