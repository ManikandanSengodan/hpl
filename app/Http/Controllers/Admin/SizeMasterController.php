<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeMmRequest;
use Illuminate\Http\Request;
use App\Models\SizeMastermm;
use DB;

class SizeMasterController extends Controller
{
    public function index()
    {
        $sizeMasters = SizeMastermm::paginate(config("motorTraders.paginate.perPage"));
        return view("size-master-mm.index", compact("sizeMasters"));
    }

    public function create()
    {
        $editSize = "";
        return view("size-master-mm.create", compact("editSize"));
    }

    public function store(SizeMmRequest $request)
    {
        try {
            SizeMastermm::create($request->all());
            
            return redirect()
            ->route("size-master-mm.index")
            ->with("success", "Size created successfully.");

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

    public function show(SizeMastermm $size)
    {
        $size = SizeMastermm::findOrFail($size->id);

        return view("size-master-mm.show", compact("size"));
    }

    public function edit(SizeMastermm $size)
    {
        $editSize = $size->findOrFail($size->id);

        return view("size-master-mm.create", compact("editSize"));
    }

    public function update(SizeMmRequest $request, SizeMastermm $size)
    {
        try {
            $size->findOrFail($size->id)->update($request->all());
            
            return redirect()
            ->route("size-master-mm.index")
            ->with("warning", "Size updated successfully.");

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

    public function destroy(SizeMastermm $size)
    {
        $size->delete();
        return redirect()
        ->route("size-master-mm.index")
        ->with("danger", "Size deleted successfully.");
    }
}
