<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomSchedule extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'schedule',
        'capacity',
        'hours_before',
        'custom_date_id',
    ];

    protected $allowInclude = [
        'customDate',
    ];

    protected $allowFilter = [
        'id',
        'schedule',
        'capacity',
        'hours_before',
        'custom_date_id',
    ];

    protected $allowSort = [
        'id',
        'schedule',
        'capacity',
        'hours_before',
        'custom_date_id',
    ];


    // one to many relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
