<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship (inverse)

    public function reservationStatus(){
        return $this->belongsTo(ReservationStatus::class);
    }

    // one to many relationship (inverse)

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    // one to many relationship (inverse)

    public function paymentStatus(){
        return $this->belongsTo(PaymentStatus::class);
    }

    // one to many relationship (inverse)

    public function agency(){
        return $this->belongsTo(Agency::class);
    }

    // one to one relationship

    public function fee(){
        return $this->hasOne(Fee::class);
    }

    // one to one relationship

    public function commission(){
        return $this->hasOne(Commission::class);
    }

    // one to one relationship

    public function agencyData(){
        return $this->hasOne(AgencyData::class);
    }

    // one to one relationship

    public function tourGroup(){
        return $this->hasOne(TourGroup::class);
    }

    // one to many polymorphic relationship

    public function payments(){
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
