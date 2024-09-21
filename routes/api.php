<?php
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;



        Route::middleware('auth:api')->post('/projects/update', [ProjectController::class, 'update']);
        Route::middleware('auth:api')->post('/projects/destroy', [ProjectController::class, 'destroy']);
        Route::middleware('auth:api')->post('/projects/store', [ProjectController::class, 'store']);
        
        Route::middleware('auth:api')->post('/tasks/update', [TaskController::class, 'update']);
        Route::middleware('auth:api')->post('/tasks/destroy', [TaskController::class, 'destroy']);
        Route::middleware('auth:api')->post('/tasks/store', [TaskController::class, 'store']);

