<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Ethereum\WalletController as EtherWalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/price', [App\Http\Controllers\Admin\PriceController::class, 'index'])->name('price');
Route::controller(EtherWalletController::class)
    ->prefix('ethereum')
    ->name('ethereum.')
    ->group(function () {
    Route::get('/wallet', 'index')->name('wallet');
    Route::post('/update', 'update')->name('update');
});
