<?php

use App\Http\Controllers\Main;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
//use Livewire\Volt\Volt;
//use App\Models;
use App\Models\Course;
//use App\Models\Lesson;
//use Illuminate\Support\Facades\DB;


require(base_path('resources\php\LanguageDataCompiler.php'));
$SupportedLanguages = require(base_path('resources\php\Languages.php'));



Route::get('/', [Main::class, 'index'])->middleware('auth');



Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);