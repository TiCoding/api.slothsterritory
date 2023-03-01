<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // many to many relationship (inverse)

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
}
