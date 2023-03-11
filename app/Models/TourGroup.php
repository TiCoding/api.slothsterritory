<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourGroup extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'guide_id',
        'date',
        'schedule',
    ];

    protected $allowInclude = [
        'guide',
        'reservations',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'guide_id',
        'date',
        'schedule',
    ];

    protected $allowSort = [
        'id',
        'name',
        'guide_id',
        'date',
        'schedule',
    ];


    // one to many relationship (inverse)

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
