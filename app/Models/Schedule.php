<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

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


    // one to many relationship (inverse)

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
