<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Commission extends Model
{

    protected $fillable = [
        'amount_dollars',
        'amount_colones',
        'reservation_id',
        'payment_status_id',
    ];

    protected $allowInclude = [
        'reservation',
        'paymentStatus',
        'payments',
        'payments.paymentMethod',
        'payments.paymentType',
    ];

    protected $allowFilter = [
        'id',
        'amount_dollars',
        'amount_colones',
        'reservation_id',
        'payment_status_id',
    ];

    protected $allowSort = [
        'id',
        'amount_dollars',
        'amount_colones',
        'reservation_id',
        'payment_status_id',
    ];

    use HasFactory, ApiTrait;

    // one to many relationship (inverse)

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    // one to one relationship (inverse)

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // one to many polymorphic relationship

    public function payments(){
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
