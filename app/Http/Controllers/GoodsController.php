<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Goods;
use App\Models\Basket;

class GoodsController extends Controller
{
    public function add_review(Request $req){
        $rev = new Review;

        $rev->sender = $req->name;
        $rev->id = $req->id;
        $rev->text = $req->text;
        $rev->save();

        return back();
    }

    public function add_to_busket(Request $request){
        $basket = new Basket;

        $basket->user_id = $request->user;
        $basket->goods_id = $request->goods;

        $basket->save();

        return back();
    }

    public function delete_from_basket(Request $request){
        $good = Basket::where('goods_id', $request->id)->first();
        $good->delete();
        return back();
    }

    public function add_goods(Request $request){
        $good = new Goods;

        $good->name = $request->name;
        $good->price = $request->price;
        $imgName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img'), $imgName);
        $good->img = 'img/'.$imgName;

        $good->save();

        return redirect()->back()->withSuccess('Goods has been added successfully');
    }

    public function delete_goods(Request $request){
        $good = Goods::where('id', $request->id)->first();
        $reviews = Review::where('id', $request->id)->get();
        $baskets = Basket::where('goods_id', $request->id)->get();

        if($baskets != null){
            foreach($baskets as $basket){
                $basket->delete();
            }
        }

        if($reviews != null){
            foreach($reviews as $review){
                $review->delete();
            }
        }

        $good->delete();

        return back();
    }
}
