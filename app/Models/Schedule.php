<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Schedule extends Model
{

    protected $fillable = [
        'schedule',
        'capacity',
        'deadline_hour',
        'tour_id',
    ];

    protected $allowInclude = [
        'tour',
    ];

    protected $allowFilter = [
        'id',
        'schedule',
        'capacity',
        'deadline_hour',
        'tour_id',
    ];

    protected $allowSort = [
        'id',
        'schedule',
        'capacity',
        'deadline_hour',
        'tour_id',
    ];

    use HasFactory, ApiTrait;

    // one to many relationship (inverse)

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
