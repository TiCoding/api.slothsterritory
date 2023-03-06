<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'path_image',
    ];

    protected $allowInclude = [
        'schedules',
        'agencies',
        'agencyTours',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'description',
        'path_image',
    ];

    protected $allowSort = [
        'id',
        'name',
        'description',
        'path_image',
    ];


    // one to many relationship

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // one to many relationship

    public function agencyTours()
    {
        return $this->hasMany(AgencyTour::class);
    }

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // many to many relationship (inverse)

    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'agency_tours');
    }
}
