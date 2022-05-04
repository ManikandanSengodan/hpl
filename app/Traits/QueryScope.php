<?php

namespace App\Traits;

trait QueryScope
{
    public function scopeDesc($query)
    {
        return $query->orderBy("id", "desc");
    }
}
