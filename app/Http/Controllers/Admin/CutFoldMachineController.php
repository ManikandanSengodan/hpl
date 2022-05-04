<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CutFoldMachineRequest;
use App\Models\CutFoldMachineMaster;
use Illuminate\Http\Request;
use DB;

class CutFoldMachineController extends Controller
{
    public function index()
    {
        $cutFoldMachines = CutFoldMachineMaster::paginate(config("motorTraders.paginate.perPage"));
        return view("cut-fold-machine.index", compact("cutFoldMachines"));
    }

    public function create()
    {
        $editCutFoldMachine = "";
        return view("cut-fold-machine.create", compact("editCutFoldMachine"));
    }

    public function store(CutFoldMachineRequest $request)
    {
        try {
            CutFoldMachineMaster::create(["name" => $request->name, "fold" => $request->fold, "operator_designated" => $request->operator_designated]);
            
            return redirect()
            ->route("cut-fold-machine.index")
            ->with("success", "Cut Fold Machine created successfully.");

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

    public function show(CutFoldMachineMaster $cutFold)
    {
        $cutFold = $cutFold->findOrFail($cutFold->id);

        return view("cut-fold-machine.show", compact("cutFold"));
    }

    public function edit(CutFoldMachineMaster $cutFold)
    {
        $editCutFoldMachine = $cutFold->findOrFail($cutFold->id);

        return view("cut-fold-machine.create", compact("editCutFoldMachine"));
    }

    public function update(CutFoldMachineRequest $request, CutFoldMachineMaster $cutFold)
    {
        try {
            $cutFold->findOrFail($cutFold->id)->update(["name" => $request->name, "fold" => $request->fold, "operator_designated" => $request->operator_designated]);
            
            return redirect()
            ->route("cut-fold-machine.index")
            ->with("warning", "Cut Fold Machine updated successfully.");

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

    public function destroy(CutFoldMachineMaster $cutFold)
    {
        $cutFold->delete();
        return redirect()
        ->route("cut-fold-machine.index")
        ->with("danger", "Cut Fold Machine deleted successfully.");
    }
}
