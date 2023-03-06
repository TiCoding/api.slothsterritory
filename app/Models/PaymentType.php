<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory, ApiTrait, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $allowInclude = [
        'payments',
    ];

    protected $allowFilter = [
        'id',
        'name',
    ];

    protected $allowSort = [
        'id',
        'name',
    ];


    // one to many relationship

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
