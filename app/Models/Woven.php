<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Woven extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "type_of_fold",
        "image",
        "minimum_mm",
        "notes",

    ];
}
