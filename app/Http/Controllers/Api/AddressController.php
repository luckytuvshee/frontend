<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\District;
use App\Subdistrict;
use App\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $cities = City::all();
        $districts = District::all();
        $subdistricts = Subdistrict::all();

        return response()->json(['cities' => $cities, 
                                 'districts' => $districts, 
                                 'subdistricts' => $subdistricts]);
    }

    public function user_addresses($id)
    {
        return Address::select([
                                'addresses.id',
                                'user_id',
                                'addresses.city_id',
                                'addresses.district_id',
                                'addresses.subdistrict_id',
                                'details',
                                'receiver_name',
                                'mobile_number',
                                'city_name',
                                'district_name',
                                'subdistrict_name',
                            ])
                            ->where('user_id', '=', $id)
                            ->join('cities', 'cities.id', '=', 'city_id')
                            ->join('districts', 'districts.id', '=', 'district_id')
                            ->join('subdistricts', 'subdistricts.id', '=', 'subdistrict_id')
                            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newAddress = new Address;
        $newAddress->user_id = $request->user_id;
        $newAddress->city_id = $request->city_id;
        $newAddress->district_id = $request->district_id;
        $newAddress->subdistrict_id = $request->subdistrict_id;
        $newAddress->details = $request->details;
        $newAddress->receiver_name = $request->receiver_name;
        $newAddress->mobile_number = $request->mobile_number;
        $newAddress->save();

        return Address::select([
            'addresses.id',
            'user_id',
            'addresses.city_id',
            'addresses.district_id',
            'addresses.subdistrict_id',
            'details',
            'receiver_name',
            'mobile_number',
            'city_name',
            'district_name',
            'subdistrict_name',
        ])
        ->where('addresses.id', '=', $newAddress->id)
        ->join('cities', 'cities.id', '=', 'city_id')
        ->join('districts', 'districts.id', '=', 'district_id')
        ->join('subdistricts', 'subdistricts.id', '=', 'subdistrict_id')
        ->first();
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
        $address = Address::findOrFail($id);
        if($request->city_id)
        {
            $address->city_id = $request->city_id;
        }
        if($request->district_id)
        {
            $address->district_id = $request->district_id;
        }
        if($request->subdistrict_id)
        {
            $address->subdistrict_id = $request->subdistrict_id;
        }
        if($request->details)
        {
            $address->details = $request->details;
        }
        if($request->receiver_name)
        {
            $address->receiver_name = $request->receiver_name;
        }
        if($request->mobile_number)
        {
            $address->mobile_number = $request->mobile_number;
        }

        $address->save();
        
        return Address::select([
            'addresses.id',
            'user_id',
            'addresses.city_id',
            'addresses.district_id',
            'addresses.subdistrict_id',
            'details',
            'receiver_name',
            'mobile_number',
            'city_name',
            'district_name',
            'subdistrict_name',
        ])
        ->where('addresses.id', '=', $address->id)
        ->join('cities', 'cities.id', '=', 'city_id')
        ->join('districts', 'districts.id', '=', 'district_id')
        ->join('subdistricts', 'subdistricts.id', '=', 'subdistrict_id')
        ->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
    }
}
