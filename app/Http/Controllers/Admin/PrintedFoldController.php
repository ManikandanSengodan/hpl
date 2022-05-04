<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrintedFoldRequest;
use App\Models\PrintedFoldMaster;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use File;

class PrintedFoldController extends Controller
{
     public function index(Request $request)
    {
         $master = new PrintedFoldMaster();
      
        $folds = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       
        return view("printed-folds.index", compact("folds"));
    }


    public function create()
    {   
        return view("printed-folds.create");
    }
   
    public function store(PrintedFoldRequest $request)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $foldCreate = PrintedFoldMaster::create($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$foldCreate->id}", 0755, true))
                if(!File::exists('printedFoldsImage'))
                {
                    File::makeDirectory("printedFoldsImage", 0755, true);
                }

                $filePath = $file->store("{$foldCreate->id}", [
                    "disk" => "printed-folds",
                ]);
            }

            if (isset($filePath)) {
                $foldCreate->update([
                    "image" => $filePath,
                ]);
            }

           

            return redirect()->route("printed-folds.index")->with("success", "Fold created successfully.");
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
    
    
    public function edit(PrintedFoldMaster $fold)
    {   
        
        $colour = PrintedFoldMaster::where('id',$fold->id)->first();
        return view("printed-folds.edit", compact("fold"));
    }


    public function update(PrintedFoldRequest $request, PrintedFoldMaster $fold)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $fold->update($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$fold->id}", 0777, true))
                if(!File::exists('printedFoldsImage'))
                {
                    File::makeDirectory("printedFoldsImage", 0755, true);
                }
                $filePath = $file->store("{$fold->id}", [
                    "disk" => "printed-folds",
                ]);
            }

            if (isset($filePath)) {
                $fold->update([
                    "image" => $filePath,
                ]);
            }

           

            return redirect()
        ->route("printed-folds.index")
        ->with("warning", "Fold created successfully.");

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
    
    public function show($fold)
    {
        $fold = PrintedFoldMaster::findOrFail($fold);
        return view("printed-folds.show", compact("fold"));
    }


    public function destroy(PrintedFoldMaster $fold)
    {
        $fold->delete(); 
        return redirect()
        ->route("printed-folds.index")
        ->with("danger", "Fold deleted successfully.");
    }
}
