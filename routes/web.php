<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\PosterPagesController;
use App\Http\Controllers\UploadImagesController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('public/home');
});

// routing to controller
Route::get('/', [PublicPagesController::class, 'index'])->name('home');
Route::get('/about', [PublicPagesController::class, 'dummy']);
Route::get('/ranking', [PublicPagesController::class, 'dummy']);
Route::get('/covid-19', [PublicPagesController::class, 'dummy']);
Route::resource('/article', PublicPagesController::class, ['only' => ['index', 'show']]);

Route::resource('/post'         , PosterPagesController::class)->names([
    'create' => 'post.new_post',
]);

// session('transition_source')による遷移
Route::post('/post/create', [PosterPagesController::class, 'continuePost']);
Route::post('/post/{post}/edit', [PosterPagesController::class, 'continueEdit']);

Route::get('/image/upload', [UploadImagesController::class, 'index'])->name('image.upload_form');
Route::post('/image/upload', [UploadImagesController::class, 'selectArticleImage'])->name('image.upload_select_image');
Route::post('/image/delete', [UploadImagesController::class, 'deleteRequest'])->name('image.del-req');
Route::resource('images', UploadImagesController::class,['except' =>['index', 'edit', 'update', 'destroy']]);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function(){
    return redirect('/post');
})->name('dashboard');
