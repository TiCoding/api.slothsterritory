<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class AgencyData extends Model
{

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

    use HasFactory, ApiTrait;

    // one to one relationship (inverse)

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
