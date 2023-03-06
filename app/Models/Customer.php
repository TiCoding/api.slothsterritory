<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

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


    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
