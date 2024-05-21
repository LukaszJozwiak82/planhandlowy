<?php

use App\Livewire\Employee\Dashboard;
use App\Livewire\Employee\Sale;
use App\Livewire\Pages\Admin\Users;
use App\Livewire\Pages\Manager\Main;
use App\Livewire\Pages\Manager\Plan;
use Illuminate\Support\Facades\Route;

Route::get('/', Main::class)->name('index');
Route::get('users', Users::class)->name('users.index');
Route::get('plan', Plan::class)->name('plan.index');

