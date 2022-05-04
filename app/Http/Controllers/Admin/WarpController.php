<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WarpMaster;
use App\Http\Requests\Admin\WarpRequest;
use DB;


class WarpController extends Controller
{
    
     public function index(Request $request)
    {
         $master = new WarpMaster();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('warp_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $warps = $master->orderBy('created_at', 'DESC')
        ->paginate(config("motorTraders.paginate.perPage"));
       
        return view("warps.index", compact("warps"));
    }


    public function create()
    {   
        return view("warps.create");
    }
   
    public function store(WarpRequest $request)
    {

        $user = WarpMaster::create($request->all());

        return redirect()
        ->route("warps.index")
        ->with("success", "Colour created successfully.");
    } 
    
    
    public function edit(WarpMaster $warp)
    {   
        
        $colour = WarpMaster::where('id',$warp->id)->first();
        return view("warps.edit", compact("warp"));
    }


    public function update(WarpRequest $request, WarpMaster $warp)
    {
        $warp->update($request->all());

        return redirect()
        ->route("warps.index")
        ->with("warning", "Colour updated successfully.");
    }
    
    public function show($warp)
    {
        $warp = WarpMaster::findOrFail($warp);
        return view("warps.show", compact("warp"));
    }


    public function destroy(WarpMaster $warp)
    {
        $warp->delete(); 
        return redirect()
        ->route("warps.index")
        ->with("danger", "Colour deleted successfully.");
    }

}
