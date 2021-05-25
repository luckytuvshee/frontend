<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ProductType;
use App\Product;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ProductController extends Controller
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
            $data = Product::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return view('pages.product.action')->with('row', $row);
                    })
                    ->editColumn('product_type_id', function($row) {
                        return $row->type->type_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_types = ProductType::all();

        return view('pages.product.create')->with(['product_types' => $product_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ], [
            'type.required' => 'Барааны төрөл сонгоогүй байна',
            'image.image' => 'Нүүр зураг зураг биш байна',
            'image.mimes' => 'Нүүр зурагны төрөл jepg, png, jpg, svg байх биш байна',
            'image.max' => 'Нүүр зурагны хэмжээ 2048KB - ээс их байна'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('name', 'description', 'price', 'brand', 'type'))
                             ->withErrors($validator->errors()->all());
        }

        // upload single image
        $front_image_name = $request->image->getClientOriginalName();
        $request->image->move(public_path().'/images/product/', $front_image_name);
        
        // upload multiple image
        $product_images_path = "";
        foreach($request->file('images') as $image)
        {
            $name=$image->getClientOriginalName();
            $image->move(public_path().'/images/product/', $name);
            $product_images_path = $product_images_path . '/images/product/' . '' . $name . '\\';
        }

        // remove last \ character
        $product_images_path = substr($product_images_path, 0, -1);

        $product = new Product;
        $product->product_name = $request->name;
        $product->product_type_id = explode('.', $request->type)[0];
        $product->image =  '/images/product/' . $front_image_name;
        $product->images = $product_images_path;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if($product->save())
        {
            return redirect()->route('products')->with('success', 'Бараа амжилттай нэмэгдлээ');
        }
        else
        {
            return response()->json(['error' => 'error occured']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_types = ProductType::all();

        return view('pages.product.edit')
                    ->with(['product' => $product, 
                            'product_types' => $product_types]);
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
            'name' => 'required|max:255',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ], [
            'type.required' => 'Барааны төрөл сонгоогүй байна',
            'image.image' => 'Нүүр зураг зураг биш байна',
            'image.mimes' => 'Нүүр зурагны төрөл jepg, png, jpg, svg байх биш байна',
            'image.max' => 'Нүүр зурагны хэмжээ 2048KB - ээс их байна'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                             ->withInput($request->only('name', 'description', 'price', 'quantity', 'type'))
                             ->withErrors($validator->errors()->all());
        }

        $product = Product::findOrFail($id);

        if($request->image) 
        {
            // upload single image
            $front_image_name = $request->image->getClientOriginalName();
            $request->image->move(public_path().'/images/product/', $front_image_name);
            $product->image =  '/images/product/' . $front_image_name;
        }

        if($request->images)
        {
            // upload multiple image
            $product_images_path = "";
            foreach($request->file('images') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/product/', $name);
                $product_images_path = $product_images_path . '/images/product/' . '' . $name . '\\';
            }

            // remove last \ character
            $product_images_path = substr($product_images_path, 0, -1);
            $product->images = $product_images_path;
        }


        $product->product_name = $request->name;
        $product->product_type_id = explode('.', $request->type)[0];
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if($product->save())
        {
            return redirect()->route('products')->with('success', 'Бараа амжилттай засварлагдлаа');
        }
        else
        {
            return response()->json(['error' => 'error occured']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Product::findOrFail($request->product_id)->delete())
            return redirect()->route('products')->with('success', 'Бараа амжилттай устлаа');
        else
            return redirect()->route('products')->with('warning', 'Бараа устсангүй');
    }
}
