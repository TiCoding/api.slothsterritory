<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'dollar_amount',
        'colones_amount',
        'payment_date',
        'path_file',
        'payment_type_id',
        'payment_method_id',
        'paymentable_id',
        'paymentable_type',
    ];

    protected $allowInclude = [
        'paymentType',
        'paymentMethod',
        'paymentable',
        'reservation',
    ];

    protected $allowFilter = [
        'id',
        'dollar_amount',
        'colones_amount',
        'payment_date',
        'path_file',
        'payment_type_id',
        'payment_method_id',
        'paymentable_id',
        'paymentable_type',
    ];

    protected $allowSort = [
        'id',
        'dollar_amount',
        'colones_amount',
        'payment_date',
        'path_file',
        'payment_type_id',
        'payment_method_id',
        'paymentable_id',
        'paymentable_type',
    ];


    // one to many relationship (inverse)

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    // one to many relationship (inverse)

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // one to many polymorphic relationship (inverse)

    public function paymentable()
    {
        return $this->morphTo();
    }


}
