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
Route::get('contact',[
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);
Route::post('send-contact-success','ContactController@create')->name('sendContact');
Route::get('introduce',[
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

Route::get('register','UsersController@registerView')->name('registerPage');
Route::post('register-success', 'UsersController@store')->name('register');

//register to Supplier

Route::get('register/supplier','UsersController@registerSupplierPage')->name('register.supplier');
Route::post('register/supplier', 'UsersController@registerSupplier')->name('registerToSupplier');
Route::get('register/supplier/success/{id}','UsersController@registerSupplierSuccess')->name('registerSupplierSuccess');


//userProfile
Route::get('userProfile/{id}','UsersController@show');
Route::post('update-information', 'UserProfileController@updateProfile')->name('updateInfo');
Route::post('update-password', 'UserProfileController@updatePassword')->name('updatePass');
Route::post('update-avatar', 'UserProfileController@updateAvatar')->name('updateAvatar');

//login && logout
Route::post('login', 'LoginController@login')->name('login');
Route::get('auth/logout','LoginController@destroy');

//login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFB');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFB');

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
Route::get('list-suppliers','SupplierController@listSupplier')->name('listSupplier');
Route::post('search-suppliers','SupplierController@searchByName')->name('searchSupplier');
Route::get('detail-suppliers/{id}','SupplierController@detailSupplier')->name('detailSupplier');

//Forgot pass by email
//Route::get('mail',function (){
//   return view('emails.mailForgotPass');
//});

//Reset Pasword
Route::post('reset-password','MailController@resetPassword')->name('resetPassword');
Route::get('reset-password-page',function (){
    return view('clientViews.profile.resetPassword');
})->name('resetPasswordPage');
Route::post('changePassByEmail/{user_id}','MailController@changePassword')->name('changePassChecked');

Route::get('changePassByMail/{token}','MailController@checkUrl')->name('changePassByMail');
Route::get('changePassByMail',function (){
    return view('clientViews.profile.change_pass_by_email');
})->name('backChangePassByMail');

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

Route::post('report-supplier/{id}','ReportController@reportSupplier')->name('reportSupplier');
Route::post('reportProduct/{supplier_id}/{product_id}','ReportController@reportProduct')->name('reportProduct');
Route::post('moderator/manage/report-process/{id}','ReportController@reportProcess')->name('reportProcess');
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
Route::post('moderator/manage/waiting-report-list','DatatableController@getListsReport')->name('reportDataProcessing');
Route::post('moderator/manage/processed-report-list','DatatableController@getListsProcessedReport')->name('reportDataProcessed');

Route::post('data/orders','DatatableController@getOrders')->name('orderDataProcessing');//example

Route::get('login/moderator', function (){
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
Route::get('hoan-thanh/don-hang/{id}','ModeratorController@orderSuccess')->name('orderSuccess');

Route::post('edit/product','ProductController@editProductAjax')->name('editProductAjax');
Route::post('remove/product','ProductController@removeProductAjax')->name('removeProductAjax');


Route::get('san-pham-can-giao/danh-sach',function (){
    $menu = 'product';
    return view('SupplierView.order_product',compact('menu'));
})->name('order_product');

Route::post('san-pham-can-giao','DatatableController@orderProductsAjax')->name('dataSupplierPostOrderProducts');
Route::post('user/update-bank','UserProfileController@updateUserBankInfo')->name('updateUserBankInfo');

Route::post('sent/product','SupplierController@sentProductAjax')->name('sentProductAjax');

Route::get('don-hang/kho/{id}','ModeratorController@orderOfWarehouseView')->name('orderOfWarehouse');
Route::post('data/warehouse-orders','DatatableController@getOrdersWarehouse')->name('orderWarehouseDataProcessing');
Route::get('ban-giao/don-hang/{id}','ModeratorController@orderShip')->name('orderShip');
Route::get('kho/san-pham/{id}','ModeratorController@productToWarehouseView')->name('productToWarehouseView');
Route::post('kho/san-pham','DatatableController@productToWarehouse')->name('productToWarehouse');
Route::post('confirm/san-pham','ModeratorController@confirmProductToWarehouse')->name('confirmProductToWarehouse');

//admin management

Route::get('admin/management/homepage','AdminController@home')->name('admin_manage_place');

Route::post('admin/manage/home','AdminController@loginAdmin')->name('loginAdmin');
Route::get('login/admin', function (){
    if (\Illuminate\Support\Facades\Auth::check()){
        \Illuminate\Support\Facades\Auth::logout();
        return view('AdminView.login');
    }
    return view('AdminView.login');
})->name('loginViewAdmin');
Route::get('logout/admin','AdminController@destroy')->name('logoutAdmin');
Route::get('admin/management/list-registration-form',function (){
    if (!\Illuminate\Support\Facades\Auth::check()){
        return view('AdminView.login');
    }
    $menu = 'supplier';
    return view('AdminView.list_registration_form',compact('menu'));
})->name('listRegistrationForm');
Route::post('admin/manage/list-registration-form','DatatableController@getListRegistrations')->name('registrationDataProcessing');
Route::get('admin/management/registration-form/detail/{id}','AdminController@viewDetailRegistration')->name('viewDetailRegistration');
Route::post('admin/management/process-registration-form/{id}','AdminController@registrationProcess')->name('registrationProcessing');
Route::get('admin/manage/waiting-report-list',function (){
    $menu = 'report';
    return view('AdminView.waiting_report_view',compact('menu'));
})->name('getListsReport');

Route::get('admin/manage/processed-report-list',function (){
    $menu = 'report';
    return view('AdminView.processed_report_view',compact('menu'));
})->name('getListsProcessedReport');
Route::get('admin/manage/report-list/detail/{id}','ReportController@detailWaitingReport')->name('detailWaitingReport');

Route::get('/admin/management/payment-supplier','AdminController@supplier_financeView')->name('supplierFinanceView');

Route::post('/admin/management/finance-data','DatatableController@supplier_financeDataAjax')->name('supplier_financeData');
Route::post('thanh-toan/ma-don','AdminController@paymentForSupplierAjax')->name('paymentForSupplierAjax');
Route::get('/admin/management/finance','AdminController@webFinanceView')->name('webFinanceView');

Route::get('admin/manage/list-customers',function (){
    $menu = 'listusers';
    return view('AdminView.list_customers',compact('menu'));
})->name('getListCustomerPage');
Route::get('admin/manage/list-suppliers',function (){
    $menu = 'listusers';
    return view('AdminView.list_suppliers',compact('menu'));
})->name('getListSupplierPage');
Route::get('admin/manage/list-moderators',function (){
    $menu = 'listusers';
    return view('AdminView.list_moderators',compact('menu'));
})->name('getListModeratorsPage');

Route::get('admin/manage/list-customers-blocked',function (){
    $menu = 'listusers';
    return view('AdminView.list_customers_blocked',compact('menu'));
})->name('getListCustomersBlockedPage');
Route::get('admin/manage/list-suppliers-blocked',function (){
    $menu = 'listusers';
    return view('AdminView.list_suppliers_blocked',compact('menu'));
})->name('getListSupplierBlockedPage');
Route::get('admin/manage/list-moderators-blocked',function (){
    $menu = 'listusers';
    return view('AdminView.list_moderators_blocked',compact('menu'));
})->name('getListModeratorBlockedPage');

Route::post('admin/management/list-customers','DatatableController@getListUsers')->name('getListCustomers');
Route::post('admin/manage/users-list/block','AdminController@blockAccount')->name('blockAccountByAdmin');
Route::post('admin/management/blocked-users-list','DatatableController@getListUsersBlocked')->name('getListUsersBlocked');

Route::post('admin/management/store-finance-data','DatatableController@store_financeDataAjax')->name('store_financeData');
Route::post('admin/manage/users-list/unblock','AdminController@unblockAccount')->name('unblockAccountByAdmin');

//at supplier manage
Route::get('supplier/management/finance','SupplierController@supplier_financeView')->name('supplier_financeView');
Route::post('supplier/management/finance-data','DatatableController@getSupplier_financeDataAjax')->name('atSupplierView_financeData');

//tinh tong tien dat hang ajax
Route::post('data-load/amount','CartsController@loadAmountAjax')->name('loadAmount');
//chart
Route::post('data-load/finance_days','AdminController@loadDataFinanceDaysAjax')->name('loadDataFinanceDays');
Route::post('data-load/finance_months','AdminController@loadDataFinanceMonthsAjax')->name('loadDataFinanceMonths');
Route::post('data-load/finance_years','AdminController@loadDataFinanceYearsAjax')->name('loadDataFinanceYears');

Route::post('search-product','ProductController@searchProductByName')->name('searchProductByName');
Route::get('search-product','ProductController@searchProductByName');

