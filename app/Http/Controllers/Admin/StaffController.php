<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\Admin\StaffRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

class StaffController extends Controller
{
    
     public function index($role,Request $request)
    {
        $staf = Staf_master::where('role_id',$role);
        $role = Role_master::where('id',$role)->first();

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
         $staffs = $staf->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       $designers = $staffs;


      
      
      /*$designers = Staf_master::where('role_id',1)->orderBy('created_at', 'DESC')->withTrashed()->paginate(
            config("motorTraders.paginate.perPage")
        );*/

        return view("staff.index", compact("staffs","role","designers"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $editStaff = "";
        $roles     = Role_master::get();
        return view("staff.create",compact("roles","editStaff"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {   

        try {
            $validatedFields                       = $request->validated(); 
            $validatedFields['password']           = Hash::make($request->password);
            $staff                                  = Staf_master::create($validatedFields);

            if ($request->hasFile("document_name")) {
                $file = $request->file("document_name");
               
                // if(Storage::disk('staffs_document')->makeDirectory("{$user->id}", 0777, true))
                if(!File::exists('staffs_document'))
                {
                    File::makeDirectory("staffs_document", 0755, true);
                }
                
                $filePath = $file->store("{$staff->id}", [
                    "disk" => "staffs",
                ]);
            }

            if (isset($filePath)) {
                $staff->update([
                    "document_name" => $filePath,
                ]);
            }

            if ($staff->role_id && $staff->roleDetial) {
                $message = $staff->roleDetial->name . " created successfully.";

                return redirect('stafflist/'.$staff->role_id)
                    ->with("success", $message);
            }

//            switch($request->role_id) {
//                case 1:
//                    return redirect()
//                ->route("designers.index")
//                ->with("success", "Designers created successfully.");
//                break;
//                case 2:
//                    return redirect()
//                ->route("salesreps.index")
//                ->with("success", "Sales Reps created successfully.");
//                break;
//                case 3:
//                    return redirect()
//                ->route("printers.index")
//                ->with("success", "Printers created successfully.");
//                break;
//                case 4:
//                    return redirect()
//                ->route("finishers.index")
//                ->with("success", "Finishers created successfully.");
//                break;
//                case 5:
//                    return redirect()
//                ->route("loomoperators.index")
//                ->with("success", "Loom Operators created successfully.");
//                break;
//                case 6:
//                    return redirect()
//                ->route("finishingoperators.index")
//                ->with("success", "Finishing Operators created successfully.");
//                break;
//                case 7:
//                    return redirect()
//                ->route("qualitycheckers.index")
//                ->with("success", "Qualitycheckers created successfully.");
//                break;
//            }


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong" . $exception->getMessage()
                );
        }
               
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staf_master $staff)
    { 
        $editStaff = $staff;
        $roles = Role_master::get();
        return view("staff.create", compact("editStaff","roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Staf_master $staff)
    {
       
        try {
            $validatedFields                       = $request->validated(); 
            if($request->password != "" && $request->password != null)
            {
                $validatedFields['password']       = Hash::make($request->password);
            }
            else
            {
                unset($validatedFields['password']);
            }
            
            $staff->update($validatedFields);

            if ($request->hasFile("document_name")) {
                $file = $request->file("document_name");
                // if(Storage::disk('staffs_document')->makeDirectory("{$staff->id}", 0755, true))
                if(!File::exists('staffs_document'))
                {
                    File::makeDirectory("staffs_document", 0755, true);
                }
            
                $filePath = $file->store("{$staff->id}", [
                    "disk" => "staffs",
                ]);
            }

            if (isset($filePath)) {
                $staff->update([
                    "document_name" => $filePath,
                ]);
            }

            if ($staff->role_id && $staff->roleDetial) {
                $message = $staff->roleDetial->name . " updated successfully.";

                return redirect('stafflist/'.$staff->role_id)
                    ->with("warning", $message);
            }

//            switch($request->role_id) {
//                case 1:
//                    return redirect()
//                ->route("designers.index")
//                ->with("success", "Designers created successfully.");
//                break;
//                case 2:
//                    return redirect()
//                ->route("salesreps.index")
//                ->with("success", "Sales Reps created successfully.");
//                break;
//                case 3:
//                    return redirect()
//                ->route("printers.index")
//                ->with("success", "Printers created successfully.");
//                break;
//                case 4:
//                    return redirect()
//                ->route("finishers.index")
//                ->with("success", "Finishers created successfully.");
//                break;
//                case 5:
//                    return redirect()
//                ->route("loomoperators.index")
//                ->with("success", "Loom Operators created successfully.");
//                break;
//                case 6:
//                    return redirect()
//                ->route("finishingoperators.index")
//                ->with("success", "Finishing Operators created successfully.");
//                break;
//                case 7:
//                    return redirect()
//                ->route("qualitycheckers.index")
//                ->with("success", "Qualitycheckers created successfully.");
//                break;
//            }


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong" . $exception->getMessage()
                );
        }
       
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($staff)
    {
        $staff = Staf_master::withTrashed()->findOrFail($staff);
       
        return view("staff.show", compact("staff"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staf_master $Staff)
    {
        $Staff->delete();
        $message = "Staff deleted successfully";
        if ($Staff->roleDetial) {
            $message = $Staff->roleDetial->name . " deleted successfully.";
        }
        return redirect('stafflist/'.$Staff->role_id)
            ->with("danger", $message);
    }
}
