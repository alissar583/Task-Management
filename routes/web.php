<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('projects')->controller(ProjectController::class)->middleware('auth')->group(function(){
    Route::get('','index')->name('projects');
    Route::get('create','create')->name('projects.create');
    Route::post('store','store')->name('projects.store');
    Route::get('/{project}/edit','edit')->name('projects.edit');
    Route::put('{project}/update','update')->name('projects.update');
    Route::delete('{project}/delete','delete')->name('projects.delete');
});

Route::resource('tasks', TaskController::class)->middleware('auth');

require __DIR__.'/auth.php';
