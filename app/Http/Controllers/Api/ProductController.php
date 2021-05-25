<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\LikedProduct;
use App\ProductType;

class ProductController extends Controller
{
    // Search result
    public function search(Request $request)
    {
        return DB::table('products')
                    ->select([
                        'products.id',
                        'product_name',
                        // 'type_name',
                        // 'name',
                        'image',
                        'price',
                        'products.created_at',
                    ])
                    ->join('product_types', 'product_types.id', 'products.product_type_id')
                    ->join('product_type_groups', 'product_types.type_group_id', 'product_type_groups.id')
                    ->where('product_name', 'like', '%' . $request->value . '%')
                    ->orWhere('name', 'like', '%' . $request->value . '%')
                    ->orWhere('type_name', 'like', '%' . $request->value . '%')
                    ->get();
    }

    public function similar($id)
    {
        $product = Product::findOrFail($id);
        $product_type_id = $product->type->id;

        return DB::table('products')
                    ->select([
                        'products.id',
                        'product_name',
                        // 'type_name',
                        // 'name',
                        'image',
                        'price',
                        'products.created_at',
                    ])
                    ->join('product_types', 'product_types.id', 'products.product_type_id')
                    ->join('product_type_groups', 'product_type_groups.id', 'product_types.type_group_id')
                    ->where('product_types.id', '=', $product_type_id)
                    ->where('products.id', '<>', $id)
                    ->take(4)
                    ->get();
    }


    public function product_types()
    {
        return ProductType::all();
    }

    // Get Types Group
    public function type_group_products($group_id)
    {
        return DB::table('products')
                    ->select([
                        'products.id',
                        'product_name',
                        'image',
                        'price',
                        'products.created_at',
                    ])
                    ->join('product_types', 'product_types.id', 'products.product_type_id')
                    ->where('product_types.type_group_id', '=', $group_id)
                    ->get();
    }

    // Get Type Products
    public function type_products($type_id)
    {
        return Product::select([
                            'products.id',
                            'product_name',
                            'image',
                            'price',
                            'products.created_at',
                        ])
                        ->where('product_type_id', '=', $type_id)->get();
    }

    // Get Brand Products
    public function brand_products($brand_id)
    {
        return Product::select([
                            'products.id',
                            'product_name',
                            'image',
                            'price',
                            'products.created_at',
                        ])
                        ->where('product_brand_id', '=', $brand_id)->get();
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                        ->select([
                            'id',
                            'product_name',
                            'image',
                            'price',
                            'created_at',
                        ])
                        ->get();
        
        return response()->json(['products' => $products]);
    }

    public function liked_products($user_id)
    {
        $liked_products = DB::table('liked_products')
                            ->where('user_id', '=', $user_id)
                            ->get();

        return response()->json(['liked_products' => $liked_products]);
    }

    public function add_liked(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'product_id' => ['required'],
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'validation failed'], 400);
        }

        try
        {
            $liked_product = DB::table('liked_products')
                                ->where([
                                    ['user_id', '=', $request->user_id],
                                    ['product_id', '=', $request->product_id],
                                ])
                                ->get();

            if(count($liked_product) != 0)
            {
                return response()->json(['error' => 'duplicate product_id'], 400);
            }

            $product = new LikedProduct;
            $product->user_id = $request->user_id;
            $product->product_id = $request->product_id;
            $product->save();
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'catching error xD'], 400);
        }


        return response()->json(['product' => $product]);
    }

    public function remove_liked(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'product_id' => ['required'],
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => 'validation failed'], 400);
        }

        $liked_product = LikedProduct::where([
                                ['user_id', '=', $request->user_id],
                                ['product_id', '=', $request->product_id],
                            ])
                            ->first();

        
        $liked_product_id = $liked_product->id;
                            
        $liked_product->delete();

        if($liked_product)
        {
            return response()->json(['liked_id' => $liked_product_id]);
        }
        else 
        {
            return response()->json(['error' => 'error occurred while removing a product, maybe wrong ids xD'], 400);
        }
        
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
        $product = Product::findOrFail($id);
        $product->increment('views');
        
        return response()->json(['product' => $product]);
    }

    public function popular()
    {
        return DB::table('products')
                    ->select([
                        'products.id',
                        'product_name',
                        // 'type_name',
                        // 'name',
                        'image',
                        'price',
                        'views',
                        'products.created_at',
                    ])
                    // ->join('product_types', 'product_types.id', 'products.product_type_id')
                    // ->join('product_type_groups', 'product_types.type_group_id', 'product_type_groups.id')
                    ->orderBy('products.views', 'DESC')
                    ->take(10)
                    ->get();
    }

    public function most_purchased()
    {
        return DB::table('orders')
                    ->select([
                        // 'products.id',
                        // 'product_name',
                        // 'type_name',
                        // 'name',
                        // 'image',
                        // 'price',
                        // 'views',
                        // 'products.created_at',
                        // 'orders.basket_id',
                        // 'orders.id as order_id',
                        // 'product_registration_id',

                        'products.id',
                        'product_name',
                        'image',
                        'price',
                        'views',
                        'products.created_at',
                        DB::raw('COUNT(products.id) as purchase_count')
                    ])
                    ->join('baskets', 'orders.basket_id', 'baskets.id')
                    ->join('basket_items', 'baskets.id', 'basket_items.basket_id')
                    ->join('product_registrations', 'basket_items.product_registration_id', 'product_registrations.id')
                    ->join('products', 'product_registrations.product_id', 'products.id')
                    ->groupBy('products.id')
                    ->orderBy('purchase_count', 'DESC')
                    ->take(10)
                    ->get();
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
