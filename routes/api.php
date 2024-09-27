<?php

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\ReplyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->post('/chat/message-all', function (Request $request) {

    event(new MessageSent(Auth()->user()->name . ' sent: ' . $request->get('message')));

    return true;
});


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // Comments
    Route::post('stories/{storyId}/comments', [CommentController::class, 'store'])->name('stories.comments.store');

    // Replies
    Route::post('comments/{commentId}/replies', [ReplyController::class, 'store'])->name('comments.replies.store');

    // Reactions
    Route::post('reactions/{reactableType}/{reactableId}', [ReactionController::class, 'store'])->name('reactions.store');
});

Route::prefix('v1')->group(function () {
    Route::get('stories/{storyId}/comments', [CommentController::class, 'index']);
});


