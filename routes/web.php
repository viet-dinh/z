<?php

use App\Events\MessageSent;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SlugController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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

require __DIR__ . '/auth.php';
require __DIR__ . '/passport.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->post('/chat/message-all', function (Request $request) {
    event(new MessageSent($request->get('message')));

    return true;
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);

    Route::resource('stories', StoryController::class);
    Route::post('stories/{story}/restore', [StoryController::class, 'restore'])->name('stories.restore');
    Route::post('stories/{story}/publish', [StoryController::class, 'publish'])->name('stories.publish');
    Route::post('stories/{story}/unpublish', [StoryController::class, 'unpublish'])->name('stories.unpublish');

    Route::prefix('stories/{story}')->group(function () {
        Route::resource('chapters', ChapterController::class);
    });
});

Route::get('/tim-kiem', action: [SearchController::class, 'index'])->name('search.show');
Route::get('/{slug}', [SlugController::class, 'showStory'])->name('story.show');
Route::get('/{slug}/chuong-{order}', [SlugController::class, 'showChapter'])->name(name: 'chapter.show');
