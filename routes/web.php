<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::match(['get', 'post'], '/', [ImageController::class, 'upload'])->name('images.upload');


