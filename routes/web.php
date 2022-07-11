<?php

use App\Http\Controllers\ModelsControllers\CategoryController;
use App\Http\Controllers\ModelsControllers\ProductController;
use App\Http\Controllers\MultiProcessController;
use App\Http\Controllers\SearchingController;
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

#Home Page
Route::get('/', function () {
    return view('index');
});



Route::controller(CategoryController::class)->prefix('category')->as('category.')->group(
    function () {

        #Product Index Route Page
        Route::get('/index', 'index')
            ->name('index');

    });

Route::controller(ProductController::class)->prefix('product')->as('product.')->group(
    function () {

        #Product Get Units Route
        Route::get('/units', 'units')
            ->name('units');

        #Product Index Route Page
        Route::get('/index', 'index')
            ->name('index');
        #Product Trash Route
        Route::get('/trash', 'trash')
            ->name('trash');
        #Product Create Route Page
        Route::get('/create', 'create')
            ->name('create');
        #Product Store Route
        Route::post('/store', 'store')
            ->name('store');
        #Product Edit Route
        Route::get('/edit/{product}', 'edit')
            ->name('edit');
        #Product Update Route
        Route::post('/update/{product}', 'update')
            ->name('update');
        #Product Delete Route
        Route::delete('/delete/{product}', 'destroy')
            ->name('delete');
        #Product Force Delete Route
        Route::delete('/force-delete/{product}', 'forceDelete')
            ->name('force-delete');
        #Product Restore Route
        Route::post('/restore/{product}', 'restore')
            ->name('restore');
    }
);


#Product Processing Collection Routes using Ajax with Jquery
Route::controller(MultiProcessController::class)->prefix('multiple-process')->as('multiple-process.')->group(
    function () {

        Route::post('/delete-products', 'delete')
            ->name('delete-products');
        Route::post('/restore-products', 'restore')
            ->name('restore-products');
        Route::post('/force-delete-products', 'forceDelete')
            ->name('force-delete-products');
        Route::post('/edit-category-products', 'editCategory')
            ->name('edit-category-products');
        Route::post('/edit-price-products', 'editPrice')
            ->name('edit-price-products');
        Route::post('/edit-availability-products', 'editAvailability')
            ->name('edit-availability-products');
        Route::post('/edit-unit-products', 'editUnit')
            ->name('edit-unit-products');
        Route::post('/edit-production-date-products', 'editProductionDate')
            ->name('edit-production-date-products');
        Route::post('/edit-expiry-date-products', 'editExpiryDate')
            ->name('edit-expiry-date-products');
    }
);


Route::controller(SearchingController::class)->prefix('searching')->as('searching.')->group(
    function () {

        #Search Products
        Route::post('/search-products', 'searchProducts')
            ->name('search-products');
        #Search Trashed Products
        Route::post('/search-trashed-products', 'searchTrashedProducts')
            ->name('search-trashed-products');
    }
);
