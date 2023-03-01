<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agency extends Model
{

    protected $fillable = [
        'name',
        'email',
        'commission_dollars',
        'commission_percent',
        'color',
    ];

    protected $allowInclude = [
        'reservations',
        'tours',
    ];

    use HasFactory;

    // one to many relationship

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // many to many relationship (inverse)

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'agency_tours');
    }

    // scopes
    public function scopeInclude(Builder $query)
    {
        // if no included parameter or no allowed relations, return
        if (!request()->has('included') || empty($this->allowInclude)) {
            return;
        }

        $relations = explode(',', request('included')); // convert string to array of relations
        $allowInclude = $this->allowInclude; // get allowed relations

        // remove relations that are not allowed
        foreach ($relations as $key => $relationship) {
            if (!in_array($relationship, $allowInclude)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);

    }
}
