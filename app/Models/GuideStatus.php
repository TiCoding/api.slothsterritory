<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideStatus extends Model
{
    use HasFactory;

    // one to many relationship

    public function guides()
    {
        return $this->hasMany(Guide::class);
    }
}
