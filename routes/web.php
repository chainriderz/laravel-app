<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

// Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', fn() => view('frontend.about'));
Route::get('/contact', fn() => view('frontend.contact'));

// Backend (RBAC protected)
Route::middleware(['auth','permission:view_admin_dashboard'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
});

Route::middleware(['permission:create_user'])->group(function () {
    Route::get('/admin/users/create', [UserController::class, 'create']);
});
