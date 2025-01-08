<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;

/** CONTROLLERS */

//use App\Http\Controllers\Site\HomeController;

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

Route::prefix('/')->group(function () {
    Route::post('/artists_api', [HomeController::class, 'artists_api'])->name('artists_api');
    Route::post('/spotify', [HomeController::class, 'spotify'])->name('spotify');
    Route::post('/youtube', [HomeController::class, 'youtube'])->name('youtube');

    Route::get('/sitemap.xml', [SitemapController::class, 'sitemap']);

//    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/politica-privacidade', [HomeController::class, 'privacy'])->name('politica-privacidade');
});

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/agenda', [HomeController::class, 'schedule'])->name('agendas');
Route::get('/agenda/{url}', [HomeController::class, 'scheduleDetails'])->name('agenda');
Route::get('/noticias', [HomeController::class, 'news'])->name('noticias');
Route::get('/noticia/{url}', [HomeController::class, 'newsDetails'])->name('noticia');
