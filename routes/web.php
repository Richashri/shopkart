<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){

    Route::match(['get', 'post'], '/', 'AdminController@login');


    //admin guard group

    Route::group(['middleware' => ['admin']], function(){
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('check-current-pwd', 'AdminController@check_current_pwd');
        Route::post('update-admin-pwd', 'AdminController@update_pwd');
        Route::post('admin-other-settings', 'AdminController@admin_other_settings');

        //sections route
        Route::get('sections', 'SectionController@index');
        Route::get('section-delete/{did}', 'SectionController@delete');
        Route::post('section-update', 'SectionController@update');
        Route::post('section-add', 'SectionController@add');

        //brands route
        Route::get('brands', 'BrandController@index');
        Route::get('brand-delete/{did}', 'BrandController@delete');
        Route::post('brand-update', 'BrandController@update');
        Route::post('brand-add', 'BrandController@add');

        //category route       
        Route::get('categories', 'CategoryController@index')->name('categories_list');
        Route::get('category-delete/{did}', 'CategoryController@delete');
        Route::get('category-edit/{eid}', 'CategoryController@edit');
        Route::post('category-update/{eid}', 'CategoryController@update');
        Route::get('category-create', 'CategoryController@create');
        Route::post('category-add', 'CategoryController@add');
        Route::post('delete-img-cat', 'CategoryController@delete_image');
        //product route
        Route::resource('product','ProductController');
        //Route::get('categories', 'CategoryController@index')->name('categories_list');
        //Route::get('category-delete/{did}', 'CategoryController@delete');
        //Route::get('category-edit/{eid}', 'CategoryController@edit');
        //Route::post('category-update/{eid}', 'CategoryController@update');
        //Route::get('category-create', 'CategoryController@create');
        //Route::post('category-add', 'CategoryController@add');
        //Route::post('delete-img-cat', 'CategoryController@delete_image');
        //Route::get('product','ProductsController@index');


    });    
});
