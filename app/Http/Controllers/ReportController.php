<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Shipment;
use Illuminate\Support\Facades\DB;
use DataTables;


class ReportController extends Controller
{
    public function __construct()
    {
        // auth:guard
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function packaging_report(Request $request)
    {
        if ($request->ajax()) {    
            $data = Shipment::select([
                                    'shipments.clerk_id as clerk_id',
                                    'employees.first_name as first_name',
                                    'employees.last_name as last_name',
                                    'baskets.total as total',
                                    DB::raw('COUNT(*) as packaging_count')
                                ])
                                ->join('orders', 'shipments.order_id', 'orders.id')
                                ->join('baskets', 'orders.basket_id', 'baskets.id')
                                ->join('employees', 'shipments.clerk_id', 'employees.id')
                                ->where('order_status_id', '>=', 3)
                                ->groupBy('clerk_id')
                                ->orderBy('total', 'DESC')
                                ->get();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('pages.report.packaging-report');
    }

    public function shipment_report(Request $request)
    {
        if ($request->ajax()) {    
            $data = Shipment::select([
                                    'shipments.shipper_id as shipper_id',
                                    'employees.first_name as first_name',
                                    'employees.last_name as last_name',
                                    'baskets.total as total',
                                    DB::raw('COUNT(IF(order_status_id = 3, NULL, 1)) as shipment_count')
                                ])
                                ->join('orders', 'shipments.order_id', 'orders.id')
                                ->join('baskets', 'orders.basket_id', 'baskets.id')
                                ->join('employees', 'shipments.shipper_id', 'employees.id')
                                ->where('order_status_id', '>=', 3)
                                ->groupBy('shipper_id')
                                ->orderBy('shipment_count', 'DESC')
                                ->get();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('pages.report.shipment-report');

        return view('pages.report.shipment-report');
    }
}
