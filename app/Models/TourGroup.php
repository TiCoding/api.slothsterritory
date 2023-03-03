<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class TourGroup extends Model
{

    protected $fillable = [
        'name',
        'guide_id',
    ];

    protected $allowInclude = [
        'guide',
        'reservations',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'guide_id',
    ];

    protected $allowSort = [
        'id',
        'name',
        'guide_id',
    ];

    use HasFactory, ApiTrait;

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
