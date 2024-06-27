<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SetAreaController;
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

Route::group(['middleware' => ['XssSanitizer']], function() {
    Route::redirect('login', '/letadminin');
    Route::get('letadminin', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('letadminin', [LoginController::class, 'login'])->name('post.login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::redirect('/home', '/');

Route::get('set-area/{area}', SetAreaController::class)->name('front.set-area');

Route::get('admin/{path}', function () {
    return redirect()->route('login');
})->where('path', '.*');

Route::view('/{any}', 'errors.404')->where('any', '.*');

