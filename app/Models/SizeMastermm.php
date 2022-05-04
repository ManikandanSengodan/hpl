<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeMastermm extends Model
{
    use HasFactory;

    protected $fillable = [
        "size",
        "measurement"
    ];
}
