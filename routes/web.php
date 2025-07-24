<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\lessonContentController;
use App\Http\Controllers\Main;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
//use Livewire\Volt\Volt;
//use App\Models;
use App\Models\Course;
use App\Models\lessonContent;
use App\Models\Module;

//use App\Models\Lesson;
//use Illuminate\Support\Facades\DB;


require(base_path('resources\php\LanguageDataCompiler.php'));



Route::get('/', [Main::class, 'index'])->middleware('auth');



Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

//Route::get('/edit/id={id:slug}/type={type:slug}',[EditController::class, 'index'])->middleware('auth');
//Route::post('/edit',[EditController::class,'store'])->middleware('auth');



Route::get('/edit/Course/{id}', [CourseController::class, 'edit'])->middleware('auth');
Route::post('/edit/Course/{id}', [CourseController::class, 'update'])->middleware('auth');

Route::get('/edit/Module/{id}', [ModuleController::class, 'edit'])->middleware('auth');
Route::post('/edit/Module/{id}', [ModuleController::class, 'update'])->middleware('auth');


Route::get('/edit/lessonContent/{id}', [lessonContentController::class, 'edit'])->middleware('auth');
Route::post('/edit/lessonContent/{id}', [lessonContentController::class, 'update'])->middleware('auth');