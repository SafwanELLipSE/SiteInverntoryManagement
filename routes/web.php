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
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' =>'employee', 'as'=>'employee.'], function(){
        Route::get('create',['as' =>'create','uses' =>'EmployeeController@createEmployee' ]);
        Route::post('save-created',['as' =>'save_created','uses' =>'EmployeeController@saveCreatedEmployee' ]);
        Route::get('all-employees',['as' =>'all_employees','uses' =>'EmployeeController@getEmployeeList' ]);
        Route::get('all-suppliers',['as' =>'all_suppliers','uses' =>'EmployeeController@getSupplierList' ]);
        Route::get('all-accounts',['as' =>'all_accounts','uses' =>'EmployeeController@getAccountList' ]);
        Route::get('details/{id}',['as' =>'details','uses' =>'EmployeeController@detailEmployee' ]);
        Route::post('delete',['as' =>'delete','uses' =>'EmployeeController@deleteEmployee' ]);
        Route::get('edit/{id}',['as' =>'edit','uses' =>'EmployeeController@editEmployee' ]);
        Route::post('save-edit',['as' =>'save_edit','uses' =>'EmployeeController@updateEmployee']);
      });

      Route::group(['prefix' =>'category', 'as'=>'category.'], function(){
          Route::get('create',['as' =>'create','uses' =>'CategoryController@createCategory' ]);
          Route::post('save-created',['as' =>'save_created','uses' =>'CategoryController@saveCreatedCategory' ]);
          Route::get('all-categories',['as' =>'all_categories','uses' =>'CategoryController@getCategoryList' ]);
          Route::get('details/{id}',['as' =>'details','uses' =>'CategoryController@detailCategory' ]);
          Route::post('delete',['as' =>'delete','uses' =>'CategoryController@deleteCategory' ]);
          Route::get('edit/{id}',['as' =>'edit','uses' =>'CategoryController@editCategory' ]);
          Route::post('save-edit',['as' =>'save_edit','uses' =>'CategoryController@updateCategory']);
        });

      Route::group(['prefix' =>'brand', 'as'=>'brand.'], function(){
          Route::get('create',['as' =>'create','uses' =>'BrandController@createBrand' ]);
          Route::post('save-created',['as' =>'save_created','uses' =>'BrandController@saveCreatedBrand' ]);
          Route::get('all-brands',['as' =>'all_brands','uses' =>'BrandController@getBrandList' ]);
          Route::get('details/{id}',['as' =>'details','uses' =>'BrandController@detailBrand' ]);
          Route::post('delete',['as' =>'delete','uses' =>'BrandController@deleteBrand' ]);
          Route::get('edit/{id}',['as' =>'edit','uses' =>'BrandController@editBrand' ]);
          Route::post('save-edit',['as' =>'save_edit','uses' =>'BrandController@updateBrand']);
        });
      Route::group(['prefix' =>'product', 'as'=>'product.'], function(){
          Route::get('create',['as' =>'create','uses' =>'ProductController@createProduct' ]);
          Route::post('save-created',['as' =>'save_created','uses' =>'ProductController@saveCreatedProduct' ]);
          Route::get('all-products',['as' =>'all_products','uses' =>'ProductController@getProductList' ]);
          Route::get('details/{id}',['as' =>'details','uses' =>'ProductController@detailProduct' ]);
          Route::post('delete',['as' =>'delete','uses' =>'ProductController@deleteProduct' ]);
          Route::get('edit/{id}',['as' =>'edit','uses' =>'ProductController@editProduct' ]);
          Route::post('save-edit',['as' =>'save_edit','uses' =>'ProductController@updateProduct']);
        });
      Route::group(['prefix' =>'stock', 'as'=>'stock.'], function(){
          Route::get('create',['as' =>'create','uses' =>'StockController@createStock' ]);
          Route::post('save-created',['as' =>'save_created','uses' =>'StockController@saveCreatedStock' ]);
          Route::get('all-stocks',['as' =>'all_stocks','uses' =>'StockController@getStockList' ]);
          Route::post('save-edit',['as' =>'save_edit','uses' =>'StockController@editStock']);
          Route::post('save-update',['as' =>'save_update','uses' =>'StockController@updateStock']);
          Route::post('save-restock',['as' =>'save_restock','uses' =>'StockController@reStockStock']);
          Route::post('save-status',['as' =>'save_status','uses' =>'StockController@changeStockStatus']);
          Route::get('record/{id}',['as' =>'record','uses' =>'StockController@viewStockRecord' ]);
          Route::get('excel-report/{id}',['as' =>'excel_report','uses' =>'StockController@excelReport' ]);
        });

});
