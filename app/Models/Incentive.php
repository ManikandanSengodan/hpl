<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;


    protected $fillable = [
        
        "customer_id",
        "mou_id",
        "jul",
        "aug",
        "sep",
        "oct",
        "q2",
        "nov",
        "dec",
        "q3",
        "jan",
        "feb",
        "mar",
        "q4",
        "annual",
        "publish"
    ];
}
