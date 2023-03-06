<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyData extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'agent_name',
        'reservation_id',
    ];

    protected $allowInclude = [
        'reservation',
    ];

    protected $allowFilter = [
        'id',
        'agent_name',
        'reservation_id',
    ];

    protected $allowSort = [
        'id',
        'agent_name',
        'reservation_id',
    ];


    // one to one relationship (inverse)

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
