<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use DB;
use DateTime;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function monthly(Request $request){
        $user = Auth::user();
        $data = Transaction::
        groupBy(DB::raw('MONTH(date)'))
        ->whereYear('date',$request->tahun)
        ->selectRaw('SUM(sub_total) AS income, MONTH(date) AS bulan,YEAR(date) AS tahun, SUM(shipping_cost) AS shipping_cost, SUM(total) AS clean_income')
        ->get();
        ;
        $chart = Transaction::
        groupBy(DB::raw('MONTH(date)'))
        ->whereYear('date',$request->tahun)
        ->selectRaw('MONTH(date) AS bulan, SUM(sub_total) AS income')
        ->get();
        ;
        return view('admin/Report/monthly', compact('data','user','chart'));
    }

    public function thisMonth(){
        date_default_timezone_set("Asia/Singapore");
        $date = new DateTime();
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['tahun' => $date->format("Y")]);
        return $this->monthly($request);
    }

    public function yearly(){

    }

    public function thisYear(){

    }
}
