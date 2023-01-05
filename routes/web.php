<?php

use Illuminate\Http\Request;
use App\Http\Livewire\User\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\ManageBilling;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Livewire\User\Applications\CreateApplication;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');




Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', Dashboard::class)->name('home');
    Route::get('applications/create', CreateApplication::class);
    Route::get('billing', ManageBilling::class)->name('manage-billing');
    Route::get('subscription', [SubscriptionController::class, 'intent']);
    Route::get('payment', [SubscriptionController::class, 'defaultPayment']);
    Route::post('subscribe', [SubscriptionController::class, 'subscribe']);
    Route::get('checkout', [SubscriptionController::class, 'checkout']);

    Route::get('subscription/create-customer');
    Route::get('subscription/payment');
});

