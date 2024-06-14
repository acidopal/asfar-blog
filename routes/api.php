<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogPostController;

Route::get('/blog-posts', [BlogPostController::class, 'index']);
Route::get('/blog-posts/{id}', [BlogPostController::class, 'show']);
