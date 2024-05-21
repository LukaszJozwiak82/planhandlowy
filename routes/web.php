<?php

use App\Livewire\Employee\Sale;
use App\Livewire\Pages\Calculator;
use App\Livewire\Pages\Calendar;
use App\Livewire\Pages\Campaigns;
use App\Livewire\Pages\Manager\Main;
use App\Livewire\Sale\NewSale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

//    Route::get('/', function () {
//        return view('dashboard');
//    })->name('dashboard');
    Route::get('/', Main::class)->name('index');
    Route::get('/new-sale', NewSale::class);
    Route::get('/calculator', Calculator::class)->name('calculator');
    Route::get('/calendar', Calendar::class)->name('calendar');
    Route::get('/sale', Sale::class)->name('sale.index');
    Route::get('/campaigns', Campaigns::class)->name('campaigns');
});
