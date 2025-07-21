<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = "cp_courses";
    const translatables = ["title","description"]; //the parameters in the sql database that are translatable
    //public $translatables = $this::translatables; //keeping this so i dont have to go through everything to change it

    protected $guarded = ['id'];

    public function Modules()
    {
        return $this->hasMany(Module::class); //Gets all the modules related to the course
    }

    public function GetTranslatables()
    {
        return $this::translatables;
    }

    public function GetLanguages($SupportedLanguages)
    {
        //empty($v)
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
