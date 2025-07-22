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
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/gget/', [App\Http\Controllers\IndexController::class, 'gget']);
Route::get('/dashboard/', [App\Http\Controllers\IndexController::class, 'dashboard']);

Route::get('/new/{id}', [App\Http\Controllers\IndexController::class, 'new']);

Route::group(['middleware' => ['auth']], function () {
Route::get('/home/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/shift/', [App\Http\Controllers\IndexController::class, 'shiftTask']);
});

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


Route::post('/api/login', [ApiController::class, 'authenticate']);
Route::post('/api/register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/api/logout', [ApiController::class, 'logout']);
    Route::post('/api/get_user', [ApiController::class, 'get_user']);


});