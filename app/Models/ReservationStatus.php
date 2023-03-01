<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    use HasFactory;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
