<?php

Route::get('/', 'FrontEndController@index');
Route::post('/cartStore', 'FrontEndController@cartStore');
Route::get('/showCart', 'FrontEndController@showCart');
Route::get('removeCartItem/{id}', 'FrontEndController@removeCart');
Route::get('product-details/{id}', 'FrontEndController@productDetails');
Route::get('removeFromCart/{id}', 'FrontEndController@removeFromCart');
Route::get('user-logout', 'FrontEndController@logout');
Route::view('login-register', 'frontEnd.loginAndRegister');
Route::get('cart', 'FrontEndController@cart');
Route::post('cartUpdate', 'FrontEndController@cartUpdate');
Route::get('shop', 'FrontEndController@shop');
Route::get('filter', 'FrontEndController@filter');
Route::get('brand/{slug}', 'FrontEndController@brand');
Route::get('type/{slug}', 'FrontEndController@type');
Route::get('checkout', 'FrontEndController@checkout');
Route::post('order', 'FrontEndController@order');
Route::get('shop/category/{slug}', 'FrontEndController@category');
Route::get('shop/sub-category/{slug}', 'FrontEndController@subCategory');
Route::get('shop/mini-category/{slug}', 'FrontEndController@miniCategory');
Route::get('search', 'FrontEndController@search');
Route::get('blog', 'FrontEndController@blog');
Route::get('blog/{slug}', 'FrontEndController@blogDetail');
Route::post('reviewSave', 'FrontEndController@reviewStore');
Route::get('contact-us', 'FrontEndController@contactUs');
Route::post('subscribe', 'FrontEndController@newsletter');
Route::get('terms-and-conditions', 'FrontEndController@termsAndConditions');

//-----------------------------------------------------------//
Route::group(['middleware' => ['web', 'frontendChack', 'verified']], function () {

    Route::get('wishlistStore', 'FrontEndController@wishlistStore');
    Route::get('wishlists', 'FrontEndController@wishlistIndex');
    Route::get('wishlistDelete/{id}', 'FrontEndController@wishlistDelete');

    Route::get('payment', 'PaymentController@index');
    Route::post('charge', 'PaymentController@charge');
    Route::get('paymentsuccess', 'PaymentController@payment_success');
    Route::get('paymenterror', 'PaymentController@payment_error');
    Route::get('checkout', 'FrontEndController@checkout');
    Route::get('my-account', 'FrontEndController@myAccount');
    Route::post('myAccountStore/{id}', 'FrontEndController@myAccountStore');
    Route::post('myAccountDetail/{id}', 'FrontEndController@myAccountDetail');
    Route::get('compare/{id}', 'FrontEndController@compare');
    Route::get('compare', 'FrontEndController@compareShow');
});
//-----------------------------------------------------------//

Auth::routes(['verify' => true]);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});
//-----------------------------------------------------------//

Route::group(['middleware' => ['web', 'backEndEndChack']], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('admin/profile', 'Admin\NavbarController@profile');
    Route::get('admin/layoutSet/{layout}/{sidebar}/{minisidebar}', 'Admin\NavbarController@layoutStting');
    Route::get('admin/restore', 'Admin\NavbarController@restore');
    Route::post('admin/profile/save', 'Admin\NavbarController@profileStore');
    Route::get('admin/activities', 'Admin\ActivityController@activityAll');
    Route::view('admin/settings', 'admin.setting.index');
    Route::get('admin/sendGroupMail', 'EmailController@sendGroupMail');
    Route::post('admin/sendSingleMail', 'Admin\EmailController@sendSingleMail');
    Route::get('admin/email/send', 'Admin\EmailController@send');
    Route::get('admin/emails/mailbox', 'Admin\EmailController@mailbox');
    Route::get('admin/email/{id}', 'Admin\EmailController@showEdit');
    Route::get('admin/emails/delete', 'Admin\EmailController@destroyEmail');
    Route::get('admin/emails/draftbox', 'Admin\EmailController@draftbox');
    Route::get('admin/emails/draft/{id}', 'Admin\EmailController@draft');
    Route::get('admin/SubCategory/set/{id}', 'Admin\ProductController@subCategory');
    Route::get('admin/MiniCategory/set/{id}', 'Admin\ProductController@miniCategory');
    Route::get('admin/order', 'Admin\DashboardController@order');
    Route::get('admin/orderItem/{id}', 'Admin\DashboardController@orderItem');
    Route::get('admin/payment/{id}', 'Admin\DashboardController@payment');
    Route::get('admin/delivery/{id}', 'Admin\DashboardController@delivery');
    Route::get('admin/invoice/{id}', 'Admin\DashboardController@invoice');
    Route::get('admin/customer', 'Admin\DashboardController@customer');
    Route::get('admin/paypal-info', 'Admin\DashboardController@paypalInfo');
    Route::post('admin/paypal-info/save', 'Admin\DashboardController@paypalInfoStore');
    Route::get('admin/banner', 'Admin\DashboardController@banner');
    Route::post('admin/banner/save', 'Admin\DashboardController@bannerStore');
    Route::get('admin/contact-us', 'Admin\DashboardController@contactUs');
    Route::post('admin/contact-us/save', 'Admin\DashboardController@contactUsStore');
    Route::get('admin/newsletters', 'Admin\DashboardController@newsletterShow');
    Route::get('admin/setting', 'Admin\DashboardController@setting');
    Route::post('admin/setting/save', 'Admin\DashboardController@settingStore');
    Route::get('admin/terms-and-conditions', 'Admin\DashboardController@termsAndConditions');
    Route::post('admin/terms-and-conditions/save', 'Admin\DashboardController@termsAndConditionsStore');

});

//-----------------------------------------------------------//||
Route::get('/home', 'HomeController@index')->name('home'); //||
Route::get('/crudIndex', 'HomeController@crudIndex'); //||
Route::get('/crud2index', 'HomeController@crud2index'); //||
Route::post('/jsonSave', 'HomeController@jsonSave'); //||
Route::post('/crudMaker', 'HomeController@crudMaker'); //||
//-----------------------------------------------------------//||

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'backEndEndChack']], function () {
    Route::resource('/category', 'CategoryController');
    Route::resource('/sub-category', 'SubCategoryController');
    Route::resource('/mini-category', 'MiniCategoryController');
    Route::resource('/type', 'TypeController');
    Route::resource('/brand', 'BrandController');
    Route::resource('/size', 'SizeController');
    Route::resource('/color', 'ColorController');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/product', 'ProductController');
    Route::resource('/purchase-item', 'PurchaseItemController');
    Route::resource('/slider', 'SliderController');
    Route::resource('/shipping-charge', 'ShippingChargeController');
    Route::resource('/country', 'CountryController');
    Route::resource('/blog', 'BlogController');
});
Route::resource('admin/blog', 'Admin\\BlogController');
Route::resource('admin/offer', 'Admin\\OfferController');