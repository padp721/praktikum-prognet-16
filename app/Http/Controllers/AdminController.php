<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin_Notification;
use App\Product;
use App\Review;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = Auth::user();
        // echo $user;
        return view('admin/dashboard', ['user'=>$user]);
    }

    public function read_notification($id){
        
        $notification = Admin_Notification::find($id);
        
        switch ($notification->type) {
            case 'App\Notifications\UserReview':
                $notification->markAsRead();
                return redirect(route('admin.response'));
                break;
            case 'App\Notifications\UserCheckout' || 'App\Notifications\UserUploadProof' || 'App\Notifications\UserRecieve' || 'App\Notifications\CancelPurchase':
                $notification->markAsRead();
                return redirect(route('transaction.edit',$notification->data['transaction_id']));
                break;
            default:
                return back();
                break;
        }
    }
}
