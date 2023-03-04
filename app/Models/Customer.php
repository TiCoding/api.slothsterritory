<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Customer extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected $allowInclude = [
        'reservations',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'email',
        'phone',
    ];

    protected $allowSort = [
        'id',
        'name',
        'email',
        'phone',
    ];

    use HasFactory, ApiTrait;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
