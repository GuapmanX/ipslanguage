<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessonContent extends Model
{
    use HasFactory;
    protected $table = "cp_lesson_contents";
    public $translatables = ["title","notes","summary","cta_text"]; //the parameters in the sql database that are translatable
    private $ContentLinkTable = "cp_lesson_revisions";

    public function Lesson()
    {
        return $this->belongsToMany(Lesson::class,$this->ContentLinkTable);
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
