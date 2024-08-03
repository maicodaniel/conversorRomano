<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversorController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('conversor', [ConversorController::class, 'index'])->name('conversor');
Route::post('conversor/arabicos', [ConversorController::class, 'arabicos'])->name('arabicos');
Route::post('conversor/romano', [ConversorController::class, 'romano'])->name('romano');
