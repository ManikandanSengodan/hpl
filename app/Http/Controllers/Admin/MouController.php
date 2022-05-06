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
use App\Models\CustomerMaster;    
use Barryvdh\DomPDF\Facade\Pdf;



use Illuminate\Support\Facades\Auth;
use DB;

class MouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view("mou.index", compact("mous"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $customers = CustomerMaster::get();
        return view("mou.create",compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MouRequest $request)
    {   $latestOrder = Mou::orderBy('created_at','DESC')->first();
        $moucode = '#MOU'.str_pad(isset($latestOrder->id) + 1, 6, "0", STR_PAD_LEFT);
        
       $request['mou_code'] = $moucode;
        
       // echo "<pre>"; print_r($request->all());exit;
        $mous = Mou::create($request->all());
        
       
        return redirect()
            ->route("mous.index")
            ->with("success", "Mou created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mou)
    {
        $mou = Mou::with('mouDetails')->withTrashed()->findOrFail($mou);
       //echo"<pre>";print_r($mou->mouDetails);exit;
        return view("mou.show", compact("mou"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mou $mou)
    { 
        $customers = CustomerMaster::get();
        return view("mou.edit", compact("mou","customers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MouRequest $request, Mou $mou)
    {
        $mou->update($request->all());
    
        return redirect()
            ->route("mous.index")
            ->with("warning", "mous updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staf_master $mou)
    {
        $mou->delete(); 
        return redirect()
            ->route("mous.index")
            ->with("danger", "mous deleted successfully");
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
        ->route("mous.index")
        ->with("success", "File Uploaded successfully");
   
    } 

    public function downloadPdf()
    {
        echo "Hello";exit;
        $data = [
            'title' => 'Welcome to tes.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('mou.pdf', $data);
        return $pdf->download('test.pdf');
    }
}
