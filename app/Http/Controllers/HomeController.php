<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Orders::where([
            ['supplier_id' ,'=',Auth::user()->user_id],
            ['status', '=', 0 ]
        ])->latest()->get();



        return view('home')
            ->with([
                'orders' => $orders
            ]);
    }
}
