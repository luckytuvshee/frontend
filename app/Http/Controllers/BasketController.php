<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Basket;
use App\BasketItem;

class BasketController extends Controller
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
            $data = Basket::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return $row->id;
                    })
                    ->addColumn('action', function($row) {
                        return view('pages.basket.action')->with('row', $row);
                    })
                    ->editColumn('total', function($row) {
                        return $row->total ? $row->total : 'Захиалга хийгдээгүй байна';
                    })
                    ->editColumn('user_id', function($row) {
                        return $row->user->email;
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.basket.index');
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
        $basketItems = BasketItem::where('basket_id', '=', $id)->get();
        return view('pages.basket.show')->with('basketItems', $basketItems);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit')
                    ->with('user', $user);
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => $request->email == User::findOrFail($id)->email ? '' : 'required|email|max:255|unique:users',
            'mobile_number' => 'required|numeric|min:8',
            'password' => trim($request->password) == '' ? '' : 'string|min:8|confirmed',
        ], 
        [
            'password.confirmed' => 'Давтаж хийсэн нууц үг таарахгүй байна',
            'email.unique' => 'Имэйл давхцаж байна, өөр имэйл оруулна уу'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('first_name', 'last_name', 'email', 'mobile_number'))
                             ->withErrors($validator->errors()->all());
        }

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;

        if(trim($request->password) != "")
            $user->password = Hash::make($request->password);

        if($user->save())
            return redirect()->route('employees')->with('success', 'Хэрэглэгчийн мэдээлэл амжилттай засварлагдлаа');
        else
            return response()->json(['error' => 'error occured']);
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
