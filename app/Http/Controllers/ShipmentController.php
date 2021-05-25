<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipment;
use App\Order;
use App\Employee;
use DataTables;

class ShipmentController extends Controller
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
                $data = Shipment::join('orders', 'shipments.order_id', 'orders.id')
                                        ->where('shipper_id', '=', Auth()->user()->id)
                                        ->where('order_status_id', '=', 5)
                                        ->get();
            else
                $data = Shipment::all();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('order_status', function($row) {
                        $status = Order::findOrFail($row->order_id)->status->order_status;
                        return $status;
                    })
                    ->editColumn('shipper_id', function($row) {
                        if($row->shipper_id) {
                            $email = Employee::findOrFail($row->shipper_id)->email;
                            return $email;
                        } 
                        return "Захиалга бэлтгэгдээгүй";
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->editColumn('updated_at', function($row) {
                        $status = Order::findOrFail($row->order_id)->status->id;
                        if($status == 5) {
                            $shipment = Shipment::where('order_id', '=', $row->order_id)->get()[0];
                            return $shipment->updated_at->format('Y.m.d H:i:s');
                        }
                        return 'Хүргэгдээгүй';
                        
                    })
                    ->make(true);
        }
        return view('pages.shipment.index');
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
