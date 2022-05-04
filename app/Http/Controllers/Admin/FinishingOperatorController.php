<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\FinishingOperatorRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use Illuminate\Support\Facades\Auth;

class FinishingOperatorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finishingoperators = Staf_master::where('role_id',6)->orderBy('id', 'DESC')->withTrashed()->paginate(
            config("motorTraders.paginate.perPage")
        );

        return view("finishingoperator.index", compact("finishingoperators"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $roles = Role_master::get();
        return view("finishingoperator.create",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinishingOperatorRequest $request)
    {
        $user = Staf_master::create($request->all());
        $result = Staf_address::Insert(array(
            'staf_id' => $user->id,
            'fullname' => $request->name,
            'flatno' => $request->flatno,
            'apartment' => $request->apartment,
            'landmark' => $request->landmark,
            'area' => $request->area,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zipcode' => $request->zipcode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
       
        return redirect()
            ->route("finishingoperators.index")
            ->with("success", "finishingoperators created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($finishingoperator)
    {
        $finishingoperator = Staf_master::with('roleDetial')->withTrashed()->findOrFail($finishingoperator);
        $address = Staf_address::where('staf_id',$finishingoperator->id)->first();
        return view("finishingoperator.show", compact("finishingoperator","address"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staf_master $finishingoperator)
    { 
        $address = Staf_address::where('staf_id',$finishingoperator->id)->first();
        return view("finishingoperator.edit", compact("finishingoperator","address"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FinishingOperatorRequest $request, Staf_master $finishingoperator)
    {
        $finishingoperator->update($request->all());
        
        $result = Staf_address::where('staf_id', $finishingoperator->id)->update(array(
            'fullname' => $request->name,
            'flatno' => $request->flatno,
            'apartment' => $request->apartment,
            'landmark' => $request->landmark,
            'area' => $request->area,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zipcode' => $request->zipcode,
            'updated_at' => date('Y-m-d H:i:s')
        ));
        return redirect()
            ->route("finishingoperators.index")
            ->with("warning", "finishingoperators updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staf_master $finishingoperator)
    {
        $finishingoperator->delete(); 
        return redirect()
            ->route("finishingoperators.index")
            ->with("danger", "finishingoperators deleted successfully");
    }
}
