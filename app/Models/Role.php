<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Role extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $allowInclude = [
        'users',
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
