<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InkMaster;
use App\Http\Requests\Admin\InkRequest;
use DB;

class InkController extends Controller
{
    public function index(Request $request)
    {
         $master = new InkMaster();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('ink_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $inks = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       
        
        return view("ink.index", compact("inks"));
    }


    public function create()
    {   
        $editink = "";
        return view("ink.create",compact('editink'));
    }
   
    public function store(InkRequest $request)
    {

        $user = InkMaster::create($request->validated());

        return redirect()
        ->route("ink.index")
        ->with("success", "Ink created successfully.");
    } 
    
    
    public function edit(InkMaster $ink)
    {
        $editink = InkMaster::where('id',$ink->id)->first();
        return view("ink.create",compact('editink'));
    }


    public function update(InkRequest $request, InkMaster $ink)
    {
        $ink->update($request->validated());

        return redirect()
        ->route("ink.index")
        ->with("warning", "Ink updated successfully.");
    }
    
    public function show($ink)
    {
        $ink = InkMaster::findOrFail($ink);
        return view("ink.show", compact("ink"));
    }


    public function destroy(InkMaster $ink)
    {
        $ink->delete(); 
        return redirect()
        ->route("ink.index")
        ->with("danger", "Ink deleted successfully.");
    }
}
