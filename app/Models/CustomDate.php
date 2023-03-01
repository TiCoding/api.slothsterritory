<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomDate extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to one relationship

    public function customPrice()
    {
        return $this->hasOne(CustomPrice::class);
    }

    // one to many relationship

    public function customSchedules()
    {
        return $this->hasMany(CustomSchedule::class);
    }

    // one to many relationship (inverse)

    public function agencyTour()
    {
        return $this->belongsTo(AgencyTour::class);
    }
}
