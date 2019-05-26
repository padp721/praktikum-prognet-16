<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use DB;
use DateTime;
use App\Charts\ReportChart;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function monthly(Request $request)
    {
        $user = Auth::user();
        $chart = new ReportChart;
        $dataset = collect([]);

        $data = Transaction::
        groupBy(DB::raw('MONTH(date)'))
        ->whereYear('date',$request->tahun)
        ->selectRaw('SUM(sub_total) AS income, MONTH(date) AS bulan,YEAR(date) AS tahun, SUM(shipping_cost) AS shipping_cost, SUM(total) AS clean_income')
        ->get();
        ;

        for ($month = 1; $month <= 12; $month++){
            $get_each_month = Transaction::whereYear('date', $request->tahun)->whereMonth('date', $month)->selectRaw('SUM(sub_total) AS income')->first();
            $dataset->push($get_each_month->income);
        }
        // return $dataset;

        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des']);
        $chart->dataset('Monthly Transaction', 'line', $dataset);

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

    public function yearly(Request $request){
        
        $user = Auth::user();
        $chart = new ReportChart;
        $labels = collect([]);
        $dataset = collect([]);

        $data = Transaction::
        groupBy(DB::raw('YEAR(date)'))
        ->whereRaw('date BETWEEN ? AND ?', [$request->tahun1, $request->tahun2])
        ->selectRaw('SUM(sub_total) AS income, YEAR(date) AS tahun, SUM(shipping_cost) AS shipping_cost, SUM(total) AS clean_income')
        ->get();
        ;

        foreach ($data as $record) {
            $labels->push($record->tahun);
            $dataset->push($record->income);
        }

        $chart->labels($labels);
        $chart->dataset('Yearly Transaction', 'line', $dataset);

        return view('admin/Report/yearly', compact('data','user','chart'));

    }

    public function thisYear(){
        date_default_timezone_set("Asia/Singapore");
        $date = new DateTime('now');
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['tahun2' => $date->format("Y-m-d"), 'tahun1' => $date->modify('-9 years')->format("Y-m-d")]);
        return $this->yearly($request);
    }
}
