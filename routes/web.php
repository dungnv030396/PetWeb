<?php

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
Route::get('index',[
    'as'=>'trangchu',
    'uses'=>'PageController@getIndex'
]);

Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'chitietsanpham',
    'uses'=>'PageController@getChiTiet'
]);
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
    'as'=>'gioithieu',
    'uses'=>'PageController@getGioiThieu'
]);
//Register
Route::get('register', function () {
    return view('registration.register');
});
Route::post('register', 'UsersController@store')->name('register');

//userProfile
Route::get('userProfile/{id}','UsersController@show');

//login && logout

Route::post('login', 'LoginController@login')->name('login');
Route::get('auth/logout','LoginController@destroy');

//userProfile

Route::post('updateInfo', 'UserProfileController@updateProfile');
Route::post('updatePass', 'UserProfileController@updatePassword');
