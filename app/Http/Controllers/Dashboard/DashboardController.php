<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    
    }
    public function index(Request $request){
        $orders = Order::count();
        $products = Product::count();
        $revenue = Order::where('status','Success')->sum('price');
        $users = User::whereIn('role', ['Guest', 'Client' , 'User'])->count();
        if($request->isMethod('post')){
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $orders = Product::whereBetween('created_at', [$startDate, $endDate])->count();
            $products = Order::whereBetween('created_at', [$startDate, $endDate])->count();
            $users = User::whereBetween('created_at', [$startDate, $endDate])->count();
            $revenue = Order::where('status','Success')->whereBetween('created_at', [$startDate, $endDate])->sum('price');
            return view('BackEnd.Dashboard.index',compact('orders','users','products','revenue','startDate','endDate'));
        }
        return view('BackEnd.Dashboard.index',compact('orders','users','products','revenue'));
    }
}
