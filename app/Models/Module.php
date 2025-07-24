<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    
    protected $table = "cp_modules";
    const translatables = ["title","subtitle",]; //the parameters in the sql database that are translatable

    protected $guarded = ['id'];

    public function Course()
    {
        return $this->belongsTo(Course::class); //Gets the Course that the module belongs to
    }

    public function Lessons()
    {
        return $this->hasMany(Lesson::class);
    }

 public function GetTranslatables()
    {
        return $this::translatables;
    }

        public function GetLanguages($SupportedLanguages)
    {
        $translated = [];

        foreach($this::translatables as $translatable)
        {
            $translated[$translatable] = [];
            foreach($SupportedLanguages as $Language)
            {
                $SQL_DIR = $translatable . $Language['Language_code'];
                $translated[$translatable][$Language['Language']] = ['Data' => $this->$SQL_DIR, 'Language' => $Language['Language'], 'Translatable' => $translatable];
            }
        }
        return $translated;
    }
}
