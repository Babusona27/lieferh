<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'AdminControllers'], function () {
    Route::get('/', 'AdminController@login');
    Route::post('/checkLogin', 'AdminController@checkLogin');
    Route::get('/logout', 'AdminController@logout');
    Route::get('/signUp', 'AdminController@signUp');
    Route::post('/signUp', 'AdminController@insert');
    Route::get('/dashboard', 'AdminController@dashboard');

    Route::post('/taskById', 'AdminController@taskById');
});

/************** media ***************/
// Route::group(['prefix' => '/media', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
//     Route::get('/display', 'MediaController@display');
//     Route::post('/updatemediasetting', 'MediaController@updatemediasetting');
//     Route::get('/add', 'MediaController@add');
//     Route::post('/uploadimage', 'MediaController@fileUpload');
//     Route::get('/detail/{images_id}', 'MediaController@detailImage');
//     Route::post('/regenerateImage', 'MediaController@regenerateImage');
//     Route::post('/delete', 'MediaController@deleteImage');
//     Route::get('/refresh', 'MediaController@refresh');
// });
/************** media ***************/

/************** customers ***************/
Route::group(['prefix' => '/customers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'CustomersController@display');
    Route::get('/add', 'CustomersController@add');
    Route::post('/add', 'CustomersController@insert');
    Route::get('/edit/{customers_id}', 'CustomersController@edit');
    Route::post('/update', 'CustomersController@update');
    Route::post('/delete', 'CustomersController@delete');
    Route::get('/filter', 'CustomersController@filter');
    Route::get('/uploadExcel', 'CustomersController@uploadExcel');
    Route::post('/bulkUploadCustomer', 'CustomersController@bulkUploadCustomer');
});
/************** customers ***************/

/************** client ***************/
Route::group(['prefix' => '/client', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'ClientController@display');
    Route::get('/add', 'ClientController@add');
    Route::post('/add', 'ClientController@insert');
    Route::get('/edit/{id}', 'ClientController@edit');
    Route::post('/update', 'ClientController@update');
    Route::post('/delete', 'ClientController@delete');
});
/************** client ***************/

/************** drivers ***************/
Route::group(['prefix' => '/drivers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'DriversController@display');
    Route::get('/add', 'DriversController@add');
    Route::post('/add', 'DriversController@insert');
    Route::get('/edit/{drivers_id}', 'DriversController@edit');
    Route::post('/update', 'DriversController@update');
    Route::post('/delete', 'DriversController@delete');
    Route::get('/filter', 'DriversController@filter');
    Route::get('/details/{drivers_id}', 'DriversController@details');
    Route::post('/exportDetails/{drivers_id}', 'DriversController@exportDetails');
});
/************** drivers ***************/

/************** task ***************/
Route::group(['prefix' => '/task', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'TaskController@display');
    Route::get('/details/{task_id}', 'TaskController@details');
    Route::get('/add', 'TaskController@add');
    Route::post('/add', 'TaskController@insert');
    Route::get('/edit/{task_id}', 'TaskController@edit');
    Route::post('/update', 'TaskController@update');
    Route::post('/delete', 'TaskController@delete');
    // Route::get('/filter', 'CustomersController@filter');
    Route::post('/taskCustomerUpload', 'TaskController@taskCustomerUpload');
});
/************** task ***************/

/************** content ***************/
Route::group(['prefix' => '/content', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/termsofuse', 'ContentController@termsofuse');
    Route::post('/updatetermsofuse', 'ContentController@updatetermsofuse');
    Route::get('/privacypolicy', 'ContentController@privacypolicy');
    Route::post('/updateprivacypolicy', 'ContentController@updateprivacypolicy');
    Route::get('/help', 'ContentController@help');
    Route::post('/updatehelp', 'ContentController@updatehelp');
});
/************** content ***************/

/************** content ***************/
Route::group(['prefix' => '/feedback', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/display', 'FeedBackController@display');
});
/************** content ***************/


/************** category ***************/
// Route::group(['prefix' => '/categories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
//     Route::get('/display', 'CategoriesController@display');
//     Route::get('/add', 'CategoriesController@add');
//     Route::post('/add', 'CategoriesController@insert');
//     Route::get('/edit/{id}', 'CategoriesController@edit');
//     Route::post('/update', 'CategoriesController@update');
//     Route::post('/delete', 'CategoriesController@delete');
//     Route::get('/filter', 'CategoriesController@filter');
// });
/************** category ***************/

