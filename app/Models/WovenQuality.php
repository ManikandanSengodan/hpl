<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WovenQuality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "quality",
        "image",
        "material",
        "notes",

    ];

    public function getImageAttribute($value)
    {
        return $value ? asset("weavingQualityImage/${value}") : "";
    }
}
