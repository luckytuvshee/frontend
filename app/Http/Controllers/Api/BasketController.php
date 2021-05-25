<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Basket;
use App\BasketItem;
use App\Order;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        // assuming user would be unique, so I've used first()
        $basket = Basket::with('basket_item')
                    ->where('user_id', '=', $user_id)
                    ->whereNotIn('baskets.id', Order::all()->pluck('basket_id'))
                    ->first();

        if(!$basket)
        {
            $newBasket = new Basket;
            $newBasket->user_id = $user_id;
            $newBasket->save();
            return response()->json(['id' => $newBasket->id, 'basket_item' => []]);
        }

        return $basket;
    }

    public function show($id)
    {
        $product = DB::table('products')
                                    ->where('id', '=', $id)
                                    ->first();

        return response()->json(['product' => $product]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $basket = Basket::where('user_id', '=', $request->user_id)
                                ->whereNotIn('baskets.id', Order::all()->pluck('basket_id'))
                                ->first();

            if($basket)
            {
                $basketItem = BasketItem::where('basket_id', '=', $basket->id)
                                        ->where('product_id', '=', $request->product_id)
                                        ->first();

                if($basketItem)
                {
                    $basketItem->quantity = $basketItem->quantity + $request->quantity;
                    $basketItem->save();
                    return response()->json(['basket' => $basketItem, 'updated' => 1]);
                } 
                else 
                {
                    $newBasketItem = new BasketItem;
                    $newBasketItem->basket_id = $basket->id;
                    $newBasketItem->product_id = $request->product_id;
                    $newBasketItem->quantity = $request->quantity;
                    $newBasketItem->save();
                    return response()->json(['basket' => $newBasketItem, 'updated' => 0]);
                }
            }
            else
            {
                // if user hasn't created basket yet
                $newBasket = new Basket;
                $newBasket->user_id = $request->user_id;
                $newBasket->save();

                $newBasketItem = new BasketItem;
                $newBasketItem->basket_id = $newBasket->id;
                $newBasketItem->product_id = $request->product_id;
                $newBasketItem->quantity = $request->quantity;
                $newBasketItem->save();

                return response()->json(['basket' => $newBasketItem, 'updated' => 0]);
            }
        }
        catch(\Exception $ex)
        {
            return 'kkkkkkkkk';
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $basketItem = BasketItem::findOrFail($id);
            $basketItem->quantity = $request->quantity;
            $basketItem->save();
            return $basketItem;
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => $ex]);
        }
    }

    public function delete($id)
    {
        try
        {
            $basketItem = BasketItem::findOrFail($id);
            $basketItem->delete();
            return $basketItem;
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'error occurred while deleting basket item, maybe it\'s actually deleted xD'], 400);
        }
    }
}
