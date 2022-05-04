<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role_master;
use App\Http\Requests\Admin\RoleRequest;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role_master::paginate(config("motorTraders.paginate.perPage"));
        return view("role.index", compact("roles"));
    }

    public function create()
    {
        $editRole = "";
        return view("role.create", compact("editRole"));
    }

    public function store(RoleRequest $request, Role_master $role)
    {
        try {
            $role->create($request->validated());
            
            return redirect()
            ->route("role.index")
            ->with("success", "Role created successfully.");

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

    public function show(Role_master $role)
    {
        $editRole = $role->findOrFail($role->id);

        return view("role.show", compact("editRole"));
    }

    public function edit(Role_master $role)
    {
        $editRole = $role->findOrFail($role->id);
        
        return view("role.create", compact("editRole"));
    }

    public function update(RoleRequest $request, Role_master $role)
    {
        try {
            $role->findOrFail($role->id)->update($request->validated());
            
            return redirect()
            ->route("role.index")
            ->with("warning", "Role updated successfully.");

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

    public function destroy(Role_master $role)
    {
        $role->delete(); 
        return redirect()
        ->route("role.index")
        ->with("danger", "Role deleted successfully.");
    }
}
