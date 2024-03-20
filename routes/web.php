<?php

use App\Http\Controllers\UploadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/upload', function () {
    return Inertia::render('SvgForm');
})->name('upload');

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
