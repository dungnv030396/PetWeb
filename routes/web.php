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
//Route::get('register', function () {
//    return view('registration.register');
//})->name('registerPage');
Route::get('register','UsersController@registerView')->name('registerPage');
Route::post('register', 'UsersController@store')->name('register');

//register to Supplier

Route::get('register.supplier','UsersController@registerSupplierPage')->name('register.supplier');
Route::post('register.supplier', 'UsersController@registerSupplier')->name('registerToSupplier');
Route::get('register.supplier.success/{id}','UsersController@registerSupplierSuccess')->name('registerSupplierSuccess');


//userProfile
Route::get('userProfile/{id}','UsersController@show');
Route::post('updateInfo', 'UserProfileController@updateProfile');
Route::post('updatePass', 'UserProfileController@updatePassword');
Route::post('updateAvatar', 'UserProfileController@updateAvatar');

//login && logout
Route::post('login', 'LoginController@login')->name('login');
Route::get('auth/logout','LoginController@destroy');

//login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFB');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFB');
//Route::get('logout/facebook', 'Auth\LoginController@logoutFacebook');

//login google
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

//Forgot pass by email
//Route::get('mail',function (){
//   return view('emails.mailForgotPass');
//});

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
//sp add product view
Route::get('supplier/manage/add-product','SupplierController@addProductView')->name('addProductView');
//add product
Route::post('supplier/manage/add-product','ProductController@postProduct')->name('addProduct');
//detail add product

//Add comment single
Route::post('them-binh-luan','CommentController@addSingleComment')->name('addSingleComment');
Route::post('them-binh-luan-ajax','CommentController@addSingleCommentAjax')->name('addSingleCommentAjax');

//Report

Route::post('reportSupplier/{id}','ReportController@reportSupplier')->name('reportSupplier');
Route::post('reportProduct/{supplier_id}/{product_id}','ReportController@reportProduct')->name('reportProduct');

//Add Reply comment
Route::post('Tra-loi-binh-luan','CommentController@addReplyComment')->name('addReplyComment');


//Route::post('data/users','DatatableController@getUsers')->name('dataProcessing');//example

// supplier management
Route::get('supplier/manage/supplier-product-list',function (){
    $menu = 'product';
    return view('SupplierView.posted_product_view',compact('menu'));
})->name('productManagement');
Route::post('data/supplier-post-products','DatatableController@getSupplierPosts')->name('dataSupplierPostProducts');
Route::get('supplier/manage/view-detail-product/{id}','ProductController@viewDetailProduct')->name('productDetailBySupplier');
//Redirect sang trang dang nhap vao quan ly cua Moderator
// Moderator management

Route::post('moderator/manage/order-list','ModeratorController@loginModerator')->name('loginModerator');
Route::post('data/orders','DatatableController@getOrders')->name('orderDataProcessing');//example

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
    $menu = 'order';
    return view('ModeratorView.order_view',compact('menu'));
})->name('listOrder');

//Orders history
Route::get('customer/ordershistory/{id}','PaymentController@ordersHistory')->name('ordersHistory');
Route::get('customer/detailorder/{id}','PaymentController@detailOrder')->name('detailOrders');
Route::post('customer/ordershistory/{id}','PaymentController@searchOrdersHistory')->name('searchOrderHistosry');

//demo

Route::get('thong-tin-don-hang','PaymentController@checkoutSucess')->name('checkoutSucess');

Route::post('data-load','ProductController@loadCategoriesAjax')->name('loadCategories');

Route::get('quan-ly/homepage',function (){
    $menu = 'home';
    return view('ModeratorView.home',compact('menu'));
})->name('moderator_manage_place');

Route::get('quan-ly/don-hang/{id}','ModeratorController@orderDetail')->name('orderDetail');

//print order
Route::get('print/don-hang/{id}','ModeratorController@printOrder')->name('printOrder');

Route::get('tiep-nhan/don-hang/{id}','ModeratorController@orderAssign')->name('orderAssign');
Route::get('bo-tiep-nhan/don-hang/{id}','ModeratorController@orderAssignDelete')->name('orderAssignDelete');
Route::get('huy/don-hang/{id}','ModeratorController@orderDelete')->name('orderDelete');

Route::post('edit/product','ProductController@editProductAjax')->name('editProductAjax');
Route::post('remove/product','ProductController@removeProductAjax')->name('removeProductAjax');


Route::get('san-pham-can-giao/danh-sach',function (){
    $menu = 'product';
    return view('SupplierView.order_product',compact('menu'));
})->name('order_product');

Route::post('san-pham-can-giao','DatatableController@orderProductsAjax')->name('dataSupplierPostOrderProducts');
Route::post('user/update-bank','UserProfileController@updateUserBankInfo')->name('updateUserBankInfo');