<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class GuideStatus extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $allowInclude = [
        'guides',
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

    public function guides()
    {
        return $this->hasMany(Guide::class);
    }
}
