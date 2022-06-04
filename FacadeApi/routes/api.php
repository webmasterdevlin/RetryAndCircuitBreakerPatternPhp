<?php


use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\TodoController;

Route::get('todos/{todo_id}', [TodoController::class, 'show']);
