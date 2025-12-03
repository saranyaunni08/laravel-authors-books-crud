<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;

// All Author + Books APIs (RESTful resource route – this single line gives you everything)
Route::apiResource('authors', AuthorController::class);

// Optional: If you want to add search later (Task 3)
Route::get('authors-search', [AuthorController::class, 'search'])
    ->name('authors.search');
