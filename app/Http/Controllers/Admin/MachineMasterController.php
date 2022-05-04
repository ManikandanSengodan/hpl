<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineMasterRequest;
use App\Models\MachineMaster;
use Illuminate\Http\Request;
use DB;

class MachineMasterController extends Controller
{
    public function index()
    {
        $machines = MachineMaster::paginate(config("motorTraders.paginate.perPage"));
        return view("machine-master.index", compact("machines"));
    }

    public function create()
    {
        $editMachine = "";
        return view("machine-master.create", compact("editMachine"));
    }

    public function store(MachineMasterRequest $request)
    {
        try {
            MachineMaster::create($request->validated());
            
            return redirect()
            ->route("machine-master.index")
            ->with("success", "Machine Master created successfully.");

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

    public function show(MachineMaster $machine)
    {
        $machineMaster = MachineMaster::findOrFail($machine->id);

        return view("machine-master.show", compact("machineMaster"));
    }

    public function edit(MachineMaster $machine)
    {
        $editMachine = $machine->findOrFail($machine->id);

        return view("machine-master.create", compact("editMachine"));
    }

    public function update(MachineMasterRequest $request, MachineMaster $machine)
    {
        try {
            $machine->findOrFail($machine->id)->update($request->only('name', 'colour', 'operator_designated'));
            
            return redirect()
            ->route("machine-master.index")
            ->with("warning", "Machine Master updated successfully.");

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

    public function destroy(MachineMaster $machine)
    {
        $machine->delete();
        return redirect()
        ->route("machine-master.index")
        ->with("danger", "Machine Master deleted successfully.");
    }
}
