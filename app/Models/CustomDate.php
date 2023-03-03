<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class CustomDate extends Model
{

    protected $fillable = [
        'start_date',
        'end_date',
        'agency_tour_id',
    ];

    protected $allowInclude = [
        'customPrice',
        'customSchedules',
        'agencyTour',
        'agencyTour.tour',
        'agencyTour.agency',
        'agencyTour.agency.reservations',
    ];

    protected $allowFilter = [
        'id',
        'start_date',
        'end_date',
        'agency_tour_id',
    ];

    protected $allowSort = [
        'id',
        'start_date',
        'end_date',
        'agency_tour_id',
    ];

    use HasFactory, ApiTrait;

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
