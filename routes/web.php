<?php
use Illuminate\Support\Facades\Route;
use Vikramsra\EmailLogToDb\Controllers\EmailLogController;

Route::middleware(['web'])->group(function () {
    Route::get('/email-logs', [EmailLogController::class, 'index'])->name('email.logs.index');
    Route::get('/email-logs/{id}', [EmailLogController::class, 'show'])->name('email.logs.show');

});
