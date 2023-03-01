<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // one to many relationship (inverse)

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
