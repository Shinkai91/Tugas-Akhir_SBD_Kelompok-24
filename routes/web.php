<?php

use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return redirect(route('user.home'));
})->name('/');


#USER AUTHENTICATION
Route::get('/user/login','LoginController@ViewUserLogin')->name('user.login.view');
Route::post('/user/login','LoginController@AuthUserLogin')->name('user.login.auth');

Route::get('/user/register','LoginController@ViewUserRegister')->name('user.register.view');
Route::post('/user/register','LoginController@AuthUserRegister')->name('user.register.auth');

Route::get('/user','HomeController@HomeUser')->name('user.home');

#USER ORDER
Route::get('/user/order','OrderController@ViewOrder')->name('user.order');
Route::get('/user/cart', 'OrderController@ViewTransactionOrder')->name('user.keranjang');
Route::post('/user/product-order', 'OrderController@ProductOrder')->name('user.productorder');
Route::get('/user/order/edit/{id}','OrderController@EditTransactionOrder')->name('user.editkeranjang');
Route::post('/user/order/update','OrderController@UpdateTransactionOrder')->name('user.order.update');
Route::get('/user/order/delete/{id}','OrderController@DeleteTransactionOrder')->name('user.order.delete');
Route::get('/user/check', 'OrderController@EditTransactionCheck')->name('user.checkout');
Route::post('/user/checkout','OrderController@UpdateTransactionCheck')->name('user.check');
Route::get('/user/history','OrderController@ViewHistory')->name('user.status');

#ADMIN AUTHENTICATION
Route::get('/admin/login','LoginController@ViewAdminLogin')->name('admin.login.view');
Route::post('/admin/login','LoginController@AuthAdminLogin')->name('admin.login.auth');
Route::get('/admin','HomeController@HomeAdmin')->name('admin.home');

#ADMIN (ORDER)
Route::get('/admin/order','OrderController@ViewAdminOrder')->name('admin.home.order');
Route::get('/admin/order/delete/{id}','OrderController@DeleteOrder')->name('admin.home.order.delete');
Route::get('/admin/order/edit/{id}','OrderController@EditOrder')->name('admin.home.order.edit');
Route::post('/admin/order/update','OrderController@UpdateOrder')->name('admin.home.order.update');

#ADMIN (USER)
Route::get('/admin/user','UserController@ViewAdminUser')->name('admin.home.user');
Route::get('/admin/user/delete/{id}','UserController@DeleteUser')->name('admin.home.user.delete');
Route::get('/admin/user/edit/{id}','UserController@EditUser')->name('admin.home.user.edit');
Route::post('/admin/user/update','UserController@Updateuser')->name('admin.home.user.update');
Route::get('/admin/user/hardelete', 'UserController@HardDeleteAll')->name('admin.home.user.hardelete');
Route::get('/admin/user/restore', 'UserController@RestoreAll')->name('admin.home.user.restore');

#ADMIN (BAJU)
Route::get('/admin/baju','BajuController@ViewBaju')->name('admin.home.baju');
Route::post('/admin/baju','BajuController@AddBaju')->name('admin.home.baju.add');
Route::get('/admin/baju/delete/{id}','BajuController@DeleteBaju')->name('admin.home.baju.delete');
Route::get('/admin/baju/edit/{id}','BajuController@EditBaju')->name('admin.home.baju.edit');
Route::post('/admin/baju/update','BajuController@UpdateBaju')->name('admin.home.baju.update');
Route::get('/admin/baju/hardelete', 'BajuController@hardDeleteAll')->name('admin.home.baju.hardelete');
Route::get('/admin/baju/restore', 'BajuController@RestoreAll')->name('admin.home.baju.restore');

#LOGOUT
Route::get('/logout','LoginController@logout')->name('logout');