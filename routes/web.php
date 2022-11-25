<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('get-logout');
Route::get('/home', [\App\Http\Controllers\Seller\OrderController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth',
    //'namespace' => 'Seller',
    'prefix' => 'seller',
    ], function(){
    Route::group(['middleware' => 'is_seller'], function (){
        Route::get('/orders', [\App\Http\Controllers\Seller\OrderController::class, 'index'])->name('home');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});



Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/categories', [MainController::class, 'categories'])->name('categories');


Route::group(['prefix' => 'basket',], function () {
    Route::post('/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

    Route::group([
        'middleware' => 'basket_not_empty',
    ], function (){
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');
        Route::post('/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::post('/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
    });
});



Route::get('/{category}', [MainController::class, 'category'])->name('category');

Route::get('/{category}/{product?}', [MainController::class, 'product'])->name('product');



