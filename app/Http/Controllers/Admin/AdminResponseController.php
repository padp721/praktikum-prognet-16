<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product_Review;
use App\Response;
use App\Notifications\AdminResponse;
use App\User;
use Validator;

class AdminResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user();
        $reviews = Product_Review::get();
        $check_admin = Response::where('admin_id', $user->id)->first();
        return view('admin/Product_Review/product_review', compact('user','reviews','check_admin'));
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
        $validator = Validator::make($request->all(), [
            'admin_id' => 'unique:response,admin_id'
        ]);

        if ($validator->fails()) {
            return back()->with('admin','Anda sudah pernah membalas review ini.');
        }


        $user = Auth::user();
        $response = new Response();
        $response->review_id = $request->review_id;
        $response->admin_id = $user->id;
        $response->content = $request->content;
        $response->save();

        $response = Response::where('review_id', $request->review_id)->first();
        
        $response->review->user->notify(new AdminResponse($response));

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->has('delrev')){
            $review = Product_Review::find($id);
            $review->delete();
            return back();
        }
        else if($request->has('delres')){
            $response = Response::find($id);
            $response->delete();
            return back();
        }
        else{
            return bakc();
        }
    }
}
