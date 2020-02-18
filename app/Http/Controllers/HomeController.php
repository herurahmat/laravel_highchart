<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $this->get_line();
        return view('home');
    }

    public function get_pie()
    {
        // Chart Female & Male Count
        $output=[];
        $arr=['Male','Female'];
        foreach($arr as $gender)
        {
            $total_db=DB::table('mock_data')->where('gender',$gender)->count();
            $total=$total_db?(int)$total_db: (int) 0;
            $output[]=[
                'name'=>$gender, // Untuk Nama Series
                'y'=>$total  // Untuk nilai pie
            ];
        }
        return response()->json($output);
    }

    public function get_line()
    {
        $year=2019;

        // Chart Range Date by Month        
        $output = [];
        for($i=1;$i<=12;$i++)
        {
            $total_db = DB::table('mock_data')->whereMonth('date', $i)->whereYear('date',$year)->count();
            $total = $total_db ? (int) $total_db : (int) 0;
            $output[]=$total;
        }
        return response()->json($output);
    }
}