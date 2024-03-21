<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('CSVForm');
});

Route::post('/', [UploadController::class, 'upload'])->name('upload');
