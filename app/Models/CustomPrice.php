<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomPrice extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'adult_price',
        'child_price',
        'custom_date_id',
    ];

    protected $allowInclude = [
        'customDate',
    ];

    protected $allowFilter = [
        'id',
        'adult_price',
        'child_price',
        'custom_date_id',
    ];

    protected $allowSort = [
        'id',
        'adult_price',
        'child_price',
        'custom_date_id',
    ];


    // one to one relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
