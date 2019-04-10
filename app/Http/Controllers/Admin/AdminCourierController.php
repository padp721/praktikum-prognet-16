<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Courier;
use App\Transaction;

class AdminCourierController extends Controller
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
        $data_courier = Courier::get();
        return view('admin/Courier/courier', ['user'=>$user , 'data_courier'=>$data_courier]);
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
        $check = Courier::where('courier',$request->courier)->first();
        if ($check){
            return back()->with('fail','Courier already exist!');
        }
        else{
            Courier::create($request->all());
            return back()->with('success','Data has been submitted!');
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
    public function update(Request $request)
    {
        $check = Courier::where('courier',$request->courier)->first();
        if ($check){
            return back()->with('fail','Courier already exist!');
        }
        else{
            $courier = Courier::findOrFail($request->idcourier);
            $courier->update($request->all());
            return back()->with('success','Data has been edited!');
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
        $check = Transaction::where('courier_id',$request->idcourier)->first();
        if ($check){
            return back()->with('fail','Courier is being used in transaction!');
        }
        else{
            $courier = Courier::findOrFail($request->idcourier);
            $courier->delete();
            return back()->with('success','Data has been deleted!');
        }
    }
}
