<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\MouRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use App\Models\Mou;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\Incentive;
use App\Models\CustomerMaster;

use Illuminate\Support\Facades\Auth;
use DB;

class MouCustomerController extends Controller
{
    public function index(Request $request)
    {
        $mou = Mou::where('status',1);
        if(Auth()->User()->role_id == 2){
            $email = Auth()->User()->email;
            $buyer = CustomerMaster::where('email', $email)->first();
            $customer_id = $buyer->id;  
            $mous = $mou->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
        }else{
            $mous = $mou->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
        }


        $mous = $mou->with('mouDetails')->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       // echo "<pre>"; print_r($mous);exit;
        return view("mou-customer.index", compact("mous"));
    }

    public function show($mou)
    {
        $mou = Mou::with('mouDetails')->withTrashed()->findOrFail($mou);
      // echo"<pre>";print_r($mou);exit;
        return view("mou-customer.show", compact("mou"));
    }

   
    public function upload(Request $request, Mou $mou)
    {
        // dd($mou);  
        $request->validate([
            'mou_upload' => 'required|mimes:pdf|max:2048',
        ]);
        $name = time().'.'.$request->file('mou_upload')->getClientOriginalName();
        $path = $request->file('mou_upload')->move(public_path('mous'), $name);

        $mou->update([
            'id' => $mou,
            'file_path' => $name,
        ]); 

        return redirect()
        ->route("customermou.index")
        ->with("success", "File Uploaded successfully");
    }
   
    public function downloadPdf(Request $request, Mou $mou)
    {
        $customer = CustomerMaster::find($mou['customer_id']);
        $pdf = PDF::loadView('mou-customer.pdf', ['mou' => $mou, 'customer' => $customer]);
        return $pdf->download('sample.pdf');
    }

   
}
