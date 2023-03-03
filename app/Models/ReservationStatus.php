<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class ReservationStatus extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $allowInclude = [
        'reservations',
    ];

    protected $allowFilter = [
        'id',
        'name',
    ];

    protected $allowSort = [
        'id',
        'name',
    ];

    use HasFactory, ApiTrait;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
