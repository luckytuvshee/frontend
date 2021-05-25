<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BasketItem;
use App\Order;
use App\Employee;
use App\Shipment;
use DataTables;
use Auth;

class OrderController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {    
            if(Auth()->user()->employee_type_id == 2)
                $data = Order::join('shipments', 'orders.id', 'shipments.order_id')
                                    ->where('shipper_id', '=', Auth()->user()->id)->get();
            else
                $data = Order::select([
                                'id as order_id',
                                'order_status_id', 
                                'user_id', 
                                'basket_id', 
                                'address_id', 
                                'created_at', 
                                'updated_at'
                               ])
                               ->get();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.order.action')->with('row', $row);
                    })
                    ->addColumn('amount', function($row) {
                        return '₮' . $row->basket->total;
                    })
                    ->editColumn('order_status_id', function($row) {
                        return $row->status->order_status;
                    })
                    ->editColumn('user_id', function($row) {
                        return $row->user->email;
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->editColumn('updated_at', function($row) {
                        if($row->order_status_id == 5) {
                            $shipment = Shipment::where('order_id', '=', $row->order_id)->get()[0];
                            return $shipment->updated_at->format('Y.m.d H:i:s');
                        }
                        return 'Хүргэгдээгүй';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.order.index');
    }

    public function assign($id) 
    {
        $order = Order::findOrFail($id);
        if($order->order_status_id > 1) {
            return redirect()->route('orders');
        }

        $order->order_status_id = 2;
        $order->save();

        return redirect()->route('orders')->with('success',  '#' . $id . ' захиалга амжилттай баталгаажлаа');
    }

    public function package($id) 
    {
        $order = Order::findOrFail($id);

        // if this order has already assigned for someone (clerk) or hasn't confirmed
        if($order->order_status_id != 2) {
            return redirect()->route('orders');
        }

        $basketItems = BasketItem::where('basket_id', '=', $order->basket_id)->get();

        $shipping_shippers = Employee::select([
                                    'employees.id as employee_id',
                                    'first_name',
                                    'last_name',
                                    DB::raw('COUNT(employees.id) as shipping_queue')
                                  ])
                                 ->join('shipments', 'employees.id', 'shipments.shipper_id')
                                 ->join('orders', 'shipments.order_id', 'orders.id')
                                 ->where('employee_type_id', '=', 2)
                                 ->whereIn('order_status_id', [3, 4])
                                 ->groupBy('employees.id')
                                 ->get()
                                 ->toArray();
        
        $new_shippers = Employee::select([
                                    'employees.id as employee_id',
                                    'first_name',
                                    'last_name',
                                    DB::raw('0 as shipping_queue')
                                  ])
                                 ->leftJoin('shipments', 'employees.id', 'shipments.shipper_id')
                                 ->leftJoin('orders', 'shipments.order_id', 'orders.id')
                                 ->where('employee_type_id', '=', 2)
                                 ->where('shipments.id', '=', NULL)
                                 ->get()
                                 ->toArray();

        $free_shippers = Employee::select([
                                    'employees.id as employee_id',
                                    'first_name',
                                    'last_name',
                                    DB::raw('0 as shipping_queue')
                                ])
                                ->join('shipments', 'employees.id', 'shipments.shipper_id')
                                ->join('orders', 'shipments.order_id', 'orders.id')
                                ->where('employee_type_id', '=', 2)
                                ->whereIn('order_status_id', [5])
                                ->get()
                                ->toArray();

        $shippers = array_merge($shipping_shippers, $new_shippers, $free_shippers);

        return view('pages.order.package')->with(['shippers' => $shippers, 'basketItems' => $basketItems, 'order' => $order]);
    }

    public function package_order(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => 'required',
        ], [
            'employee.required' => 'Хуваарилах хүртгэлтийн ажилтан сонгогдоогүй байна'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withErrors($validator->errors()->all());
        }

        $order = Order::findOrFail($id);

        if($order->order_status_id != 2) {
            return redirect()->route('orders');
        }

        $order->order_status_id = 3;
        $order->save();

        $shipment = new Shipment;
        $shipment->shipper_id = explode('.', $request->employee)[0];
        $shipment->order_id = $id;
        $shipment->save();

        return redirect()->route('orders')->with('success',  '#' . $id . ' захиалга амжилттай бэлтгэгдэж, хүргэлтийн ажилтанд хуваариладсан');
    }

    public function shipping_started($id)
    {
        $order = Order::findOrFail($id);

        $shipperOrders = Shipment::where('shipper_id', '=', Auth()->user()->id)->where('order_id', '=', $id)->get();

        // if this order is not assigned for this shipper. 
        if(!$shipperOrders->count()) {
            return redirect()->route('orders');
        }

        // if this order has already assigned for someone (shipper) or hasn't packaged
        if($order->order_status_id != 3) {
            return redirect()->route('orders');
        }

        $order->order_status_id = 4;
        $order->save();
        
        return redirect()->route('orders')->with('success',  '#' . $id . ' захиалга хүргэлтэнд гарсан');
    }

    public function shipped($id)
    {
        $order = Order::findOrFail($id);

        $shipperOrders = Shipment::where('shipper_id', '=', Auth()->user()->id)->where('order_id', '=', $id)->get();

        // if this order is not assigned for this shipper. 
        if(!$shipperOrders->count()) {
            return redirect()->route('orders');
        }

        // if this order has already assigned for someone (shipper) or hasn't packaged
        if($order->order_status_id != 4) {
            return redirect()->route('orders');
        }

        $order->order_status_id = 5;
        $order->save();
        
        return redirect()->route('orders')->with('success',  '#' . $id . ' захиалга амжилттай хүргэгдлээ');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
