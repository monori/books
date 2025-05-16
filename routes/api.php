<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('books', \App\Http\Controllers\Api\V1\BooksController::class);
