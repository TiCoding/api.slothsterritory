<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyData extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to one relationship (inverse)

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
