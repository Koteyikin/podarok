<?php
use App\Http\Controllers\GiftController;
use App\Http\Middleware\CheckGiftCode;
use App\Http\Middleware\CheckPuzzle;
use Illuminate\Support\Facades\Route;


Route::get('/', [GiftController::class, 'code']);
Route::post('/check-code', [GiftController::class, 'checkCode']);

Route::middleware([CheckGiftCode::class])->group(function () {
    Route::get('/puzzle/1', [GiftController::class, 'puzzle1']);
    Route::post('/puzzle/1/check', [GiftController::class, 'checkPuzzle1']);

    Route::get('/puzzle/2', [GiftController::class, 'puzzle2'])
        ->middleware(CheckPuzzle::class . ':1');
    Route::post('/puzzle/2/check', [GiftController::class, 'checkPuzzle2']);

    Route::get('/puzzle/3', [GiftController::class, 'puzzle3'])
        ->middleware(CheckPuzzle::class . ':2');
    Route::post('/puzzle/3/check', [GiftController::class, 'checkPuzzle3']);

    Route::get('/gift', [GiftController::class, 'gift'])
        ->middleware(CheckPuzzle::class . ':3');
});
