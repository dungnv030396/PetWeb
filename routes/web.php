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

Route::get('san-pham-theo-loai/{cata_id}/{cate_id}',[
    'as'=>'sanphamtheoloai',
    'uses'=>'PageController@getProductsByType'
]);

Route::get('san-pham-theo-loai/{cata_id}',[
    'as'=>'sanphamtheoloai',
    'uses'=>'PageController@getProductsByType'
]);

Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'productDetail',
    'uses'=>'PageController@getProductDetail'
]);
//Supports
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
    'as'=>'gioithieu',
    'uses'=>'PageController@getGioiThieu'
]);
Route::get('privacyPolicy',function (){
 return view('clientViews.supports.privacyPolicy');
})->name('privacyPolicy');

Route::get('returnPolicy',function (){
    return view('clientViews.supports.returnPolicy');
})->name('returnPolicy');

Route::get('shoppingGuide',function (){
    return view('clientViews.supports.shoppingGuide');
})->name('shoppingGuide');

Route::get('guarantee',function (){
    return view('clientViews.supports.guarantee');
})->name('guarantee');

Route::get('recruitment',function (){
    return view('clientViews.supports.recruitment');
})->name('recruitment');
//Register
Route::get('register', function () {
    return view('registration.register');
});
Route::post('register', 'UsersController@store')->name('register');

//register to Supplier

Route::get('register.supplier',function (){
    return view('clientViews.customer.registerToSupplier');
})->name('register.supplier');
Route::post('registerToSupplier', 'UsersController@registerSupplier')->name('registerToSupplier');


//userProfile
Route::get('userProfile/{id}','UsersController@show');
Route::post('updateInfo', 'UserProfileController@updateProfile');
Route::post('updatePass', 'UserProfileController@updatePassword');
Route::post('updateAvatar', 'UserProfileController@updateAvatar');

//login && logout
Route::post('login', 'LoginController@login')->name('login');
Route::get('auth/logout','LoginController@destroy');

//login & logout facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFB');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFB');
Route::get('logout/facebook', 'Auth\LoginController@logoutFacebook');

//login & logout google
Route::get('login/google', 'Auth\LoginController@redirectToProviderGM');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallbackGM');


//add to cart and delete cart

Route::post('them-vao-gio-hang', 'CartsController@addToCart')->name('themgiohang');

Route::get('del-cart/{id}',[
    'as'=>'xoagiohang',
    'uses'=>'CartsController@removeCart'
]);

//dat hang
Route::get('dat-hang','CartsController@getCheckout')->name('viewCheckout');
Route::post('thanh-toan', 'PaymentController@checkout')->name('checkout');

//Supplier
Route::get('listSupplier','SupplierController@listSupplier')->name('listSupplier');
Route::post('searchSupplier','SupplierController@searchByName');
Route::get('detailSupplier/{id}','SupplierController@detailSupplier')->name('detailSupplier');

//test
Route::get('mail',function (){
   return view('emails.mailForgotPass');
});

//Reset Paswork
Route::post('resetPassword','MailController@resetPassword')->name('resetPassword');
Route::get('resetPassword',function (){
    return view('clientViews.profile.resetPassword');
});
Route::post('changePassByMail','MailController@changePassword');

Route::get('changePassByMail/{id}',function (){

    return view('clientViews.profile.changePassByEmail');
});

//Quan? Ly cua supplier

Route::get('nha-cung-cap/quan-ly/home','SupplierController@home')->name('supplier_manage_place');

Route::get('logout/moderator','ModeratorController@destroy')->name('logout');

Route::post('loginToManagement','SupplierController@loginToManagement')->name('loginToManagement');


//Add comment single
Route::post('them-binh-luan','CommentController@addSingleComment')->name('addSingleComment');
Route::post('them-binh-luan-ajax','CommentController@addSingleCommentAjax')->name('addSingleCommentAjax');

//Report

Route::post('reportSupplier/{id}','ReportController@reportSupplier')->name('reportSupplier');
Route::post('reportProduct/{supplier_id}/{product_id}','ReportController@reportProduct')->name('reportProduct');

//Add Reply comment
Route::post('Tra-loi-binh-luan','CommentController@addReplyComment')->name('addReplyComment');


Route::post('data/users','DatatableController@getUsers')->name('dataProcessing');//example

// supplier management
Route::get('supplier/management',function (){
    return view('SupplierView.home',compact('menu'));

})->name('supplierManagement');

//Redirect sang trang dang nhap vao quan ly cua Moderator
// Moderator management

Route::post('moderator/manage/order-list','ModeratorController@loginModerator')->name('loginModerator');
Route::post('data/orders','DatatableController@getOrders')->name('orderDataProcessing');

Route::get('dang-nhap/moderator', function (){
    if (\Illuminate\Support\Facades\Auth::check()){
        \Illuminate\Support\Facades\Auth::logout();
        return view('ModeratorView.login');
    }
    return view('ModeratorView.login');
})->name('loginView');
Route::get('moderator/manage/order-list',function (){
    if (!\Illuminate\Support\Facades\Auth::check()){
        return view('ModeratorView.login');
    }
    $menu = 'menu';
    return view('ModeratorView.order_view',compact('menu'));
})->name('listOrder');

Route::get('supplier/manage/order-list',function (){
    $menu = 'order';
    return view('SupplierView.order_view',compact('menu'));
})->name('listOrderSp');

//sp add product view
Route::get('supplier/manage/add-product',function (){
    $menu = 'product';
    return view('SupplierView.add_product_view',compact('menu'));
})->name('addProductView');
//demo

Route::get('load','SupplierController@load')->name('load');
Route::get('demo','SupplierController@demo')->name('demo');

Route::get('thong-tin-don-hang','PaymentController@checkoutSucess')->name('checkoutSucess');
