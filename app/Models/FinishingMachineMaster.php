<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FinishingMachineMaster extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "machine",
        "folds_available",
        "min_end_fold",
        "max_length_mm",
        "speed",
        "year",
        "notes",
        "serial_Nos",

    ];
}
