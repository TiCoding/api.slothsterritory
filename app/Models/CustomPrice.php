<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class CustomPrice extends Model
{

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

    use HasFactory, ApiTrait;

    // one to one relationship (inverse)

    public function customDate()
    {
        return $this->belongsTo(CustomDate::class);
    }
}
