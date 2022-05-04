<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SellerRequest;
use Illuminate\Http\Request;
use App\Models\VendorMaster;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;


class SellerController extends Controller
{
    public function index()
    {
        $sellers = VendorMaster::orderBy('created_at', 'DESC')
        ->paginate(config("motorTraders.paginate.perPage"));
        return view("sellers.index", compact("sellers"));
    }

    public function create()
    {
        $editVendor="";
        $data['categoryMaster'] = Category::get()->toArray();
        return view("sellers.create",compact('editVendor','data'));

    }

    public function store(SellerRequest $request)
    {
        if($request->same_as){ 
            $shipping = $request->billing_address;
        }else{
            $shipping = $request->shipping_address;
        }

        $data               = $request->validated(); 
        $data['password']   = Hash::make($request->password);
        VendorMaster::create($data);
       
        return redirect()
            ->route("sellers.index")
            ->with("success", "Seller created successfully.");
    }

    public function edit(VendorMaster $seller)
    {   
        $editVendor= $seller;
        $data['categoryMaster'] = Category::get()->toArray();
        return view("sellers.create",compact('editVendor','data'));
    }

    public function update(SellerRequest $request, VendorMaster $seller)
    {
        if($request->same_as){
            $shipping = $request->billing_address;
        }else{
            $shipping = $request->shipping_address;
        }

        $data               = $request->validated(); 

        if($request->password != "" && $request->password != null)
        {
            $data['password'] = Hash::make($request->password);
        }
        else
        {
            unset($data['password']);
        }

       VendorMaster::where('id', $seller->id)->update($data);
       
        return redirect()
            ->route("sellers.index")
            ->with("warning", "Seller updated successfully");
    }

    public function show($seller)
    {
        $seller = VendorMaster::with('categoryMasterDetail')->findOrFail(
            $seller
        );
        //dd($seller);
       
        return view("sellers.show", compact("seller"));
    }

    public function destroy(VendorMaster $seller)
    {
        $seller->delete();
        return redirect()
            ->route("sellers.index")
            ->with("danger", "Seller deleted successfully");
    }
}
