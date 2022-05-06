<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BuyerRequest;
use App\Models\CustomerMaster;
use App\Models\CustomerShippingAddress;
use App\Models\CustomerBillingAddress;
use App\Models\Staf_master;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use DB;



class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $buyers = CustomerMaster::with('salesRep', 'categoryMasterDetail')->orderBy('created_at', 'DESC')->paginate(20);

        return view("buyers.index", compact("buyers"));
    }

    public function create()
    {   
        $editCustomer = "";  
        $data['salesrep']         = Staf_master::where('role_id',2)->orderBy('created_at', 'DESC')->get()->toArray();
        $data['categoryMaster']   = Category::get()->toArray();
        return view("buyers.create",compact('data','editCustomer'));
    }

    public function store(BuyerRequest $request)
    {
        // if($request->same_as){
        //     $shipping = $request->billing_address;
        // }else{
        //     $shipping = $request->shipping_address;
        // }

        $data                       = $request->validated();
        $data['password']           = Hash::make($request->password);
        
        $user = User::create([
            'name' => $request->full_name,
            'password' => $request->password,
            'email' => $request->email,
            'phone' => $request->mobile_number,
            'status' => $request->status,
            'role_id' => 2,
        ]);
        CustomerMaster::create($data);

        return redirect()
            ->route("customer.index")
            ->with("success", "Customer created successfully.");
    }

    public function edit(CustomerMaster $buyer)
    {
        $editCustomer = $buyer;  
        $data['salesrep'] = Staf_master::where('role_id',2)->orderBy('created_at', 'DESC')->get()->toArray();
        $data['categoryMaster']   = Category::get()->toArray();
        return view("buyers.create", compact("editCustomer","data"));
    }

    public function update(BuyerRequest $request, CustomerMaster $buyer)
    {
        //dd($request->all());
        // if($request->same_as){
        //     $shipping = $request->billing_address;
        // }else{
        //     $shipping = $request->shipping_address;
        // }

        $data                    = $request->validated(); 

        if($request->password != "" && $request->password != null)
        {
            $data['password'] = Hash::make($request->password);
        }
        else
        {
            unset($data['password']);
        }
        
        CustomerMaster::where('id', $buyer->id)->update($data);

        return redirect()
            ->route("customer.index")
            ->with("warning", "Customers updated successfully");
    }

    public function show($buyer)
    {
        $buyer = CustomerMaster::with('categoryMasterDetail')->findOrFail($buyer);
        $salesrep = Staf_master::where('id',$buyer->sales_rep)->first();
        return view("buyers.show", compact("buyer","salesrep"));
    }

    public function destroy(CustomerMaster $buyer)
    {
        $buyer->delete();
        return redirect()
            ->route("customer.index")
            ->with("danger", "Customers deleted successfully");
    }

    public function viewprofile()
    {
        $email = Auth()->User()->email;
        $buyer = CustomerMaster::where('email', $email)->first();
        return view("buyers.show", compact("buyer"));
    }
}
