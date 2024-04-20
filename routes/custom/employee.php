<?php

use App\Livewire\Employee\Dashboard;
use App\Livewire\Employee\Sale;
use Illuminate\Support\Facades\Route;

Route::get('sale', Sale::class)->name('sale.index');
Route::get('/', Dashboard::class)->name('index');
