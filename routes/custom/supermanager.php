<?php

use App\Livewire\Pages\Manager\Main;
use App\Livewire\Pages\SuperManager\Department\Plan;
use Illuminate\Support\Facades\Route;

Route::get('/', Main::class)->name('index');
Route::get('department-plan', Plan::class)->name('department.plan');

