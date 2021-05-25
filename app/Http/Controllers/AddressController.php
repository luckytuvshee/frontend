<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Cookie;
use Illuminate\Http\Request;
use DataTables;
use App\City;
use App\District;
use App\Subdistrict;

class AddressController extends Controller
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
            $data = City::select(['id as city_id', 'city_name', 'created_at', 'updated_at'])->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.address.action')->with('row', $row);
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->editColumn('updated_at', function($row) {
                        return $row->updated_at->format('Y.m.d H:i:s');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.address.index');
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
    public function districts(Request $request, $id)
    {
        if($id > 0) {
            Cookie::queue('temp_city_id', $id, '3600');
        }

        if ($request->ajax()) {
            $data = District::select(['id as district_id', 'city_id', 'district_name', 'created_at', 'updated_at'])
                                    ->where('city_id', '=', Cookie::get('temp_city_id'))
                                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.address.district-action')->with('row', $row);
                    })
                    ->editColumn('city_id', function($row) {
                        return $row->city->city_name;
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->editColumn('updated_at', function($row) {
                        return $row->updated_at->format('Y.m.d H:i:s');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.address.district');
    }

    public function subdistricts(Request $request, $id)
    {
        if($id > 0) {
            Cookie::queue('temp_district_id', $id, '3600');
        }

        if ($request->ajax()) {
            $data = Subdistrict::select(['id as subdistrict_id', 'district_id', 'subdistrict_name', 'created_at', 'updated_at'])
                                    ->where('district_id', '=', Cookie::get('temp_district_id'))
                                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.address.subdistrict-action')->with('row', $row);
                    })
                    ->editColumn('district_id', function($row) {
                        return $row->district->district_name;
                    })
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('Y.m.d H:i:s');
                    })
                    ->editColumn('updated_at', function($row) {
                        return $row->updated_at->format('Y.m.d H:i:s');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.address.subdistrict');
    }

    public function subdistrict_add(Request $request, $id)
    {
        $subdistrict = new Subdistrict;
        $subdistrict->subdistrict_name = $request->subdistrict_name;
        $subdistrict->district_id = $id;
        
        if($subdistrict->save())
            return redirect()->route('subdistricts', ['id' => $id])
                                ->with('success', $subdistrict->subdistrict_name . ' амжилттай нэмэгдлээ');
        else
            return redirect()->route('subdistricts')
                                ->with('warning', $subdistrict->subdistrict_name . ' нэмэгдсэнгүй');
    }

    public function district_add(Request $request, $id)
    {
        $district = new District;
        $district->district_name = $request->district_name;
        $district->city_id = $id;
        
        if($district->save())
            return redirect()->route('districts', ['id' => $id])
                                ->with('success', $district->district_name . ' дүүрэг амжилттай нэмэгдлээ');
        else
            return redirect()->route('districts')
                                ->with('warning', $district->district_name . ' дүүрэг нэмэгдсэнгүй');
    }

    public function city_add(Request $request)
    {
        $city = new City;
        $city->city_name = $request->city_name;
        
        if($city->save())
            return redirect()->route('cities')
                                ->with('success', $city->city_name . ' хот амжилттай нэмэгдлээ');
        else
            return redirect()->route('cities')
                                ->with('warning', $city->city_name . ' хот нэмэгдсэнгүй');
    }

    public function city_delete(Request $request)
    {
        $city = City::findOrFail($request->city_id);
        
        if($city->delete())
            return redirect()->route('cities')
                            ->with('success', $city->city_name . ' хот амжилттай устгагдлаа');
        else
            return redirect()->route('cities')
                            ->with('warning', $city->city_name . ' хот устсангүй');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function city_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
        ], [
            'city_name.required' => 'Засах хотын нэр хоосон байна, засах үйлдэл амжилтгүй боллоо'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withErrors($validator->errors()->all());
        }

        $city = City::findOrFail($request->city_id);
        $city->city_name = $request->city_name;
        $city->save();

        return redirect()->route('cities')->with('success',  '#' . $request->city_id . ' кодтой хотын нэр ' . $request->city_name . ' болж өөрчлөгдлөө');
    }

    public function district_delete(Request $request)
    {
        $district = District::findOrFail($request->district_id);
        if($district->delete())
            return redirect()->route('districts', ['id' => $district->city_id])
                            ->with('success', $district->district_name . ' дүүрэг амжилттай устгагдлаа');
        else
            return redirect()->route('districts', ['id' => $district->city_id])
                            ->with('warning', $district->district_name . ' дүүрэг устсангүй'); 
    }

    public function district_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_name' => 'required',
        ], [
            'district_name.required' => 'Засах дүүргийн нэр хоосон байна, засах үйлдэл амжилтгүй боллоо'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withErrors($validator->errors()->all());
        }

        $district = District::findOrFail($request->district_id);
        $district->district_name = $request->district_name;
        $district->save();

        return redirect()->route('districts', ['id' => $district->city_id])->with('success',  '#' . $request->district_id . ' кодтой дүүргийн нэр ' . $request->district_name . ' болж өөрчлөгдлөө');
    }

    public function subdistrict_delete(Request $request)
    {
        $subdistrict = Subdistrict::findOrFail($request->subdistrict_id);
        if($subdistrict->delete())
            return redirect()->route('subdistricts', ['id' => $subdistrict->district_id])
                            ->with('success', $subdistrict->subdistrict_name . ' амжилттай устгагдлаа');
        else
            return redirect()->route('subdistricts', ['id' => $subdistrict->district_id])
                            ->with('warning', $subdistrict->subdistrict_name . ' устсангүй');
    }

    public function subdistrict_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subdistrict_name' => 'required',
        ], [
            'subdistrict_name.required' => 'Засах хорооны нэр хоосон байна, засах үйлдэл амжилтгүй боллоо'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withErrors($validator->errors()->all());
        }

        $subdistrict = Subdistrict::findOrFail($request->subdistrict_id);
        $subdistrict->subdistrict_name = $request->subdistrict_name;
        $subdistrict->save();

        return redirect()->route('subdistricts', ['id' => $subdistrict->district_id])->with('success',  '#' . $request->subdistrict_id . ' кодтой хорооны нэр ' . $request->subdistrict_name . ' болж өөрчлөгдлөө');
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
