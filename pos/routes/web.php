<?php

use App\Http\Controllers\invoiceController;
use Illuminate\Support\Facades\Route;
use App\http\Livewire\Product;
use App\http\Livewire\Cart;
use App\http\Livewire\Category;
use App\http\Livewire\Membership;
use App\http\Livewire\Transaction;
use App\http\Livewire\ProductTransaction;
use App\http\Livewire\Invoice;
use App\Http\Livewire\Chart;
use App\http\Livewire\Auth\Login;
use App\http\Livewire\Auth\Register;
use App\http\Livewire\Auth\Logout;



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => ['auth','ceklevel:admin,kasir']], function () {
    Route::get('/products', Product::class);
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/Membership', Membership::class);
    Route::get('/Category', Category::class);  
    Route::get('/transaction', Transaction::class); 
    Route::get('/invoice/{invoice_number}', [invoiceController::class,'invoice_param'])->name('invoice_param'); 
    
    // Route::get('/invoice/{invoice_number}',[Invoice::class, 'invoice_param'])->name('invoice_param');
    //Route::get('/invoice',[Invoice::class, 'view_invoice']);


    
    Route::get('/ProductTransaction', ProductTransaction::class);
    // Route::get('/Transaction',[Transaction::class,'index']);
    Route::get('/Chart', Chart::class);
    Route::get('/delete/{id}',[Category::class, 'delete'])->name('delete');
    Route::get('/delete2/{id}',[Membership::class, 'delete2'])->name('delete2');
    Route::get('/delete1/{id}',[Product::class, 'delete1'])->name('delete1');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', Logout::class)->name('logout');
});