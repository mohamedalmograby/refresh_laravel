<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        $orders = Order::with('orderItems.product')->get();
        return view('admin.orders', compact('orders'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products' , compact("products"));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users' , compact('users'));
    }
}
