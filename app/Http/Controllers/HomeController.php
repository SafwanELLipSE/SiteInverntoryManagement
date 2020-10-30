<?php

namespace App\Http\Controllers;

use App\Charts\OrderChart;
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

        if(Auth::user()->isMasterAdmin())
        {
            $today = Order::whereDate('created_at', '=',date('Y-m-d'))->count();
            $yesterday = Order::whereDate('created_at', '=', date('Y-m-d',strtotime('-1 days')) )->count();
            $lastWeek = Order::whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')) )->count();
            $lastYear = Order::whereDate('created_at', '>', date('Y-m-d',strtotime('-365 days')) )->count();

            $times = array();
            $days = array();
            $count = 1;
            for($i=1; $i<=7;$i++){
                $times[] = $count;
                $days[] = Order::whereDate('created_at', '=', date('Y-m-d',strtotime('-'.$count.' days')) )->count();
                $count++;
            }
        }
        if(Auth::user()->isSiteManager())
        {
            $today = Order::where('created_by',Auth::user()->id)->whereDate('created_at', '=',date('Y-m-d'))->count();
            $yesterday = Order::where('created_by',Auth::user()->id)->whereDate('created_at', '=', date('Y-m-d',strtotime('-1 days')) )->count();
            $lastWeek = Order::where('created_by',Auth::user()->id)->whereDate('created_at', '>', date('Y-m-d',strtotime('-7 days')) )->count();
            $lastYear = Order::where('created_by',Auth::user()->id)->whereDate('created_at', '>', date('Y-m-d',strtotime('-365 days')) )->count();

            $times = array();
            $days = array();
            $count = 1;
            for($i=1; $i<=7;$i++){
                $times[] = $count;
                $days[] = Order::where('created_by',Auth::user()->id)->whereDate('created_at', '=', date('Y-m-d',strtotime('-'.$count.' days')) )->count();
                $count++;
            }
        }

        $chart = new OrderChart;
        $chart->labels(['1','2','3','4','5','6','7']);
        $chart->dataset('Day\'s Order','bar',$days)
        ->backgroundColor('rgba(112, 195, 250, 0.93)')->color('rgba(16, 20, 148, 1)');

        return view('home',[
          'getProductCount' => $getProductCount,
          'getBrandCount' => $getBrandCount,
          'getCategoryCount' => $getCategoryCount,
          'getEmployeeCount' => $getEmployeeCount,
          'getSupplierCount' => $getSupplierCount,
          'getAccountCount' => $getAccountCount,
          'getSiteManagerCount' => $getSiteManagerCount,
          'getOrderCount' => $getOrderCount,
          'today' => $today,
          'yesterday' => $yesterday,
          'lastWeek' => $lastWeek,
          'lastYear' => $lastYear,
          'chart' => $chart,
        ]);
    }
}
