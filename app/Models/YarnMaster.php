<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class YarnMaster extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "supplier",
        "yarn_denier",
        "shade_No_suffix",
        "shade_No",
        "yarn_color",
        "color_shade",
        "notes",

    ];
}
