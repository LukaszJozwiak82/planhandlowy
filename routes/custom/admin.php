<?php

use App\Livewire\User;
use Illuminate\Support\Facades\Route;

Route::get('users', User::class)->name('users.index');
