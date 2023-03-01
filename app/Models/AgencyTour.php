<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyTour extends Model
{
    use HasFactory;

    // one to many relationship

    public function customDates()
    {
        return $this->hasMany(CustomDate::class);
    }
}
