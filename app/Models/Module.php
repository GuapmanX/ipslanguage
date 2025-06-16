<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $table = "cp_modules";
    public $translatables = ["title","subtitle",]; //the parameters in the sql database that are translatable

    public function Course()
    {
        return $this->belongsTo(Course::class); //Gets the Course that the module belongs to
    }

    public function GetLessons()
    {
        return $this->hasMany(Lesson::class);
    }

 public function GetTranslatables()
    {
        return $this->translatables;
    }

        public function GetLanguages($SupportedLanguages)
    {
        //empty($v)
        $translated = [];

        foreach($this->translatables as $translatable)
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
