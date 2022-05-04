<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LoomMaster;
use App\Http\Requests\Admin\LoomRequest;
use DB;

class LoomController extends Controller
{
     public function index(Request $request)
    {
         $master = new LoomMaster();
//
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('loom_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $looms = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       
        return view("looms.index", compact("looms"));
    }


    public function create()
    {   
        return view("looms.create");
    }
   
    public function store(LoomRequest $request)
    {

        $user = LoomMaster::create($request->all());

        return redirect()
        ->route("looms.index")
        ->with("success", "loom created successfully.");
    } 
    
    
    public function edit(LoomMaster $loom)
    {   
        
        $colour = LoomMaster::where('id',$loom->id)->first();
        return view("looms.edit", compact("loom"));
    }


    public function update(LoomRequest $request, LoomMaster $loom)
    {
        $loom->update($request->all());

        return redirect()
        ->route("looms.index")
        ->with("warning", "loom updated successfully.");
    }
    
    public function show($loom)
    {
        $loom = LoomMaster::findOrFail($loom);
        return view("looms.show", compact("loom"));
    }


    public function destroy(LoomMaster $loom)
    {
        $loom->delete(); 
        return redirect()
        ->route("looms.index")
        ->with("danger", "loom deleted successfully.");
    }
}
