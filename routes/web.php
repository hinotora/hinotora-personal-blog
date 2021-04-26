<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/* Blog routes */
Route::get('/', [ArticleController::class,  'recent'])->name('page-home-index');

Route::prefix('/article')->group(function() {
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

/* Admin routes */
Route::prefix('/admin')->group(function () {

    /* Auth routes */
    Route::get('/login', [LoginController::class,  'showLoginForm'])->name('page-admin-login');
    Route::post('/login', [LoginController::class,  'login'])->name('action-admin-login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('action-admin-logout');

    /* Only for authenticated */
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('page-admin-dashboard');

        Route::prefix('/articles')->group(function() {
            Route::get('/', [AdminArticleController::class, 'list'])->name('page-admin-article-list');

            Route::get('/new', [AdminArticleController::class, 'new'])->name('page-admin-article-new');
            Route::post('/new', [AdminArticleController::class, 'store'])->name('action-admin-article-new');

            Route::get('/update/{id}', [AdminArticleController::class, 'update'])->name('page-admin-article-update');
            Route::post('/update/{id}', [AdminArticleController::class, 'store_update'])->name('action-admin-article-update');

            Route::get('/delete/{id}', [AdminArticleController::class, 'delete'])->name('action-admin-article-delete');
        });

        Route::prefix('/category')->group(function() {
            Route::get('/', [AdminCategoryController::class, 'list'])->name('page-admin-category-list');

            Route::get('/new', [AdminCategoryController::class, 'new'])->name('page-admin-category-new');
            Route::post('/new', [AdminCategoryController::class, 'store'])->name('action-admin-category-new');

            Route::get('/update/{id}', [AdminCategoryController::class, 'update'])->name('page-admin-category-update');
            Route::post('/update/{id}', [AdminCategoryController::class, 'store_update'])->name('action-admin-category-update');

            Route::get('/delete/{id?}', [AdminCategoryController::class, 'delete'])->name('action-admin-category-delete');
        });
    });
});
