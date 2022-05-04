<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_name",
        "mobile_no",
        "email",
        "GSTIN",
        "image",
        "type",
        "address",
        "account_name",
        "account_no",
        "IFSCCode",
        "bank_and_branch_name",
        "UPI_ID",
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset("profileImage/${value}") : "";
    }
}
