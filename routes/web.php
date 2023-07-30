<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\SocialNetworkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('articles.index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/images', [ImageController::class, 'index'])->name('images.index');
    Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
    Route::post('/images', [ImageController::class, 'store'])->name('images.store');
    Route::get('/images/{image}', [ImageController::class, 'show'])->name('images.show');
    Route::get('/images/{image}/edit', [ImageController::class, 'edit'])->name('images.edit');
    Route::patch('/images/{image}', [ImageController::class, 'update'])->name('images.update');
    Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

    Route::get('/social-networks', [SocialNetworkController::class, 'index'])->name('social-networks.index');
    Route::get('/social-networks/create', [SocialNetworkController::class, 'create'])->name('social-networks.create');
    Route::post('/social-networks', [SocialNetworkController::class, 'store'])->name('social-networks.store');
    Route::get('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'show'])->name('social-networks.show');
    Route::get('/social-networks/{socialNetwork}/edit', [SocialNetworkController::class, 'edit'])->name('social-networks.edit');
    Route::patch('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'update'])->name('social-networks.update');
    Route::delete('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'destroy'])->name('social-networks.destroy');


    Route::post('/tinymceUpload', [ImageController::class, 'tinymceUpload'])->name('tinymce.upload');

    Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager');
    Route::get('sendmail', [ProfileController::class, 'sendmail'])->name('sendmail');
});

// Route::group(['prefix' => 'laravel-filemanager'], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
require __DIR__ . '/auth.php';
