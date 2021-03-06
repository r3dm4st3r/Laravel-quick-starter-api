<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth User
Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});

// Get User Data
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::group([
        'prefix' => 'dashboard'
    ], function () {
        Route::group([
            'prefix' => 'blog'
        ], function () {
            Route::post('/articles', [\App\Http\Controllers\Blog\ArticleController::class, 'articles'])->name('dash-articles');
            Route::post('/create-article', [\App\Http\Controllers\Blog\ArticleController::class, 'createArticle'])->name('dash-articles-create');
        });
    });
});

// Public Face
Route::group([
    'prefix' => 'blog'
], function () {
    Route::group([
        'prefix' => 'articles'
    ],function () {
        Route::post('/', [\App\Http\Controllers\Blog\ArticleController::class, 'index'])->name('articles');
        Route::get('/{slug:slug}', [\App\Http\Controllers\Blog\ArticleController::class, 'viewArticle'])->name('articlesDetail');
        Route::post('/{slug:slug}', [\App\Http\Controllers\Blog\ArticleController::class, 'likeArticle'])->name('likeArticle');
    });

    Route::group([
        'prefix' => 'tags'
    ],function () {
        Route::post('/', [\App\Http\Controllers\Blog\TagController::class, 'index'])->name('tags');
        Route::post('/{slug:slug}', [\App\Http\Controllers\Blog\TagController::class, 'viewTag'])->name('tagDetails');
    });
});



Route::group([
    'prefix' => 'contact'
], function () {
    Route::post('/' , [\App\Http\Controllers\Contact\MessageController::class, 'messages']);
    Route::post('/store' , [\App\Http\Controllers\Contact\MessageController::class, 'storeMessage']);
});

