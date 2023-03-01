<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // one to many relationship

    public function fees(){
        return $this->hasMany(Fee::class);
    }

    // one to many relationship

    public function commissions(){
        return $this->hasMany(Commission::class);
    }
}
