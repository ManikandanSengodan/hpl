<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MaterialMaster;
use App\Http\Requests\Admin\MaterialMasterRequest;
use DB;

class MaterialMasterController extends Controller
{
    public function index(Request $request)
    {
        $master = new MaterialMaster();
        $inks = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));

        return view("material-master.index", compact("inks"));
    }


    public function create()
    {   
        $editMaterial = "";
        return view("material-master.create",compact('editMaterial'));
    }
   
    public function store(MaterialMasterRequest $request)
    {

        $user = MaterialMaster::create($request->validated());

        return redirect()
        ->route("material-master.index")
        ->with("success", "Material master created successfully.");
    } 
    
    
    public function edit(MaterialMaster $ink)
    {
        $editMaterial = MaterialMaster::where('id',$ink->id)->first();
        return view("material-master.create",compact('editMaterial'));
    }


    public function update(MaterialMasterRequest $request, MaterialMaster $ink)
    {
        $ink->update($request->validated());

        return redirect()
        ->route("material-master.index")
        ->with("warning", "Material master updated successfully.");
    }
    
    public function show($ink)
    {
        $material = MaterialMaster::findOrFail($ink);
        return view("material-master.show", compact("material"));
    }


    public function destroy(MaterialMaster $ink)
    {
        $ink->delete(); 
        return redirect()
        ->route("material-master.index")
        ->with("danger", "Material master deleted successfully.");
    }
}
