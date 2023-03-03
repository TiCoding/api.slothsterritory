<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class PaymentStatus extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $allowInclude = [
        'reservations',
        'fees',
        'commissions',
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

    // one to many relationship

    public function fees(){
        return $this->hasMany(Fee::class);
    }

    // one to many relationship

    public function commissions(){
        return $this->hasMany(Commission::class);
    }
}
