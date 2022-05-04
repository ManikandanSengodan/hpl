<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\DesignCard;
use App\Models\CustomerMaster;
use App\Models\LoomMaster;
use App\Models\Staf_master;
use App\Models\WarpMaster;
use App\Models\FinishingMachineMaster;
use App\Models\WovenQuality;
use App\Http\Requests\Admin\WovenRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\FoldMaster;
use App\Models\YarnMaster;
use App\Models\Category;
use File;

class PrintedController extends Controller
{
    public function index(Request $request)
    {

        // $wovens = DB::table('design_cards')->select('design_cards.*','customer_masters.first_name','customer_masters.last_name')
        // ->join('customer_masters', 'customer_masters.id', '=', 'design_cards.customer_id')
        // ->orderBy('created_at', 'DESC')
        // ->paginate(config("motorTraders.paginate.perPage"));

      // echo "<pre>"; print_r($wovens);exit;
      
      
      
      $wovens = DesignCard::with(['salesRepDetail','customerDetail'])->where('type','printed');
      
//      if($request->search){
//        $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('design_cards');
//
//        $searchQuery = '%' . $request->search . '%';
//
//        foreach($columnsToSearch as $column) {
//            $wovens = $wovens->orWhere($column, 'LIKE', $searchQuery);
//        }
//      }
      $wovens = $wovens->paginate(config("motorTraders.paginate.perPage"));
        
        return view("printed.index", compact("wovens"));
    }


    public function create()
    {   
        $data = $this->mastersDatas();
        $editdesignCard = "";
        return view("printed.create", compact("data","editdesignCard"));
    }

    public function decodeBase64Image($request, $id, $type)
    {
        $image = $request; // image base64 encoded

        preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension

        $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part

        $image = str_replace(' ', '+', $image);

        $filePath = "{$id}/{$type}_".time(). '.' . $image_extension[1]; //generating unique file name;

        Storage::disk('cardsImage')->put($filePath, base64_decode($image));

        return $filePath;
    }

