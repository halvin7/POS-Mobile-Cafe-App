<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Membership;
use App\Models\ProductTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction = Transaction::all();
        $last1 = Transaction::where('created_at', '>', now()->subDays(1)->endOfDay())->get();
        $last7 = Transaction::where('created_at', '>', now()->subDays(7)->endOfDay())->get();
        $last30 = Transaction::where('created_at', '>', now()->subDays(30)->endOfDay())->get();
        $last365 = Transaction::where('created_at', '>', now()->subDays(365)->endOfDay())->get();
        $category = Category::all();
        $membership = Membership::all();
        $user = User::all();
        $product = Product::all();
        $producttransaction =ProductTransaction::all();
        return view('home', compact('transaction','last365','last30','last7', 'last1', 'category', 'user', 'product', 'membership','producttransaction'));
    }
}
