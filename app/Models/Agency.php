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
        'tour.algo'
    ];

    protected $allowFilter = [
        'name',
        'email',
    ];

    protected $allowSort = [
        'name',
        'email',
        'commission_dollars',
        'commission_percent',
        'color',
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
        $allowInclude = collect($this->allowInclude); // get allowed relations

        // remove relations that are not allowed
        foreach ($relations as $key => $relationship) {
            if (!$allowInclude->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);

    }

    public function scopeFilter(Builder $query){
        if (!request()->has('filter') || empty($this->allowFilter)) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter); // get allowed filters

        // remove filters that are not allowed
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%'); // add filter to query
            }
        }

    }

    public function scopeSort(Builder $query){
        if (!request()->has('sort') || empty($this->allowSort)) {
            return;
        }

        $sortFields = explode(',', request('sort')); // convert string to array of sort fields
        $allowSort = collect($this->allowSort);

        // remove sort fields that are not allowed
        foreach ($sortFields as $sortField){

            $direction = 'asc';

            if (substr($sortField, 0, 1) === '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query){
        if (request()->has('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
