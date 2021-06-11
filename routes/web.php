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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'WebControllers'], function () {

	Route::get('/','IndexController@index');

	Route::get('/products','ProductController@shop');
	Route::get('/productDetails/{p_id}','ProductController@productDetails');

	Route::get('/cart','CartController@cart');
	Route::post('/addToCart','CartController@addToCart');
	Route::post('/cartQuantityEdit','CartController@cartQuantityEdit');
	Route::post('/cartItemDelete','CartController@cartItemDelete');

	Route::get('/checkout','OrdersController@checkout')->name('checkout');
	Route::post('/session_address','OrdersController@session_address');
	Route::post('/cashOnDeliveryOrder','OrdersController@cashOnDeliveryOrder');

	//Route::get('paywithpaypal', 'OrdersController@payWithPaypal');
	Route::post('paypal', 'OrdersController@postPaymentWithpaypal')->name('paypal');
	Route::get('paypal', 'OrdersController@getPaymentStatus')->name('status');
	Route::get('/paymentSuccess','OrdersController@paymentSuccess')->name('paymentSuccess');

	Route::get('/signup','CustomersController@signup');
	Route::post('/signupProcess','CustomersController@signupProcess');

	Route::get('/signin','CustomersController@signin');
	Route::post('/processSignin','CustomersController@processSignin');
	Route::get('/logout','CustomersController@logout');
	Route::get('/userOrders','CustomersController@userOrders');
	Route::get('/userAccount','CustomersController@userAccount');
	Route::post('/updateUserAccount','CustomersController@updateUserAccount');
	Route::get('/userAddress','CustomersController@userAddress');
	Route::post('/addUserAddress','CustomersController@addUserAddress');
	Route::post('/updateaddress','CustomersController@updateaddress');
	Route::get('/deleteaddress','CustomersController@deleteaddress');


});
