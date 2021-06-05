<?php

use App\Http\Controllers\CoverController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\FrontController;

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

Route::get('/', [FrontController::class, 'mangol_index'])->name('mangol.index');
Route::get('/komik/{id}', [FrontController::class, 'mangol_detail'])->name('mangol.detail');
Route::post('/komik/{id}/commentPost', [FrontController::class, 'mangol_comments'])->name('mangol.comments');
Route::post('/chapter/{id}/commentPost', [FrontController::class, 'mangol_comments_chapter'])->name('mangol.comments.chapter');
Route::get('/chapter/{id}', [FrontController::class, 'mangol_chapter'])->name('mangol.chapter');
Route::get('/completed', [FrontController::class, 'mangol_complete'])->name('mangol.complete');
Route::get('/all-manga', [FrontController::class, 'mangol_all'])->name('mangol.all');
Route::get('/search', [FrontController::class, 'search'])->name('search');

Auth::routes([
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('home')->middleware('auth')->group(function () {
    Route::get('/komik', [CoverController::class, 'cover_index'])->name('cover.index');
    Route::get('/komik/create', [CoverController::class, 'cover_create'])->name('cover.create');
    Route::post('/komikPost', [CoverController::class, 'cover_post'])->name('cover.post');
    Route::get('/komik/edit/{id}', [CoverController::class, 'cover_edit'])->name('cover.edit');
    Route::put('/komik/komikUpdate/{id}', [CoverController::class, 'cover_update'])->name('cover.update');
    Route::delete('/komik/delete/{id}', [CoverController::class, 'cover_delete'])->name('cover.delete');

    Route::get('/genre', [GenreController::class, 'genre_index'])->name('genre.index');
    Route::get('/genre/create', [GenreController::class, 'genre_create'])->name('genre.create');
    Route::post('/genrePost', [GenreController::class, 'genre_post'])->name('genre.post');
    Route::get('/genre/edit/{id}', [GenreController::class, 'genre_edit'])->name('genre.edit');
    Route::put('/genre/genreUpdate/{id}', [GenreController::class, 'genre_update'])->name('genre.update');
    Route::delete('/genre/delete/{id}', [GenreController::class, 'genre_delete'])->name('genre.delete');

    Route::get('/chapter', [ChapterController::class, 'chapter_index'])->name('chapter.index');
    Route::get('/chapter/create', [ChapterController::class, 'chapter_create'])->name('chapter.create');
    Route::post('/chapterPost', [ChapterController::class, 'chapter_post'])->name('chapter.post');
    Route::get('/chapter/edit/{id}', [ChapterController::class, 'chapter_edit'])->name('chapter.edit');
    Route::put('/chapter/chapterUpdate/{id}', [ChapterController::class, 'chapter_update'])->name('chapter.update');
    Route::delete('/chapter/delete/{id}', [ChapterController::class, 'chapter_delete'])->name('chapter.delete');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
