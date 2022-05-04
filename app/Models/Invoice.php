<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable =[
        'customer_id',
        'design_card_id',
        'sum_rate',
        'sum_discount',
        'sum_tax',
        'sum_amount',
        'aditional_charge',
        'overall_discount',
        'total_amount',
        'recived_amount',
        'balance_amount',
        'invoice_no',
        'invoice_date',
        'due_date',
        'po_no',
        'Items',
        'current_balance',
        'previous_balance',
        'notes',
        ];

    public function customerDetail()
    {
        return $this->hasOne(CustomerMaster::class,'id','customer_id');
    }
}
