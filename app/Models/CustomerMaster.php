<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\QueryScope;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class CustomerMaster extends Model
{
    use HasFactory, HasApiTokens, QueryScope;
    use SoftDeletes;
    
    protected $fillable = [
        "full_name",
        "email",
        "category",
        "mobile_number",
        "mobile",
        "pan",
        "secondary_email",
        "sales_rep",
        "password",
        "bank_name",
        "account_no",
        "IFSCCode",
        "opening_balance",
        "credit_period",
        "grade",
        "GST",
        "IGST",
        "SGST",
        "CGST",
        "company_name",
        "company_phone",
        "billing_address",
        "shipping_address",

        // New Table
        "customer_code",
        "customer_name",
        "group_company",
        "mobile_number",
        "pan",
        "password",
        "gst_no",
        "customer_address",
        "customer_region",
        "customer_group",
        "sold_party",
        "ship_party",
        "bill_party",
        "sales_office",
        "payer",
        "payer_name",
        "recon_account"
    ];

    protected $hidden = ["password", "remember_token"];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

  
    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function categoryMasterDetail()
    {
        return $this->hasOne(Category::class,'id','category');
    }

    public function salesRep()
    {
        return $this->hasOne(Staf_master::class,'id','sales_rep');
    }

    
}
