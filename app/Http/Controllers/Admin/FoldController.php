<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\FoldMaster;
use App\Http\Requests\Admin\FoldRequest;
use Illuminate\Support\Facades\Storage;
use File;

class FoldController extends Controller
{
     public function index(Request $request)
    {
         $master = new FoldMaster();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('fold_masters');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $folds = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       
        return view("folds.index", compact("folds"));
    }


    public function create()
    {   
        return view("folds.create");
    }
   
    public function store(FoldRequest $request)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $foldCreate = FoldMaster::create($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$foldCreate->id}", 0755, true))
                if(!File::exists('foldsImage'))
                {
                    File::makeDirectory("foldsImage", 0755, true);
                }

                $filePath = $file->store("{$foldCreate->id}", [
                    "disk" => "folds",
                ]);
            }

            if (isset($filePath)) {
                $foldCreate->update([
                    "image" => $filePath,
                ]);
            }

           

            return redirect()->route("folds.index")->with("success", "Fold created successfully.");
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
    
    
    public function edit(FoldMaster $fold)
    {   
        
        FoldMaster::where('id',$fold->id)->first();
        return view("folds.edit", compact("fold"));
    }


    public function update(FoldRequest $request, FoldMaster $fold)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $fold->update($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$fold->id}", 0777, true))
                if(!File::exists('foldsImage'))
                {
                    File::makeDirectory("foldsImage", 0755, true);
                }
                $filePath = $file->store("{$fold->id}", [
                    "disk" => "folds",
                ]);
            }

            if (isset($filePath)) {
                $fold->update([
                    "image" => $filePath,
                ]);
            }

           

            return redirect()
        ->route("folds.index")
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
        $fold = FoldMaster::findOrFail($fold);
        return view("folds.show", compact("fold"));
    }


    public function destroy(FoldMaster $fold)
    {
        $fold->delete(); 
        return redirect()
        ->route("folds.index")
        ->with("danger", "Fold deleted successfully.");
    }
}
