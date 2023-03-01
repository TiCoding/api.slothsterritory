<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSchedule extends Model
{
    use HasFactory;

    // one to many relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
