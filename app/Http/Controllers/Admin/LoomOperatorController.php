<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\LoomOperatorRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use Illuminate\Support\Facades\Auth;
use DB;

class LoomOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staf = Staf_master::where('role_id',5);
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('staf_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//         $staf ->where(function ($query) use ($columnsToSearch,$searchQuery) {
//            foreach($columnsToSearch as $column) {
//                      $query = $query->orWhere($column, 'LIKE', $searchQuery);
//                  }
//			});
//
//        }
      
        $loomoperators = $staf->orderBy('created_at', 'DESC')->withTrashed()->paginate(config("motorTraders.paginate.perPage"));
      
         /*$loomoperators = Staf_master::where('role_id',5)->orderBy('id', 'DESC')->withTrashed()->paginate(
            config("motorTraders.paginate.perPage")
        );*/

        return view("loomoperator.index", compact("loomoperators"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $roles = Role_master::get();
        return view("loomoperator.create",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoomOperatorRequest $request)
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
            ->route("loomoperators.index")
            ->with("success", "loomoperators created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($loomoperator)
    {
        $loomoperator = Staf_master::with('roleDetial')->withTrashed()->findOrFail($loomoperator);
        $address = Staf_address::where('staf_id',$loomoperator->id)->first();
        return view("loomoperator.show", compact("loomoperator","address"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staf_master $loomoperator)
    { 
        $address = Staf_address::where('staf_id',$loomoperator->id)->first();
        return view("loomoperator.edit", compact("loomoperator","address"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LoomOperatorRequest $request, Staf_master $loomoperator)
    {
        $loomoperator->update($request->all());
        
        $result = Staf_address::where('staf_id', $loomoperator->id)->update(array(
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
            ->route("loomoperators.index")
            ->with("warning", "loomoperators updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staf_master $loomoperator)
    {
        $loomoperator->delete(); 
        return redirect()
            ->route("loomoperators.index")
            ->with("danger", "loomoperators deleted successfully");
    }
}
