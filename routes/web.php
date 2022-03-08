<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Loan;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');



Route::group(['middleware' => 'auth' ] , function() {


    Route::get('/dashboard', function () { return view('dashboard');  })->name('dashboard');
    Route::get('/loan-details', [Loan::class, 'index'])->name('loan_details');
    Route::post('/loan-process', [Loan::class, 'process'])->name('loan_process');


});


require __DIR__.'/auth.php';
