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
        'adult_price',
        'child_price',
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
        'adult_price',
        'child_price',
    ];

    protected $allowSort = [
        'id',
        'schedule',
        'capacity',
        'hours_before',
        'custom_date_id',
        'adult_price',
        'child_price',
    ];


    // one to many relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
