<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf_address extends Model
{
    use HasFactory;

    protected $table = 'staf_address';

    protected $fillable = ["id", "staf_id"];
}
