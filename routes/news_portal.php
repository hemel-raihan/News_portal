<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'NewsPortal\HomepageController@index')->name('home');

Route::get('/home/video', 'NewsPortal\HomepageController@video')->name('home.video');
Route::post('/home/section/category', 'SingleVendor\HomepageController@load_category_section')->name('home.section.category');
Route::post('/home/section/flashdeal', 'SingleVendor\HomepageController@load_flashdeal_section')->name('home.section.flashdeal');
Route::post('/home/section/hot-deals', 'SingleVendor\HomepageController@load_hot_deals_section')->name('home.section.hot-deal');
Route::post('/home/section/best_selling', 'SingleVendor\HomepageController@load_best_selling_section')->name('home.section.best_selling');
Route::post('/home/section/special-offer', 'SingleVendor\HomepageController@load_special_offer_section')->name('home.section.specialoffer');
Route::post('/home/section/featured', 'SingleVendor\HomepageController@load_featured_section')->name('home.section.featured');
Route::post('/home/section/home-brand', 'SingleVendor\HomepageController@load_brand_section')->name('home.section.brand');
Route::post('/home/section/home-callsection', 'SingleVendor\HomepageController@load_call_section')->name('home.section.call');
Route::post('/home/section/home-recent', 'SingleVendor\HomepageController@load_recent_section')->name('home.section.recent');

Route::get('/categories/{slug}', 'NewsPortal\HomepageController@categories')->name('categories');
Route::get('/categories/{slug}/all', 'NewsPortal\HomepageController@categories_all')->name('categories.all');
Route::get('/fetchnews/{id}', 'NewsPortal\HomepageController@fetchnews')->name('fetchnews');
Route::get('/news/{slug}', 'NewsPortal\HomepageController@news_details')->name('news.details');
Route::get('/product/shops/filtered/{catId}/{id}', 'SingleVendor\HomepageController@filter')->name('shops.filter');
Route::get('/product/shops/filtered/attribute/{catId}/{id}', 'SingleVendor\HomepageController@filterAttribute')->name('shops.filter.attribute');
// Route::get('/product/cart', 'SingleVendor\HomepageController@view_cart')->name('view.cart');
Route::get('/product/checkout', 'SingleVendor\HomepageController@checkout')->name('checkout');


// Customer Panel
Route::get('/customer/dashboard', 'SingleVendor\CustomerController@index')->name('customer.dashboard');
Route::post('/customer/dashboard-home', 'SingleVendor\CustomerController@dashboard_home')->name('customer.dashboard-home');
//orders
//Route::get('/customer/purchase-history', 'SingleVendor\PurchaseHistoryController@purchaseOrders')->name('customer.orders');
Route::post('/customer/purchase-history', 'SingleVendor\PurchaseHistoryController@purchaseOrders')->name('customer.orders');
Route::post('/purchase_history/details', 'SingleVendor\PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');

//Download
// Route::get('/customer/download','SingleVendor\DownloadController@index')->name('download.index');
Route::post('/customer/download','SingleVendor\DownloadController@index')->name('customer.download');

//user-profile
Route::post('/customer/account-details', 'SingleVendor\CustomerController@account_details')->name('customer.account-details');
Route::post('/customer/account-details-update', 'SingleVendor\CustomerController@userProfileUpdate')->name('customer.profile.update');
Route::post('/customer/address', 'SingleVendor\CustomerController@address')->name('customer.address');
Route::post('/customer/address-add', 'SingleVendor\CustomerController@storeAddress')->name('customer.profile.address');

Route::post('/customer/wishlist', 'SingleVendor\WishlistController@customer_wishlist')->name('customer.wishlist');

//Single add to cart
Route::get('/cart/view', 'SingleVendor\CartController@index')->name('cart');
Route::post('/cart/show-cart-modal', 'SingleVendor\CartController@showCartModal')->name('cart.showCartModal');
Route::post('/cart/addtocart', 'SingleVendor\CartController@addToCart')->name('cart.addToCart');
Route::post('/cart/removeFromCart', 'SingleVendor\CartController@removeFromCart')->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', 'SingleVendor\CartController@updateQuantity')->name('cart.updateQuantity');
Route::get('/cart/checkout', 'SingleVendor\CartController@checkout')->name('checkout');
//Order+OrderDetails Store
Route::post('/order/store','SingleVendor\OrderController@store')->name('order.store');
Route::get('/order/order-success', 'SingleVendor\OrderController@order_confirmed')->name('order.success');









