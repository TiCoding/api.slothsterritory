<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    // one to many relationship

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
