<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_address extends Model
{
    use HasFactory;
    protected $table = 'admin_addresses';
    protected $fillable = ["id", "admin_id"];

}
