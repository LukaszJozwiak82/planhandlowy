<?php

use App\Livewire\Pages\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::get('users', Users::class)->name('users.index');
