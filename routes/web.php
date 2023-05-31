<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Goods;
use App\Models\Review;
use App\Models\Basket;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $data = Goods::orderBy('id', 'desc')->paginate(12);
    return view('welcome', ['goods' => $data]);
});

Route::get('/home', function () {
    $data = Goods::orderBy('id', 'desc')->paginate(12);
    return view('welcome', ['goods' => $data]);
})->middleware(['auth', 'verified']);

Route::get('/basket', function(){
    $ids = Basket::where('user_id', Auth::user()->id)->get();
    $goods = [];

    foreach($ids as $id){
        $goods[] = Goods::where('id', $id->goods_id)->first();
    }

    $total = 0;

    foreach($goods as $good){
        $total += $good->price;
    }

    return view('basket', ['goods' => $goods, 'price' => $total]);
})->middleware(['auth', 'verified']);

Route::get('/home/goods/{id}', function($id){
    $goods = Goods::where('id', $id)->first();
    $reviews = Review::where('id', $goods->id)->get()->reverse();
    $name = "";
    $in_basket = null;
    if(Auth::check()){
        $name = Auth::user()->name;
        $in_basket = Basket::where('user_id', Auth::user()->id)->where('goods_id', $id)->first();
    }

    $imgs = explode(' ', $goods->img);

    return view('goods', ['goods' => $goods, 'name' => $name, 'reviews' => $reviews, 'basket' => $in_basket, 'imgs' => $imgs]);
});

Route::group(['middleware' => ['role:admin']], function(){
    Route::get('/admin', function(){
        return view('admin');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
