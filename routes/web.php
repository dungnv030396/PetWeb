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
Route::get('test',[
    'uses'=>'PageController@test'
]);


Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'productDetail',
    'uses'=>'PageController@getProductDetail'
]);
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
    'as'=>'gioithieu',
    'uses'=>'PageController@getGioiThieu'
]);