<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/* Blog routes */
Route::get('/', [ArticleController::class,  'recent'])->name('page-home-index');

Route::prefix('/articles')->group(function() {
    Route::get('/', [ArticleController::class, 'list'])->name('page-article-list');
    Route::get('/{slug}', [ArticleController::class, 'detail' ])->name('page-article-detail');
});

Route::prefix('/category')->group(function() {
    Route::get('/', [CategoryController::class,  'list'])->name('page-category-list');
    Route::get('/{category_slug}', [CategoryController::class,  'detail'])->name('page-category-detail');
});

Route::get('/about', function () {
    return view('about.index');
})->name('page-about-index');

Route::get('/contact', function () {
    return view('contact.index');
})->name('page-contact-index');
