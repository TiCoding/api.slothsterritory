<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Traits\ApiTrait;

class Agency extends Model
{

    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'commission_dollars',
        'commission_percent',
        'color',
    ];

    protected $allowInclude = [
        'reservations',
        'tours',
        'tours.schedules',
        'agencyTours',
        'agencyTours.customDates',
        'agencyTours.tour',
        'agencyTours.customDates.customPrice',
        'agencyTours.customDates.customSchedules',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'email',
        'color',
    ];

    protected $allowSort = [
        'id',
        'name',
        'email',
        'commission_dollars',
        'commission_percent',
        'color',
    ];

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // many to many relationship (inverse)

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'agency_tours');
    }

    // one to many relationship

    public function agencyTours()
    {
        return $this->hasMany(AgencyTour::class);
    }
}
