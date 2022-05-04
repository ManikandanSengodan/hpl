<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InkMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        "color",
        "shade_no",
        "make",

    ];
}
