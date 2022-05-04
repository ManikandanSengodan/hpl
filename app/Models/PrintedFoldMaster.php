<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PrintedFoldMaster extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "type_of_fold",
        "image",
        "minimum_mm",
        "maximum_mm",
        "notes",

    ];

    public function getImageAttribute($value)
    {
        return $value ? asset("printedFoldsImage/${value}") : "";
    }
}
