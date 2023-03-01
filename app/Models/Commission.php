<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship (inverse)

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    // one to one relationship (inverse)

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // one to many polymorphic relationship

    public function payments(){
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
