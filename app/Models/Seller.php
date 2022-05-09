<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Model
{
    use HasFactory, HasApiTokens, QueryScope;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "address_line",
        "location_id",
        "postal_code",
        "subscription_plan_id",
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
        return $this->belongsTo(City::class, "location_id");
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
