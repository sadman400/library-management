<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UsertypeController;
use App\Http\Controllers\BookIssuanceDetailController;
use App\Http\Controllers\BookReturnDetailController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Resource routes for all controllers
Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::resource('usertypes', UsertypeController::class);
Route::resource('book-issuances', BookIssuanceDetailController::class);
Route::resource('book-returns', BookReturnDetailController::class);
