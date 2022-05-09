<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\YarnMaster;
use App\Http\Requests\Admin\YarnRequest;
use DB;

class YarnController extends Controller
{
    public function index(Request $request)
    {
         $master = new YarnMaster();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('yarn_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $yarns = $master->orderBy('created_at', 'DESC')
        ->paginate(config("motorTraders.paginate.perPage"));
       
        
        return view("yarns.index", compact("yarns"));
    }


    public function create()
    {   
        $editYarn = "";
        return view("yarns.create",compact('editYarn'));
    }
   
    public function store(YarnRequest $request)
    {

        $user = YarnMaster::create($request->validated());

        return redirect()
        ->route("yarns.index")
        ->with("success", "yarn created successfully.");
    } 
    
    
    public function edit(YarnMaster $yarn)
    {   
        $editYarn = YarnMaster::where('id',$yarn->id)->first();
        return view("yarns.create",compact('editYarn'));
    }


    public function update(YarnRequest $request, YarnMaster $yarn)
    {
        $yarn->update($request->validated());

        return redirect()
        ->route("yarns.index")
        ->with("warning", "yarn updated successfully.");
    }
    
    public function show($yarn)
    {
        $yarn = YarnMaster::findOrFail($yarn);
        return view("yarns.show", compact("yarn"));
    }


    public function destroy(YarnMaster $yarn)
    {
        $yarn->delete(); 
        return redirect()
        ->route("yarns.index")
        ->with("danger", "yarn deleted successfully.");
    }
}
