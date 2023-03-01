<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPrice extends Model
{
    use HasFactory;

    // one to one relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
