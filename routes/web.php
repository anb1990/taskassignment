<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\WebProjectController;
use App\Http\Controllers\Web\WebTaskController;

Route::middleware(['auth.redirect'])->group(function () {
Route::match(['get'], '/', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('auth.login');
});
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('auth.register');//left out of middleware to easily creating users
Route::match(['get'], '/logut', [AuthController::class, 'logout'])->name('auth.logut');


Route::middleware(['auth.nredirect'])->group(function () {
Route::match(['get'], '/projects', [WebProjectController::class, 'index'])->name('projects.index');
Route::match(['get'], '/projects/update/{id}', [WebProjectController::class, 'update'])->name('projects.update');
Route::match(['get'], '/projects/destroy/{id}', [WebProjectController::class, 'destroy'])->name('projects.destroy');

Route::match(['get'], '/projects/show/{id}', [WebProjectController::class, 'showWithTasks'])->name('projects.show');
Route::match(['get'], '/projects/store/', [WebProjectController::class, 'store'])->name('projects.store');

Route::match(['get'], '/tasks/store/{projectId}', [WebTaskController::class, 'store'])->name('tasks.store');
Route::match(['get'], '/tasks/update/{id}', [WebTaskController::class, 'update'])->name('tasks.update');
Route::match(['get'], '/tasks/destroy/{id}', [WebTaskController::class, 'destroy'])->name('tasks.destroy');

});