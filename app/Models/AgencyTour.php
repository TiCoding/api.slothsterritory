<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyTour extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'adult_price',
        'child_price',
        'agency_id',
        'tour_id',
    ];

    protected $allowInclude = [
        'customDates',
        'tour',
        'agency',
        'customDates.customPrice',
        'customDates.customSchedules',
    ];

    protected $allowFilter = [
        'id',
        'adult_price',
        'child_price',
        'agency_id',
        'tour_id',
    ];

    protected $allowSort = [
        'id',
        'adult_price',
        'child_price',
        'agency_id',
        'tour_id',
    ];


    // one to many relationship

    public function customDates()
    {
        return $this->hasMany(CustomDate::class);
    }

    // one to many relationship (inverse)

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    // one to many relationship (inverse)

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
