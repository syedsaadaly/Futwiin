<?php

use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\LeagueController;
use App\Http\Controllers\AdminControllers\PlanController;
use App\Http\Controllers\AdminControllers\PridectionController;
use App\Http\Controllers\AdminControllers\ProfileController;
use App\Http\Controllers\AdminControllers\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontControllers\FrontController;
use App\Http\Controllers\FrontendControllers\FrontendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserControllers\UserController;
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

    Route::name('front.')->group(function(){
      Route::get('/',[FrontController::class,'index'])->name('index');
      Route::get('/expert',[FrontController::class,'expert'])->name('expert');
      Route::get('/leagues',[FrontController::class,'league'])->name('leagues');
      Route::get('/pricing',[FrontController::class,'pricing'])->name('pricing');
      Route::get('/testimonials',[FrontController::class,'testimonials'])->name('testimonials');
    });
    Route::get('/prediction/{prediction}/view', [PridectionController::class, 'checkAccess'])
    ->name('prediction.view')
    ->middleware('auth');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/{plan}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
    Route::post('/payment/process/{plan}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->namespace('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/get-user/{id}', [AdminController::class, 'getUser'])->name('admin.getUser');
        Route::post('/users/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');
        Route::post('/users/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
        Route::delete('/users/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

        Route::group(['prefix' => 'leagues'], function() {
            Route::get('/', [LeagueController::class, 'index'])->name('admin.leagues.index');
            Route::get('/create', [LeagueController::class, 'create'])->name('admin.leagues.create');
            Route::post('/store', [LeagueController::class, 'store'])->name('admin.leagues.store');
            Route::get('/get/{id}', [LeagueController::class, 'get'])->name('admin.leagues.edit');
            Route::put('/update/{id}', [LeagueController::class, 'update'])->name('admin.leagues.update');
            Route::delete('/delete/{id}', [LeagueController::class, 'delete'])->name('admin.leagues.delete');
        });
        Route::prefix('plans')->name('admin.plans.')->group(function () {
            Route::get('/', [PlanController::class, 'index'])->name('index');
            Route::get('/create', [PlanController::class, 'create'])->name('create');
            Route::post('/store', [PlanController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PlanController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PlanController::class, 'delete'])->name('delete');
        });
        Route::prefix('teams')->name('admin.teams.')->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::get('/create', [TeamController::class, 'create'])->name('create');
            Route::post('/store', [TeamController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [TeamController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [TeamController::class, 'delete'])->name('delete');
        });
        Route::prefix('predictions')->name('admin.predictions.')->group(function () {
            Route::get('/', [PridectionController::class, 'index'])->name('index');
            Route::get('/create', [PridectionController::class, 'create'])->name('create');
            Route::post('/store', [PridectionController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PridectionController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PridectionController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PridectionController::class, 'delete'])->name('delete');
        });
        Route::prefix('profile')->name('admin.profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });

    });
     Route::middleware(['auth'])->prefix('user')->namespace('user')->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::prefix('profile')->name('user.profile.')->group(function () {
            Route::get('/', [UserController::class, 'profileEditPage'])->name('index');
            Route::post('/update', [UserController::class, 'profileUpdate'])->name('update');
        });

    });
