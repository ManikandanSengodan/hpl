<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ["design_id","party_po_no","sale_order_no","our_design_no","label","meterial","met_width","met_length","qty_title","qty","folding","fold_width","fold_lenth","total","balance",];

    
    public function designCard()
    {
        return $this->hasOne(DesignCard::class,'id','design_id')->with(['customerDetail','designerDetail','salesRepDetail','warpDetail','foldMasterDetail','categoryMasterDetail']);
    }

}
