<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Guide extends Model
{

    protected $fillable = [
        'name',
        'guide_status_id',
    ];

    protected $allowInclude = [
        'guideStatus',
        'tourGroups',
        'tourGroups.reservations',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'guide_status_id',
    ];

    protected $allowSort = [
        'id',
        'name',
        'guide_status_id',
    ];

    use HasFactory, ApiTrait;

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




