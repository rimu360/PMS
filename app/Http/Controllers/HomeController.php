<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        return view('test');
    }

    //--------------------------------Report--------------------------------------------------------
    public function report()
      {
          return view('report');
      }

      public function create_reports(Request $request)
    {
      $from = $request -> from;
      $to= $request -> to;
      $reports = Orders::whereBetween('created_at', [$from, $to])->get();
      return view('report',compact('reports'));

      //dd($report);
    }
}
