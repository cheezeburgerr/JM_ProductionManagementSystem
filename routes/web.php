<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TeamsController;
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




Route::view('/', 'welcome')->name('/');
Route::view('home', 'home')->name('home');

// Routes requiring general authentication
Route::group(['middleware' => 'auth'], function () {
    Route::get('/order-category', [OrderController::class, 'index'])->name('order-category');
    Route::get('/order/{id}', [OrderController::class, 'order'])->name('order');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::view('profile', 'profile')->name('profile');
    Route::get('/lineup/{id}', [OrderController::class, 'lineup'])->name('order.lineup');
    Route::post('/lineup/{id}', [OrderController::class, 'store_lineup'])->name('lineup.submit');
});

// Routes for employee authentication
Route::get('employee/login', [EmployeeController::class, 'login_form'])->name('login.form');
Route::post('login-functionality', [EmployeeController::class, 'login_functionality'])->name('login.functionality');


require __DIR__ . '/auth.php';

Route::group(['middleware' => 'employee'], function () {
   Route::prefix('employee')->group(function () {
    Route::get('logout', [EmployeeController::class, 'logout'])->name('employee.logout');
    Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::resource('teams', TeamsController::class);


        Route::get('pending-teams', [TeamsController::class, 'pending'])->name('employee.pending-teams');
        Route::get('approve/{id}', [TeamsController::class, 'approve'])->name('employee.approve');


        Route::get('print/{id}', [TeamsController::class, 'print'])->name('employee.print');
        Route::put('report', [TeamsController::class, 'setErrors'])->name('set.errors');

        Route::get('production', [TeamsController::class, 'production'])->name('employee.production');
   });


});
