<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\StaffRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use Illuminate\Support\Facades\Auth;
use DB;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staf = Staf_master::where('role_id',1);

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
      
//        $designers = $staf->orderBy('created_at', 'DESC')->withTrashed()->paginate(config("motorTraders.paginate.perPage"));
        $designers = $staf->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));

      
      
      /*$designers = Staf_master::where('role_id',1)->orderBy('created_at', 'DESC')->withTrashed()->paginate(
            config("motorTraders.paginate.perPage")
        );*/

        return view("designer.index", compact("designers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $roles = Role_master::get();
        return view("designer.create",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $user = Staf_master::create($request->all());
        
       
        return redirect()
            ->route("designers.index")
            ->with("success", "Designers created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($designer)
    {
        $designer = Staf_master::with('roleDetial')->withTrashed()->findOrFail($designer);
        $address = Staf_address::where('staf_id',$designer->id)->first();
        return view("designer.show", compact("designer","address"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staf_master $designer)
    { 
       
        return view("designer.edit", compact("designer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Staf_master $designer)
    {
        $designer->update($request->all());
        
        $result = Staf_address::where('staf_id', $designer->id)->update(array(
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
            ->route("designers.index")
            ->with("warning", "Designers updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staf_master $designer)
    {
        $designer->delete(); 
        return redirect()
            ->route("designers.index")
            ->with("danger", "Designers deleted successfully");
    }
}
