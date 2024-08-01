<?php
use App\Http\Controllers\StuController;
use Illuminate\Support\Facades\Route;

Route::get('/{alias}', [StuController::class, 'redirect'])->where('alias', '[A-Za-z0-9]{4}')->name('stu.show');

Route::get('/loadd', [StuController::class, 'loadd'])->name('stu.load');
Route::get('/decode', [StuController::class, 'decode'])->name('stu.decode');

Route::prefix('stu')->group(function () {
    Route::post('/', [StuController::class, 'create']);
    Route::put('/{alias}', [StuController::class, 'update']);
    Route::delete('/{alias}', [StuController::class, 'delete']);
    Route::get('/{alias}/fetch-data', [StuController::class, 'fetch']);
    Route::middleware('cors')->get('/{alias}/count', [StuController::class, 'count'])->where('alias', '[A-Za-z0-9]{4}')->name('stu.count');
});