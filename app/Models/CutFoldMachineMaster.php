<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutFoldMachineMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "fold",
        "operator_designated"
    ];
}
