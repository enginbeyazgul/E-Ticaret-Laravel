<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('index');
Route::post('/', [\App\Http\Controllers\Home::class, 'indexLogin'])->name('login');
Route::get('/urunler', [\App\Http\Controllers\Products::class, 'products'])->name('products');
Route::get('/urun', [\App\Http\Controllers\Products::class, 'product'])->name('product');
Route::post('/urun', [\App\Http\Controllers\Products::class, 'productP'])->name('product');
Route::get('/hakkimizda', [\App\Http\Controllers\AboutUs::class, 'aboutUs'])->name('aboutus');
Route::get('/sepet', [\App\Http\Controllers\Cart::class, 'cart'])->name('cart');
Route::post('/sepet', [\App\Http\Controllers\Cart::class, 'cartPost'])->name('cart');
Route::get('/odeme', [\App\Http\Controllers\Payment::class, 'payment'])->name('payment');
Route::get('/logout', [\App\Http\Controllers\Logout::class,'logout'])->name('logout');
Route::get('/logouta', [\App\Http\Controllers\Logout::class,'logouta'])->name('logouta');

Route::get('/admin-paneli', [\App\Http\Controllers\Admin::class, 'loginPage'])->name('loginpage');
Route::post('/admin-paneli', [\App\Http\Controllers\Admin::class, 'loginProcess'])->name('loginprocess');
Route::get('/admin-main', [\App\Http\Controllers\Admin::class, 'adminPage'])->middleware('admincontrol')->name('adminpage');
Route::post('/admin-main', [\App\Http\Controllers\Admin::class, 'adminPageOrders'])->middleware('admincontrol')->name('adminpageorders');
Route::get('/admin-main/products', [\App\Http\Controllers\Admin::class, 'products'])->middleware('admincontrol')->name('adminproducts');
Route::post('/admin-main/products', [\App\Http\Controllers\Admin::class, 'productAdd'])->middleware('admincontrol')->name('adminproductadd');
Route::get('/admin-main/customers', [\App\Http\Controllers\Admin::class, 'customers'])->middleware('admincontrol')->name('admincustomers');
Route::post('/admin-main/customers', [\App\Http\Controllers\Admin::class, 'customerAdd'])->middleware('admincontrol')->name('admincustomeradd');
