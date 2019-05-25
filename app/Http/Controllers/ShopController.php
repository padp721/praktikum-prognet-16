<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Cart;
use Carbon\Carbon;
use App\Courier;
use App\Transaction;
use App\Transaction_Details;
use App\RajaOngkir;
use App\Product_Review;

class ShopController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function cartcount($id){
        $cart = Cart::where('user_id',$id)->where('status','notyet')->get();
        $cartcount = $cart->count();
        return $cartcount;
    }

    public function rajaongkir(){
        $rajaongkir = new RajaOngkir();
        return $rajaongkir;
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartcount = $this->cartcount($user->id);
            
            
            // echo $user;
            return view('shop/home', compact('user','cartcount'));
        }
        return view('shop/home');
    }
    
    public function product_list()
    {
        $products = Product::get();
        if (Auth::check()) {
            $user = Auth::user();
            $cartcount = $this->cartcount($user->id);
            
            
            return view('shop/product_list', compact('products','user','cartcount'));
        }
        return view('shop/product_list', compact('products'));
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        
        if (Auth::check()) {
            $user = Auth::user();
            $cartcount = $this->cartcount($user->id);
            
            
            return view('shop/product_detail', compact('product','user','cartcount'));
        }
        return view('shop/product_detail', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($request->has('addcart')) {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $id;
                $cart->qty = $request->qty;
                $cart->status = 'notyet';
                $cart->save();

                return back()->with('alert-add-cart', 'Berhasil menambahkan ke keranjang!');
            }
            else {
                //buy now
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $id;
                $cart->qty = $request->qty;
                $cart->status = 'direct';
                $cart->save();

                return redirect(route('user.view_checkout'))->with('method','direct');
            }
            
        }
        return redirect(route('login'));
    }

    public function view_cart(){
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id',$user->id)->where('status','notyet')->get();
            $cartcount = $cart->count();

            return view('shop/cart', compact('cart','user','cartcount'));
        }
        return redirect(route('index'));
    }

    public function delete_cart($id){
        $cart = Cart::find($id);
        $cart->status = 'cancelled';
        $cart->save();

        return back();
    }

    public function checkout(Request $request){
        if (Auth::check()) {
            $i = 0;
            $user = Auth::user();
            $cart = Cart::where('user_id',$user->id)->where('status','notyet')->get();

            foreach ($cart as $cart_item) {
                $cart_item->qty = $request->get('qty_'.$i);
                $cart_item->save();
                $i++;
            }
            return redirect(route('user.view_checkout'))->with('method','cart');
            
        }
        return redirect(route('index'));
    }

    public function view_checkout(){
        if (Auth::check()) {
            $user = Auth::user();
            $cartcount = $this->cartcount($user->id);
            $couriers = Courier::get();
            $province = $this->rajaongkir()->getprovince();
            $city = $this->rajaongkir()->getcity();
            

            return view('shop/checkout', compact('user','cartcount','couriers','province','city'));
        }
        return redirect(route('index'));
    }

    public function bayar(Request $request){
        if (Auth::check()) {
            $user = Auth::user();

            //cek metode pembelian
            if ($request->method == 'direct') {
                $carts = Cart::where('user_id',$user->id)->where('status','direct')->get();
            }
            elseif ($request->method == 'cart') {
                $carts = Cart::where('user_id',$user->id)->where('status','notyet')->get();
            }

            $timeout = Carbon::now()->addDays()->setTimezone('Asia/Singapore')->toDateTimeString();
            $kurir = Courier::find($request->courier_id);
            $shipping_cost = $this->rajaongkir()->checkshipping($request->regency,strtolower($kurir->courier));

            $transaction = new Transaction();
            $transaction->date = Carbon::now()->setTimezone('Asia/Singapore')->toDateString();
            $transaction->timeout = $timeout;
            $transaction->address = $request->address;
            $transaction->regency = $request->regency;
            $transaction->province = $request->province;
            $transaction->total = 0;
            $transaction->shipping_cost = $shipping_cost;
            $transaction->sub_total = 0;
            $transaction->user_id = $user->id;
            $transaction->courier_id = $request->courier_id;
            $transaction->status = 'unverified';
            $transaction->save();

            foreach ($carts as $item) {
                $full_price = $item->product->price*$item->qty;
                $discount = $full_price*$item->product->discount/100;
                $final_price = $full_price-$discount;
                $transaction->products()->attach([$item->product_id  => ['qty'=>$item->qty, 'discount'=>$item->product->discount, 'selling_price'=>$final_price]]);
                $item->status = 'checkedout';
                $item->save();
            }

            $transaction = Transaction::where('user_id',$user->id)->orderBy('id','desc')->first();
            $total = Transaction_Details::where('transaction_id',$transaction->id)->sum('selling_price');
            $sub_total = $total+$shipping_cost;
            $transaction->total = $total;
            $transaction->sub_total = $sub_total;
            $transaction->save();

        }
        return redirect(route('index'));
    }

    public function transactions(){
        if(Auth::check()){
            $user = Auth::user();
            $transactions = Transaction::where('user_id',$user->id)->get();
            $cartcount = $this->cartcount($user->id);
            return view('shop/transactions', compact('user','transactions','cartcount'));
        }
        return redirect(route('index'));
    }

    public function transaction_detail($id){
        if(Auth::check()){
            $user = Auth::user();
            $transaction = Transaction::find($id);
            $cartcount = $this->cartcount($user->id);
            $city = $this->rajaongkir()->getcity();
            $province = $this->rajaongkir()->getprovince();
            
            return view('shop/transaction_detail', compact('user','transaction','cartcount','city','province'));
        }
        return redirect(route('index'));
    }

    public function upload_pop(Request $request, $id){

        $this->validate($request,[
            'proof_of_payment' => 'required|max:2048'
        ]);

        $transaction = Transaction::find($id);

        $folderName = 'proof_of_payments';
        $fileName = $id.'_';
        $fileExtension = $request->proof_of_payment->getClientOriginalExtension();
        $fileNameToStorage = $fileName.'_'.time().'.'.$fileExtension;
        $filePath = $request->proof_of_payment->storeAs('public/'.$folderName , $fileNameToStorage);

        $transaction->proof_of_payment = $fileNameToStorage;
        $transaction->save();

        return back();
    }

    public function recieve($id){
        $transaction = Transaction::find($id);
        $transaction->status = 'success';
        $transaction->save();
        return back();
    }

    public function cancel($id){
        $transaction = Transaction::find($id);
        $transaction->status = 'canceled';
        $transaction->save();
        return back();
    }
}
