<?php

namespace App\Models;
use App\Traits\QueryScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class VendorMaster extends Authenticatable
{
    use HasFactory, HasApiTokens, QueryScope;
    use SoftDeletes;
    protected $fillable = [
        "full_name",
        "category",
        "email",
        "mobile_number",
        "mobile",
        "pan",
        "password",
        "bank_name",
        "account_no",
        "IFSCCode",
        "opening_balance",
        "credit_balance",
        "credit_period",
        "grade",
        "GST",
        "status",
        "shipping_address",
        "billing_address",
        "CGST",
        "SGST",
        "IGST",
        
    ];

    

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
}
