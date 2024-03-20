<?php


use App\Livewire\Employee\Sale;
use Illuminate\Support\Facades\Route;

Route::get('sale', Sale::class)->name('sale.index');
