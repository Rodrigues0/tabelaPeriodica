<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElementoController;

Route::get('/', [ElementoController::class, 'index'])->name('tabela.index');
