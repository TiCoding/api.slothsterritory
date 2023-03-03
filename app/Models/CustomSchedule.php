<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class CustomSchedule extends Model
{

    protected $fillable = [
        'schedule',
        'capacity',
        'deadline_hour',
        'custom_date_id',
    ];

    protected $allowInclude = [
        'customDate',
    ];

    protected $allowFilter = [
        'id',
        'schedule',
        'capacity',
        'deadline_hour',
        'custom_date_id',
    ];

    protected $allowSort = [
        'id',
        'schedule',
        'capacity',
        'deadline_hour',
        'custom_date_id',
    ];

    use HasFactory, ApiTrait;

    // one to many relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
