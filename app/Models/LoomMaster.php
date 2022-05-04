<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LoomMaster extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        "loom_name",
        "weaving_width_Meter",
        "sections",
        "speed",
        "year",
        "notes",

    ];
}
