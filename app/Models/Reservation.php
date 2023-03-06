<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'amount_adults',
        'amount_children',
        'amount_children_free',
        'total_price_dollars',
        'total_price_colones',
        'discount_dollars',
        'discount_colones',
        'taxes_dollars',
        'taxes_colones',
        'net_price_dollars',
        'net_price_colones',
        'invoice',
        'comments',
        'date',
        'adult_price_dollars',
        'adult_price_colones',
        'child_price_dollars',
        'child_price_colones',
        'schedule',
        'agency_id',
        'customer_id',
        'payment_status_id',
        'reservation_status_id',
        'tour_id',
        'tour_group_id',
        'user_id',
    ];

    protected $allowInclude = [
        'agency',
        'customer',
        'paymentStatus',
        'reservationStatus',
        'tour',
        'tourGroup',
        'tourGroup.guide',
        'tour.schedules',
        'agency.tours',
        'agency.agencyTours',
        'agency.agencyTours.customDates',
        'agency.agencyTours.customDates.customPrice',
        'agency.agencyTours.customDates.customSchedules',
        'payments',
        'payments.paymentMethod',
        'payments.paymentType',
        'agencyData',
        'fee',
        'fee.paymentStatus',
        'fee.payments',
        'commission',
        'commission.paymentStatus',
        'commission.payments',
        'user',

    ];

    protected $allowFilter = [
        'id',
        'amount_adults',
        'amount_children',
        'amount_children_free',
        'total_price_dollars',
        'total_price_colones',
        'discount_dollars',
        'discount_colones',
        'taxes_dollars',
        'taxes_colones',
        'net_price_dollars',
        'net_price_colones',
        'invoice',
        'comments',
        'date',
        'adults_price_dollars',
        'adults_price_colones',
        'child_price_dollars',
        'child_price_colones',
        'schedule',
        'agency_id',
        'customer_id',
        'payment_status_id',
        'reservation_status_id',
        'tour_id',
        'tour_group_id',
        'user_id',
    ];

    protected $allowSort = [
        'id',
        'amount_adults',
        'amount_children',
        'amount_children_free',
        'total_price_dollars',
        'total_price_colones',
        'discount_dollars',
        'discount_colones',
        'taxes_dollars',
        'taxes_colones',
        'net_price_dollars',
        'net_price_colones',
        'invoice',
        'comments',
        'date',
        'adults_price_dollars',
        'adults_price_colones',
        'child_price_dollars',
        'child_price_colones',
        'schedule',
        'agency_id',
        'customer_id',
        'payment_status_id',
        'reservation_status_id',
        'tour_id',
        'tour_group_id',
        'user_id',
    ];


    // one to many relationship (inverse)

    public function reservationStatus(){
        return $this->belongsTo(ReservationStatus::class);
    }

    // one to many relationship (inverse)

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    // one to many relationship (inverse)

    public function paymentStatus(){
        return $this->belongsTo(PaymentStatus::class);
    }

    // one to many relationship (inverse)

    public function agency(){
        return $this->belongsTo(Agency::class);
    }

    // one to one relationship

    public function fee(){
        return $this->hasOne(Fee::class);
    }

    // one to one relationship

    public function commission(){
        return $this->hasOne(Commission::class);
    }

    // one to one relationship

    public function agencyData(){
        return $this->hasOne(AgencyData::class);
    }

    // one to many relationship (inverse)

    public function user(){
        return $this->belongsTo(User::class);
    }

    // one to many relationship (inverse)

    public function tour(){
        return $this->belongsTo(Tour::class);
    }

    // one to many relationship (inverse)

    public function tourGroup(){
        return $this->belongsTo(TourGroup::class);
    }

    // one to many polymorphic relationship

    public function payments(){
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
