<?php

namespace App\Http\Controllers;
use App\Product;
use App\Brand;
use App\Category;
use App\Employee;
use App\Site_manager;
use App\Order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $getProductCount = Product::count();
        $getBrandCount = Brand::count();
        $getCategoryCount = Category::count();
        $getEmployeeCount = Employee::count();
        $getSupplierCount = Employee::where('access_level','Supplier')->count();
        $getAccountCount = Employee::where('access_level','Account')->count();
        $getSiteManagerCount = Site_manager::count();
        $getOrderCount = Order::count();

        return view('home',[
          'getProductCount' => $getProductCount,
          'getBrandCount' => $getBrandCount,
          'getCategoryCount' => $getCategoryCount,
          'getEmployeeCount' => $getEmployeeCount,
          'getSupplierCount' => $getSupplierCount,
          'getAccountCount' => $getAccountCount,
          'getSiteManagerCount' => $getSiteManagerCount,
          'getOrderCount' => $getOrderCount,
        ]);
    }
}
