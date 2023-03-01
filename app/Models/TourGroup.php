<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGroup extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship (inverse)

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    // one to one relationship

    public function reservation(){
        return $this->hasOne(Reservation::class);
    }
}
