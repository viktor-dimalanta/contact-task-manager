<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('businesses', BusinessController::class)->names([
            'index' => 'businesses.index',
            'create' => 'businesses.create',
            'store' => 'businesses.store',
            'show' => 'businesses.show',
            'edit' => 'businesses.edit',
            'update' => 'businesses.update',
            'destroy' => 'businesses.destroy',
        ]);
    
        Route::resource('people', PersonController::class)->names([
            'index' => 'people.index',
            'create' => 'people.create',
            'store' => 'people.store',
            'show' => 'people.show',
            'edit' => 'people.edit',
            'update' => 'people.update',
            'destroy' => 'people.destroy',
        ]);
    
        Route::resource('tasks', TaskController::class)->names([
            'index' => 'tasks.index',
            'create' => 'tasks.create',
            'store' => 'tasks.store',
            'show' => 'tasks.show',
            'edit' => 'tasks.edit',
            'update' => 'tasks.update',
            'destroy' => 'tasks.destroy',
        ]);

        Route::resource('tags', TagController::class)->names([
            'index' => 'tags.index',
            'create' => 'tags.create',
            'store' => 'tags.store',
            'show' => 'tags.show',
            'edit' => 'tags.edit',
            'update' => 'tags.update',
            'destroy' => 'tags.destroy',
        ]);
    
        // Define resource routes with custom names for categories
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

        Route::put('/tasks/{task}/update-to-open-status', [TaskController::class, 'updateToOpenStatus'])->name('tasks.updateToOpenStatus');
        Route::put('/tasks/{task}/update-to-completed-status', [TaskController::class, 'updateToCompletedStatus'])->name('tasks.updateToCompletedStatus');

    });

require __DIR__.'/auth.php';