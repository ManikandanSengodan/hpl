<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mou extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        
        "ship_to_party_code",
        "mou_code",
        "customer_id",
        "group_company",
        "price_point",
        "major_grade",
        "css_period",
        "mou_type",
        "monthly_target",
        "quarterly_target",
        "annual_target",
        "monthly_rate",
        "quarterly_rate",
        "annual_rate",
        "address",
        "region",
        "file_path",
        "status",
        "from_date",
        "to_date"

    ];


    public function mouDetails()
    {
        return $this->hasOne(CustomerMaster::class,'id','customer_id');
    }
}
