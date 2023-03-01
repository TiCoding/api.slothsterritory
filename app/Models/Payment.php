<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $guarded = [];

    use HasFactory;

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
