<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\RajaOngkir;

class AdminTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function rajaongkir(){
        $rajaongkir = new RajaOngkir();
        return $rajaongkir;
    }
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user();
        $transaction = Transaction::get();
        $city = $this->rajaongkir()->getcity();
        $province = $this->rajaongkir()->getprovince();
        return view('admin/Transaction/transaction', compact('user','transaction','city','province'));
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
    public function edit($id)
    {
        $user = Auth::user();
        $transaction = Transaction::find($id);
        $city = $this->rajaongkir()->getcity();
        $province = $this->rajaongkir()->getprovince();
        return view('admin/Transaction/transaction_edit', compact('user','transaction','city','province'));
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
        $transaction = Transaction::find($id);

        if($request->has('verify')){
            $transaction->status = 'verified';
            $transaction->save();
        }
        else if($request->has('deliver')){
            $transaction->status = 'delivered';
            $transaction->save();
        }
        else if($request->has('cancel')){
            $transaction->status = 'canceled';
            $transaction->save();
        }
        else{
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
        //
    }
}
