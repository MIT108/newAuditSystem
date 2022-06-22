<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


	Route::group(['middleware' => 'auth'], function () {

		Route::get('/', [HomeController::class, 'home']);
		Route::get('dashboard', function () {
			return view('dashboard');
		})->name('dashboard');

		Route::get('billing', function () {
			return view('billing');
		})->name('billing');

		Route::get('profile', function () {
			return view('profile');
		})->name('profile');

		Route::get('rtl', function () {
			return view('rtl');
		})->name('rtl');

		Route::get('user-management', function () {
			return view('pages/user/index');
		})->name('user-management');


		Route::get('user-management', function () {
			return view('pages/user/index');
		})->name('user-management');


        Route::prefix('question')->group(function () {
            Route::get('/', [QuestionController::class, 'index'])->name('question');
            Route::post('/create', [QuestionController::class, 'create'])->name('create.question');
        });


        Route::prefix('courier')->group(function () {
            Route::get('/', [CourierController::class, 'index'])->name('courier');
            Route::post('/create', [CourierController::class, 'create'])->name('create.courier');
        });

        Route::prefix('department')->group(function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('department');
            Route::post('/create', [DepartmentController::class, 'create'])->name('create.department');
        });

        Route::get('/departmentView', [DepartmentController::class, 'view'])->name('view.department');
        Route::post('/createDepartmentSecurity', [DepartmentController::class, 'createDepartmentSecurity'])->name('department.security.create');

        Route::prefix('audit')->group(function () {
            Route::get('/', [AuditController::class, 'index'])->name('department');
        });

        Route::post('/courierSecurity', [DepartmentController::class, 'createCourierSecurity'])->name('create.courier.security');















		Route::get('tables', function () {
			return view('tables');
		})->name('tables');

		Route::get('virtual-reality', function () {
			return view('virtual-reality');
		})->name('virtual-reality');

		Route::get('static-sign-in', function () {
			return view('static-sign-in');
		})->name('sign-in');

		Route::get('static-sign-up', function () {
			return view('static-sign-up');
		})->name('sign-up');

		Route::get('/logout', [SessionsController::class, 'destroy']);
		Route::get('/user-profile', [InfoUserController::class, 'create']);
		Route::post('/user-profile', [InfoUserController::class, 'store']);
		Route::get('/login', function () {
			return view('dashboard');
		})->name('sign-up');
	});



	Route::group(['middleware' => 'guest'], function () {
		Route::get('/register', [RegisterController::class, 'create']);
		Route::post('/register', [RegisterController::class, 'store']);
		Route::get('/login', [SessionsController::class, 'create']);
		Route::post('/session', [SessionsController::class, 'store']);
		Route::get('/login/forgot-password', [ResetController::class, 'create']);
		Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
		Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
		Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

	});

	Route::get('/admin/login', function () {
		return view('session/login-session');
	})->name('login');

