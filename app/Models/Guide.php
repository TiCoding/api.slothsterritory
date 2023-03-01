<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{

    protected $guarded = [];

    use HasFactory;

    // one to many relationship (inverse)

    public function guideStatus()
    {
        return $this->belongsTo(GuideStatus::class);
    }

    // one to many relationship

    public function tourGroups()
    {
        return $this->hasMany(TourGroup::class);
    }
}
