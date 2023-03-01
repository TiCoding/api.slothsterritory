<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // many to many relationship (inverse)

    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'agency_tours');
    }
}
