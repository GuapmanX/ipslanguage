<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lessonRevisions extends Model
{
    protected $table = "cp_lesson_revisions";

    public function GetContent()
    {
        return $this->hasMany(lessonContent::class);
    }
}
