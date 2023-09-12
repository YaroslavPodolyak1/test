<?php

use App\Task\Http\Controllers\TaskController;
use App\Task\Http\Controllers\TaskMarkCompleteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum','can:update,task','can:destroy,task','can:view,task'])
    ->apiResource('tasks', TaskController::class)
    ->except('show');

Route::middleware(['auth:sanctum', 'can:update,task','can:markCompleted,task'])
    ->put('tasks/{task}/complete', TaskMarkCompleteController::class)
    ->name('tasks.complete');
