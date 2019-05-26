<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product_Review;
use App\Product;
use App\Notifications\UserReview;
use App\Admin;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){

            $user = Auth::user();
            $review = new Product_Review();
            $review->product_id = $request->product_id;
            $review->user_id = $user->id;
            $review->rate = $request->rate;
            $review->content = $request->content;
            $review->save();

            $average = Product_Review::where('product_id',$request->product_id)->avg('rate');
            $avg = Product::find($request->product_id);
            $avg->product_rate = $average;
            $avg->save();

            $review = Product_Review::where('product_id',$request->product_id)
                                        ->where('user_id', $user->id)
                                        ->orderby('id', 'desc')
                                        ->first();

            $admins = Admin::get();
            foreach ($admins as $admin) {
                $admin->notify(new UserReview($review));
            }

            return back();
        }
        return back();
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
        if(Auth::check()){
            $review = Product_Review::find($id);
            $product_id = $review->product_id;

            $review->rate = $request->rate;
            $review->content = $request->content;
            $review->save();

            $average = Product_Review::where('product_id',$product_id)->avg('rate');
            $avg = Product::find($product_id);
            $avg->product_rate = $average;
            $avg->save();

            return back();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $review = Product_Review::find($id);
            $product_id = $review->product_id;

            $review->delete();

            $average = Product_Review::where('product_id',$product_id)->avg('rate');
            $avg = Product::find($product_id);
            $avg->product_rate = $average;
            $avg->save();

            return back();
        }
        return back();
    }
}
