<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


Route::middleware([
    //'auth'
    ])
    ->name('comments.')
    ->group(function () {

        Route::get('/comments', [CommentController::class, 'index'])->name('index');

        Route::get('/comments/{comment}', [CommentController::class, 'show'])
            ->name('show')
            ->whereNumber('comment');

        Route::post('/comments', [CommentController::class, 'store'])->name('store');

        Route::put('/comments/{comment}', [CommentController::class, 'update'])
            ->name('update')
            ->whereNumber('comment');

        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
            ->name('delete')
            ->whereNumber('comment');

    });