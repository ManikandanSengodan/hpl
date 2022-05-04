<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WovenQuality;
use App\Http\Requests\Admin\WovenQualityRequest;
use DB;
use File;

class wovenQualityController extends Controller
{
    
    public function index(Request $request)
    {
         $master = new WovenQuality();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('woven_qualities');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $master = $master->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
//
        $wovenqualitys = $master->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       
       
        return view("wovenqualitys.index", compact("wovenqualitys"));
    }


    public function create()
    {   
        return view("wovenqualitys.create");
    }
   
    public function store(WovenQualityRequest $request)
    {
        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $wovenQuality = WovenQuality::create($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$foldCreate->id}", 0755, true))
                if(!File::exists('weavingQualityImage'))
                {
                    File::makeDirectory("weavingQualityImage", 0755, true);
                }

                $filePath = $file->store("{$wovenQuality->id}", [
                    "disk" => "weavingQuality",
                ]);
            }

            if (isset($filePath)) {
                $wovenQuality->update([
                    "image" => $filePath,
                ]);
            }

            return redirect()
                ->route("wovenqualitys.index")
                ->with("success", "Weaving Quality created successfully.");
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
    
    
    public function edit(WovenQuality $wovenquality)
    {   
        
        $colour = WovenQuality::where('id',$wovenquality->id)->first();
        return view("wovenqualitys.edit", compact("wovenquality"));
    }


    public function update(WovenQualityRequest $request, WovenQuality $wovenquality)
    {
        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $wovenquality->update($request->all());

            if ($request->hasFile("image")) {
//                return $wovenquality->id;
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$fold->id}", 0777, true))
                if(!File::exists('weavingQualityImage'))
                {
                    File::makeDirectory("weavingQualityImage", 0755, true);
                }
                $filePath = $file->store("{$wovenquality->id}", [
                    "disk" => "weavingQuality",
                ]);
            }

            if (isset($filePath)) {
                $wovenquality->update([
                    "image" => $filePath,
                ]);
            }



            return redirect()
                ->route("wovenqualitys.index")
                ->with("warning", "Weaving Quality updated successfully.");

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
    
    public function show($wovenquality)
    {
        $wovenquality = WovenQuality::findOrFail($wovenquality);
        return view("wovenqualitys.show", compact("wovenquality"));
    }


    public function destroy(WovenQuality $wovenquality)
    {
        $wovenquality->delete(); 
        return redirect()
        ->route("wovenqualitys.index")
        ->with("danger", "Weaving Quality deleted successfully.");
    }
}
