<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::resource('tasks', TaskController::class);
Route::patch('/tasks/{id}/toggle', [TaskController::class, 'toggle'])
    ->name('tasks.toggle');

Route::get('/', function () {
    return view('welcome');
});
