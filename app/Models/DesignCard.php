<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\YarnMaster;

class DesignCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "label",
        "date",
        "front_image",
        "back_image",
        "all_view_image",
        "design_file",
        "designer_id",
        "salesrep_id",
        "weaver",
        "warps_id",
        "finishing",
        "description",
        "main_label",
        "tab_label",
        "size_label",
        "add_on_main_cost",
        "add_on_tab_cost",
        "add_on_size_cost",
        "main_needle",
        "tab_needle",
        "size_needle",
        "speed_effiency",
        "customer_grade",
        "category",
        "chart",
      	"type"
    ];

     public function getWeaverAttribute($value)
    {
        $weaver = json_decode($value, true);

        return is_array($weaver) && count($weaver) > 0
            ? $weaver
            : [];
    }

    public function getMainLabelAttribute($value)
    {
        $mainLabel = json_decode($value, true);

        return is_array($mainLabel) && count($mainLabel) > 0
            ? $mainLabel
            : [];
    }

    public function getTabLabelAttribute($value)
    {
        $tabLabel = json_decode($value, true);

        return is_array($tabLabel) && count($tabLabel) > 0
            ? $tabLabel
            : [];
    }

    public function getSizeLabelAttribute($value)
    {
        $tabLabel = json_decode($value, true);

        return is_array($tabLabel) && count($tabLabel) > 0
            ? $tabLabel
            : [];
    }

    public function getAddOnMainCostAttribute($value)
    {
        $addOnMainCost = json_decode($value, true);

        return is_array($addOnMainCost) && count($addOnMainCost) > 0
            ? $addOnMainCost
            : [];
    }

    public function getAddOnTabCostAttribute($value)
    {
        $addOnTabCost = json_decode($value, true);

        return is_array($addOnTabCost) && count($addOnTabCost) > 0
            ? $addOnTabCost
            : [];
    }

    public function getAddOnSizeCostAttribute($value)
    {
        $addOnTabCost = json_decode($value, true);

        return is_array($addOnTabCost) && count($addOnTabCost) > 0
            ? $addOnTabCost
            : [];
    }

    public function getMainNeedleAttribute($value)
    {
        $mainNeedles               = !empty($value) ?  is_array(json_decode($value,true)) ? json_decode($value,true) : [] : [];
        $mainNeedle                = [];
        foreach($mainNeedles as $mainneedle)
        {
            $yarnA = YarnMaster::where("id", $mainneedle['a'])->first();
            $yarnB = YarnMaster::where("id", $mainneedle['b'])->first();
            $yarnC = YarnMaster::where("id", isset($mainneedle['c']) ? $mainneedle['c'] : '')->first();
            $yarnD = YarnMaster::where("id", isset($mainneedle['d']) ? $mainneedle['d'] : '')->first();
            $yarnE = YarnMaster::where("id", isset($mainneedle['e']) ? $mainneedle['e'] : '')->first();
            
           
            $mainNeedle[] = [
                                'needle_no'         => $mainneedle['needle_no'],
                                'pantone'           => isset($mainneedle['pantone']) ? $mainneedle['pantone'] : '',
                                'color'             => $mainneedle['color'],
                                'color_shade'       => $mainneedle['color_shade'],
                                'denier'            => isset($mainneedle['denier']) ? $mainneedle['denier'] : '',
                                'a'                 => isset($mainneedle['a']) ? $mainneedle['a'] : '',
                                'a1'                => isset($yarnA['shade_No']) ? $yarnA['shade_No'] : '-',
                                'b'                 => isset($mainneedle['b']) ? $mainneedle['b'] : '',
                                'b1'                => isset($yarnB['shade_No']) ? $yarnB['shade_No'] : '-',
                                'c'                 => isset($mainneedle['c']) ? $mainneedle['c'] : '',
                                'c1'                => isset($yarnC['shade_No']) ? $yarnC['shade_No'] : '-',
                                'd'                 => isset($mainneedle['d']) ? $mainneedle['d'] : '',
                                'd1'                => isset($yarnD['shade_No']) ? $yarnD['shade_No'] : '-',
                                'e'                 => isset($mainneedle['e']) ? $mainneedle['e'] : '',
                                'e1'                => isset($yarnE['shade_No']) ? $yarnE['shade_No'] : '-',
                            ];
        }

        return is_array($mainNeedle) && count($mainNeedle) > 0
            ? $mainNeedle
            : [];
    }

    public function getTabNeedleAttribute($value)
    {
        $tabNeedles               = !empty($value) ?  is_array(json_decode($value,true)) ? json_decode($value,true) : [] : [];
        $tabNeedle                = [];
        foreach($tabNeedles as $tabneedle)
        {
            $yarnA = YarnMaster::where("id", $tabneedle['a'])->first();
            $yarnB = YarnMaster::where("id", $tabneedle['b'])->first();
            $yarnC = YarnMaster::where("id", $tabneedle['c'])->first();
            $yarnD = YarnMaster::where("id", $tabneedle['d'])->first();
            $yarnE = YarnMaster::where("id", $tabneedle['e'])->first();
            
           
            $tabNeedle[] = [
                                'needle_no'         => $tabneedle['needle_no'],
                                'pantone'           => $tabneedle['pantone'],
                                'color'             => $tabneedle['color'],
                                'color_shade'       => $tabneedle['color_shade'],
                                'denier'            => $tabneedle['denier'],
                                'a'                 => isset($tabneedle['a']) ? $tabneedle['a'] : '',
                                'a1'                => isset($yarnA['shade_No']) ? $yarnA['shade_No'] : '-',
                                'b'                 => isset($tabneedle['b']) ? $tabneedle['b'] : '',
                                'b1'                => isset($yarnB['shade_No']) ? $yarnB['shade_No'] : '-',
                                'c'                 => isset($tabneedle['c']) ? $tabneedle['c'] : '',
                                'c1'                => isset($yarnC['shade_No']) ? $yarnC['shade_No'] : '-',
                                'd'                 => isset($tabneedle['d']) ? $tabneedle['d'] : '',
                                'd1'                => isset($yarnD['shade_No']) ? $yarnD['shade_No'] : '-',
                                'e'                 => isset($tabneedle['e']) ? $tabneedle['e'] : '',
                                'e1'                => isset($yarnE['shade_No']) ? $yarnE['shade_No'] : '-',
                            ];
        }

        return is_array($tabNeedle) && count($tabNeedle) > 0
            ? $tabNeedle
            : [];
    }

    public function getSizeNeedleAttribute($value)
    {
        
        $sizeNeedles               = !empty($value) ?  is_array(json_decode($value,true)) ? json_decode($value,true) : [] : [];
        $sizeNeedle                = [];
        foreach($sizeNeedles as $sizeneedle)
        {
            $yarnA = YarnMaster::where("id", $sizeneedle['a'])->first();
            $yarnB = YarnMaster::where("id", $sizeneedle['b'])->first();
            $yarnC = YarnMaster::where("id", $sizeneedle['c'])->first();
            $yarnD = YarnMaster::where("id", $sizeneedle['d'])->first();
            $yarnE = YarnMaster::where("id", $sizeneedle['e'])->first();
            
           
            $sizeNeedle[] = [
                                'needle_no'         => $sizeneedle['needle_no'],
                                'pantone'           => $sizeneedle['pantone'],
                                'color'             => $sizeneedle['color'],
                                'color_shade'       => $sizeneedle['color_shade'],
                                'denier'            => $sizeneedle['denier'],
                                'a'                 => isset($sizeneedle['a']) ? $sizeneedle['a'] : '',
                                'a1'                => isset($yarnA['shade_No']) ? $yarnA['shade_No'] : '-',
                                'b'                 => isset($sizeneedle['b']) ? $sizeneedle['b'] : '',
                                'b1'                => isset($yarnB['shade_No']) ? $yarnB['shade_No'] : '-',
                                'c'                 => isset($sizeneedle['c']) ? $sizeneedle['c'] : '',
                                'c1'                => isset($yarnC['shade_No']) ? $yarnC['shade_No'] : '-',
                                'd'                 => isset($sizeneedle['d']) ? $sizeneedle['d'] : '',
                                'd1'                => isset($yarnD['shade_No']) ? $yarnD['shade_No'] : '-',
                                'e'                 => isset($sizeneedle['e']) ? $sizeneedle['e'] : '',
                                'e1'                => isset($yarnE['shade_No']) ? $yarnE['shade_No'] : '-',
                            ];
        }
        return is_array($sizeNeedle) && count($sizeNeedle) > 0
            ? $sizeNeedle
            : [];
    }

    // public function getDesignFileAttribute($value)
    // {
    //     $designFile = json_decode($value, true);

    //     return is_array($designFile) && count($designFile) > 0
    //         ? $designFile
    //         : [];
    // }

    // public function getFrontImageAttribute($value)
    // {
    //     $existsFile = Storage::disk("cardsImage")->exists("{$value}");
    //     return $value && $existsFile ? Storage::disk("cardsImage")->url('/')."{$value}" : "";
    // }

    // public function getBackImageAttribute($value)
    // {
    //     $existsFile = Storage::disk("cardsImage")->exists("{$value}");
    //     return $value && $existsFile ? Storage::disk("cardsImage")->url('/')."{$value}" : "";
    // }

    // public function getAllViewImageAttribute($value)
    // {
    //     $existsFile = Storage::disk("cardsImage")->exists("{$value}");
    //     return $value && $existsFile ? Storage::disk("cardsImage")->url('/')."{$value}" : "";
    // }

    public function customerDetail()
    {
        return $this->hasOne(CustomerMaster::class,'id','customer_id');
    }

    
    public function designerDetail()
    {
        return $this->hasOne(Staf_master::class,'id','designer_id')->where('role_id',1);
    }

    public function salesRepDetail()
    {
        return $this->hasOne(Staf_master::class,'id','salesrep_id')->where('role_id',2);
    }

    public function warpDetail()
    {
        return $this->hasOne(WarpMaster::class,'id','warps_id');
    }

    // public function finishingDetail()
    // {
    //     return $this->hasOne(FinishingMachineMaster::class,'id','finishing');
    // }     

    public function foldMasterDetail()
    {
        return $this->hasOne(FoldMaster::class,'id','finishing');
    }         

    public function categoryMasterDetail()
    {
        return $this->hasOne(Category::class,'id','category');
    }
    
}