    public function store(Request $request)
    {
        try {
            $mulitpleDesignFile = [];
            
            $uploadFiles        = [];
            
            $validatedFields = $this->addOrEditRequest($request);     
            $validatedFields['type'] = $request->has('type_store') ? $request->type_store : 'printed';
            $result = DesignCard::create($validatedFields);

            if ($request->hasFile("front_crop_image")) {
               
                // if(Storage::disk('cardsImage')->makeDirectory("{$result->id}", 0755, true))
                if(!File::exists('designCards'))
                {
                    File::makeDirectory("designCards", 0755, true);
                }
                $frontFileName = $this->decodeBase64Image($request->front_image, $result->id, 'front_image');
                $uploadFiles["front_image"] = $frontFileName;
            }else{
                unset($validatedFields["front_image"]);
            }

            // if ($request->hasFile("front_crop_image")) {
            //     $frontImage      = $request->file("front_crop_image");

            //     $frontFilename = $frontImage->store("{$result->id}", [
            //         "disk" => "cardsImage",
            //     ]);

            //     $uploadFiles["front_image"] = $frontFilename;
            // }

            if ($request->hasFile("back_crop_image")) {
                // if(Storage::disk('cardsImage')->makeDirectory("{$result->id}", 0755, true))
                if(!File::exists('designCards'))
                {
                    File::makeDirectory("designCards", 0755, true);
                }
                $backFilename = $this->decodeBase64Image($request->back_image, $result->id, 'back_image');

                $uploadFiles["back_image"] = $backFilename;
            }else{
                unset($validatedFields["back_image"]);
            }

            // if ($request->hasFile("back_crop_image")) {
            //     $backImage      = $request->file("back_crop_image");
                
            //     $backFilename = $backImage->store("{$result->id}", [
            //         "disk" => "cardsImage",
            //     ]);

            //     $uploadFiles["back_image"] = $backFilename;
            // }

            if ($request->hasFile("all_view_crop_image")) {
                // if(Storage::disk('cardsImage')->makeDirectory("{$result->id}", 0755, true))
                if(!File::exists('designCards'))
                {
                    File::makeDirectory("designCards", 0755, true);
                }
                $viewAllFilename = $this->decodeBase64Image($request->all_view_image, $result->id, 'all_view_image');

                $uploadFiles["all_view_image"] = $viewAllFilename;
            }else{
                unset($validatedFields["all_view_image"]);
            }

            // if ($request->hasFile("all_view_crop_image")) {
            //     $viewAllImage = $request->file("all_view_crop_image");
                
            //     $viewAllFilename = $viewAllImage->store("{$result->id}", [
            //         "disk" => "cardsImage",
            //     ]);

            //     $uploadFiles["all_view_image"] = $viewAllFilename;
            // }

            // if($request->hasfile('design_files'))
            // {
            //     foreach($request->file('design_files') as $file)
            //     {
            //         $filePaths = $file->store("{$result->id}", [
            //             "disk" => "cardsDocuments",
            //         ]);
            //         $mulitpleDesignFile[] = $filePaths;  
            //     }
            //     $uploadFiles['design_file'] = json_encode($mulitpleDesignFile);
            // }else{
            //     unset($validatedFields["design_file"]);
            // }

            if(request()->hasFile('design_files'))
            {
                foreach(request()->file('design_files') as $key => $designFile)
                {
                    $designfileName   = time().$key.'.'.$designFile->getClientOriginalExtension();
                    $mulitpleDesignFile[] = $designfileName;
                    // if(Storage::disk('cardsDocuments')->makeDirectory("{$result->id}", 0755, true))
                    if(!File::exists('cardsDocuments'))
                    {
                        File::makeDirectory("cardsDocuments", 0755, true);
                    }
                    $designFile->move(public_path("cardsDocuments/{$result->id}/"), $designfileName);
                }
                $uploadFiles['design_file'] = json_encode($mulitpleDesignFile);
            }else{
                unset($validatedFields["design_file"]);
            }
            
            if($request->hasfile('back_image') || $request->hasfile('front_image') || $request->hasfile('all_view_image') || $request->hasfile('design_files'))
            {
                $result->update($uploadFiles);
            }
        return redirect()
                ->route("printed.index")
        ->with("warning", "PO  updated successfully.");
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
    
    
    public function edit($woven)
    {   
        $data           = $this->mastersDatas();
        $editdesignCard = DesignCard::with(['customerDetail','designerDetail','salesRepDetail','warpDetail','foldMasterDetail','categoryMasterDetail'])->findOrFail($woven);
        //dd($woven);
        return view("printed.create", compact("data","editdesignCard"));
    }

    public function update(Request $request, $woven)
    {
        try {
            $woven = DesignCard::find($woven);
            $mulitpleDesignFile = [];
            
            $validatedFields    = $this->addOrEditRequest($request);

            if ($request->hasFile("front_crop_image")) {
                // if(Storage::disk('cardsImage')->makeDirectory("{$woven->id}", 0755, true))
                if(!File::exists('designCards'))
                {
                    File::makeDirectory("designCards", 0755, true);
                }
                $frontFileName = $this->decodeBase64Image($request->front_image, $woven->id, 'front_image');

                $validatedFields["front_image"] = $frontFileName;
            }else{
                unset($validatedFields["front_image"]);
            }
            
            if ($request->hasFile("back_crop_image")) {
                // if(Storage::disk('cardsImage')->makeDirectory("{$woven->id}", 0755, true))
                if(!File::exists('designCards'))
                {
                    File::makeDirectory("designCards", 0755, true);
                }
                $backFilename = $this->decodeBase64Image($request->back_image, $woven->id, 'back_image');

                $validatedFields["back_image"] = $backFilename;
            }else{
                unset($validatedFields["back_image"]);
            }

            if ($request->hasFile("all_view_crop_image")) {
                // if(Storage::disk('cardsImage')->makeDirectory("{$woven->id}", 0755, true))
                if(File::makeDirectory("designCards", 0755, true))
                {
                    $viewAllFilename = $this->decodeBase64Image($request->all_view_image, $woven->id, 'all_view_image');

                    $validatedFields["all_view_image"] = $viewAllFilename;
                }
            }else{
                unset($validatedFields["all_view_image"]);
            }

            if(request()->hasFile('design_files'))
            {
                $designFiles                = request()->file('design_files');

                foreach($designFiles as $key => $designFile)
                {
                    $designfileName   = time().$key.'.'.$designFile->getClientOriginalExtension();
                    $mulitpleDesignFile[] = $designfileName;
                    // if(Storage::disk('cardsDocuments')->makeDirectory("{$woven->id}", 0755, true))
                    if(!File::exists('cardsDocuments'))
                    {
                        File::makeDirectory("cardsDocuments", 0755, true);
                    }
               
                    $designFile->move(public_path("cardsDocuments/{$woven->id}/"), $designfileName);
               
                    // $filePath = $designFile->store("{$woven->id}", [
                    //     "disk" => "cardsDocuments",
                    // ]);
                    
                }
                $validatedFields['design_file']   = json_encode($mulitpleDesignFile);
            }else{
                unset($validatedFields["design_file"]);
            }
          
            $woven->update($validatedFields);
            return redirect()
        ->route("printed.index")
        ->with("warning", "PO  updated successfully.");
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
    
    public function show($woven)
    {
        $viewDesignCard  = DesignCard::with(['customerDetail','designerDetail','salesRepDetail','warpDetail','foldMasterDetail','categoryMasterDetail'])->findOrFail($woven);
        $weavers         = Staf_master::where('role_id',5)->whereIn('id',$viewDesignCard->weaver)->orderBy('created_at', 'DESC')->get()->toArray();
        return view("printed.show", compact("viewDesignCard","weavers"));
    }


    public function destroy(DesignCard $woven)
    {
        $woven->delete(); 
        return redirect()
        ->route("printed.index")
        ->with("danger", "Design card deleted successfully.");
    }
  
   public function po(DesignCard $woven)
    {
        $updated = DesignCard::where('id',$woven->id)->update(['po_status'=>1]); 
     
        return redirect()
        ->route("printed.purchaseorder.show",$woven)
        ->with("success", "PO Created successfully.");
    }

    public function addOrEditRequest($request)
    {
        $validatedFields                        = $request->all();
        $validatedFields['weaver']              = json_encode($request->weaver);
        $validatedFields['main_label']          = json_encode($request->main_label);
        $validatedFields['tab_label']           = json_encode($request->tab_label);
        $validatedFields['size_label']          = json_encode($request->size_label);
        $validatedFields['add_on_main_cost']    = json_encode($request->main_cost);
        $validatedFields['add_on_tab_cost']     = json_encode($request->tab_cost);
        $validatedFields['add_on_size_cost']    = json_encode($request->size_cost);
        $validatedFields['main_needle']         = json_encode($request->main_needle);
        $validatedFields['tab_needle']          = json_encode($request->tab_needle);
        $validatedFields['size_needle']         = json_encode($request->size_needle);
        
        return $validatedFields;
    }

    public function mastersDatas()
    {
        $data['categoryMaster']   = Category::get()->toArray();
        $data['yarnMaster']       = YarnMaster::get()->toArray();
        $data['customerMaster']   = CustomerMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $data['loomrMaster']      = LoomMaster::get()->toArray();
        $data['loomOperator']     = Staf_master::where('role_id',5)->orderBy('created_at', 'DESC')->get()->toArray();
        $data['designerMaster']   = Staf_master::where('role_id',1)->orderBy('created_at', 'DESC')->get()->toArray();
        $data['salesrepMaster']   = Staf_master::where('role_id',2)->orderBy('created_at', 'DESC')->get()->toArray();
        $data['warpMaster']       = WarpMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $data['finishingMaster']  = FinishingMachineMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $data['foldMaster']       = FoldMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $data['wovenQuality']     = WovenQuality::get()->toArray();
        return $data;
    }
}
