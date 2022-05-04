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
use App\Http\Requests\Admin\PoRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\FoldMaster;
use App\Models\YarnMaster;
use App\Models\Category;
use App\Models\PurchaseOrder;
use File;

class PurchaseorderController extends Controller
{
    public function index(Request $request)
    {
        
        $purchaseOrders = PurchaseOrder::with('designCard')->where('design_id', '<>',NULL )->where('design_id', '<>','' );
        
        // $purchaseOrders = DesignCard::with(['salesRepDetail','customerDetail'])->where('po_status',1);
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('design_cards');
//
//          $searchQuery = '%' . $request->search . '%';
//
//            $purchaseOrders->where(function ($query) use ($columnsToSearch,$searchQuery) {
//            foreach($columnsToSearch as $column) {
//                      $query = $query->orWhere($column, 'LIKE', $searchQuery);
//                  }
//			});
//        }


        $purchaseOrders = $purchaseOrders->paginate(config("motorTraders.paginate.perPage"));
        
        //dd($purchaseOrders);
        
        return view("purchaseorder.index", compact("purchaseOrders"));
    }


    public function create()
    {   
         $Po = PurchaseOrder::firstOrCreate(['design_id'=>'']);
         $DesignCard = DesignCard::with(['salesRepDetail','customerDetail'])->where('type','woven')->get();
        $data = $this->mastersDatas();
        $editPurchaseOrder = "";
        return view("purchaseorder.create", compact("data","editPurchaseOrder","Po",'DesignCard'));
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

    public function store(WovenRequest $request)
    {
        try {
          
            $mulitpleDesignFile = [];

            $uploadFiles        = [];

            $validatedFields = $this->addOrEditRequest($request);         

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
                ->route("purchaseorder.index")
                ->with("success", "Design card created successfully.");
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
        $purchaseOrders = PurchaseOrder::with('designCard')->findOrFail($woven);
        $editPurchaseOrder = DesignCard::where('id',$purchaseOrders->design_id)->first();
      
            $Po = $purchaseOrders;
            
            $Po->qty = json_decode($Po->qty);
            $Po->qty_title = json_decode($Po->qty_title);
           // print_r($Po->qty->total_mail_lable);exit;
        
        return view("purchaseorder.create", compact("data","editPurchaseOrder","Po"));
    }
    
    public function createpo($woven)
    {   
        $data           = $this->mastersDatas();
        $editPurchaseOrder = DesignCard::where('id',$woven)->first();
            
            $Po = PurchaseOrder::Create(['design_id'=>$editPurchaseOrder->id]);
            // dd($Po);
            $Po->qty = json_decode($Po->qty);
            
            // dd($Po);
        
        return  redirect()->route('purchaseorder.edit',$Po->id);
        
    }

    public function update(PoRequest $request, $woven)
    {
        try {
            $mulitpleDesignFile = [];
            
            $validatedFields    = $request->validated();

            
          
            //$woven->update($validatedFields);
            
            $po = $validatedFields;
           // dd($po);
            $po['qty_title'] = json_encode($po['qty_title']);
            $po['qty'] = json_encode($po['qty']);
            
            $po = PurchaseOrder::where('id',$woven)->update($po);
        
            return redirect()
        ->route("purchaseorder.index")
        ->with("warning", "Purchase Order updated successfully.");
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
        $purchaseOrders = PurchaseOrder::with('designCard')->findOrFail($woven);
        
        $viewDesignCard  = DesignCard::with(['customerDetail','designerDetail','salesRepDetail','warpDetail','foldMasterDetail','categoryMasterDetail'])->findOrFail($purchaseOrders->design_id);
        $weavers         = Staf_master::where('role_id',5)->whereIn('id',$viewDesignCard->weaver)->orderBy('created_at', 'DESC')->get()->toArray();
       
         $Po = $purchaseOrders;
            
            $Po->qty = json_decode($Po->qty);
            $Po->qty_title = json_decode($Po->qty_title);
            
        return view("purchaseorder.show", compact("purchaseOrders","viewDesignCard","weavers","Po"));
    }


    public function destroy(DesignCard $woven)
    {
        $woven->delete(); 
        return redirect()
        ->route("purchaseorder.index")
        ->with("danger", "Design card deleted successfully.");
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
