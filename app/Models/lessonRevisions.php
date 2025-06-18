<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//one lesson has many revisions
class lessonRevisions extends Model
{
    protected $table = "cp_lesson_revisions";

    public function Content()
    {
        return $this->hasMany(lessonContent::class);
    }
}
