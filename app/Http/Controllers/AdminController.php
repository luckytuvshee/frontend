<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Order;
use App\User;
use App\Shipment;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // auth:guard
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(in_array(Auth()->user()->type->id, [1]))
        {
            $order_count = Order::all()->count();
            $product_count = Product::all()->count();
            $user_count = User::where('id', '<>', 1)->get()->count(); // exclude default guest user which has id of 1
            $employee_count = Employee::all()->count();

            return view('dashboard')->with([
                                            'order_count' => $order_count, 
                                            'product_count' => $product_count,
                                            'user_count' => $user_count,
                                            'employee_count' => $employee_count
                                        ]);
        }
        else if(Auth()->user()->type->id == 2)
        {
            $received_order_count = Shipment::where('shipper_id', '=', Auth()->user()->id)
                                            ->get()
                                            ->count();

            $shipped_order_count = Shipment::join('orders', 'shipments.order_id', 'orders.id')
                                            ->where('shipper_id', '=', Auth()->user()->id)
                                            ->where('orders.order_status_id', '=', 5)
                                            ->get()
                                            ->count();

            $waiting_order_count = Shipment::join('orders', 'shipments.order_id', 'orders.id')
                                            ->where('shipper_id', '=', Auth()->user()->id)
                                            ->whereIn('orders.order_status_id', [3, 4])
                                            ->get()
                                            ->count();

            return view('dashboard')->with([
                                                'received_order_count' => $received_order_count, 
                                                'shipped_order_count' => $shipped_order_count,
                                                'waiting_order_count' => $waiting_order_count,
                                            ]);

        }
    }

    public function charts() 
    {
        $orders = Order::select([
                                DB::raw('DAY(created_at) as date'),
                                DB::raw('COUNT(*) as orders_count')
                            ])
                            ->whereMonth('created_at', '>=', Carbon::now()->month)
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        $labels = [];
        $data = [];

        foreach ($orders as $key=>$order) {
            $labels[$key] = 'өдөр ' . $order['date'];
            $data[$key] = $order['orders_count'];
        }

        // monthly order stats

        $monthly_orders = Order::select([
                                DB::raw('MONTH(created_at) as date'),
                                DB::raw('COUNT(*) as orders_count')
                            ])
                            ->whereYear('created_at', '>=', Carbon::now()->year)
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        $monthly_labels = [];
        $monthly_data = [];

        foreach ($monthly_orders as $key=>$order) {
            $monthly_labels[$key] = $order['date'] . ' сар';
            $monthly_data[$key] = $order['orders_count'];
        }

        return response()->json(['current_month_labels' => $labels, 'current_month_data' => $data,
                                 'monthly_labels' => $monthly_labels, 'monthly_data' => $monthly_data]);
    }

    
}
