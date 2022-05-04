<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerMaster;
use App\Models\VendorMaster;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $customer_count =CustomerMaster::count();
        $vendor_count = VendorMaster::count();
        return view("home",compact('customer_count','vendor_count'));
    }
}
