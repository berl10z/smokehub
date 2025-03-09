<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'catalog'])->name('home');

Route::get('/catalog', [ProductController::class,'catalog'])->name('catalog');
Route::get('/catalog/{id}', [ProductController::class,'show'])->name('product.show');

Route::get('/login',[AuthController::class,'showLoginForm'])->name('show.login');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class,'index'])->name('index');
            Route::get('/trash',[AdminController::class, 'trash'])->name('trash');

        Route::prefix('products')->group(function () {
            Route::get('/create', [AdminController::class,'create'])->name('product.create');
            Route::post('/store', [AdminController::class,'store'])->name('product.store');
            Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('product.destroy');
            Route::delete('/forceDelete/{id}', [AdminController::class, 'forceDelete'])->name('product.forceDelete');
            Route::post('/restore/{id}', [AdminController::class, 'restoreProduct'])->name('product.restore');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('product.edit');
            Route::put('/edit/{id}', [AdminController::class, 'update'])->name('product.update');
            Route::put('/increment/{id}', [AdminController::class, 'increment'])->name('product.increment');
            Route::put('/decrement/{id}', [AdminController::class, 'decrement'])->name('product.decrement');
        });

        Route::prefix('categories')->group(function() {
            Route::get('/', [CategoryController::class,'index'])->name('category.index');
            Route::get('/create', [CategoryController::class,'create'])->name('category.create');
            Route::post('/store', [CategoryController::class,'store'])->name('category.store');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });
        Route::prefix('brands')->group(function() {
            Route::get('/', [BrandController::class,'index'])->name('brand.index');
            Route::get('/create', [BrandController::class,'create'])->name('brand.create');
            Route::post('/store', [BrandController::class,'store'])->name('brand.store');
            Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
        });
    });
});

