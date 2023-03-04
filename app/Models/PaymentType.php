<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class PaymentType extends Model
{

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

    use HasFactory, ApiTrait;

    // one to many relationship

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
