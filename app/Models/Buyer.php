<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Buyer extends Model
{
    use HasFactory, HasApiTokens, QueryScope;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "secondary_email",
        "sales_rep",
        "business_name",
        "business_phone",
        "business_email",
        "business_registration_document",
        "abn",
        "address_line",
        "location_id",
        "postal_code",
    ];

    protected $hidden = ["password", "remember_token"];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function location()
    {
        return $this->belongsTo(City::class);
    }
}
