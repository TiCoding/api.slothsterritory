<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomDate extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

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

    // scopes
    // get custome dtae if date exist between start and end date
    public function scopeGetCustomDate(Builder $query)
    {
        // return;
        if (!request()->has('date')) {
            return;
        }

        $date = request('date');

        $query->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date);
    }
}
