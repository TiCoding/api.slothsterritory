<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait ApiTrait
{

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

    public function scopeFilter(Builder $query)
    {
        if (!request()->has('filter') || empty($this->allowFilter)) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter); // get allowed filters

        // remove filters that are not allowed
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                // check if filter is a relation
                if (strpos($filter, '.') !== false) {
                    // split relation name and attribute name
                    list($relation, $attribute) = explode('.', $filter);
                    // add filter to relation query
                    Log::debug($relation);
                    Log::debug($attribute);
                    Log::debug('%' . $value . '%');
                    $query->orWhereHas($relation, function ($query) use ($attribute, $value) {
                        $words = explode(" ", $value);
                        foreach ($words as $index => $word) {
                            $query->where($attribute, 'LIKE', '%' . $word . '%');
                            if ($index < count($words) - 1) {
                                $query->orWhere($attribute, 'LIKE', '%' . $word . '%');
                            }
                        }
                    });
                } else {
                    // add filter to main query
                    $words = explode(" ", $value);
                    foreach ($words as $index => $word) {
                        $query->orWhere($filter, 'LIKE', '%' . $word . '%');
                        if ($index < count($words) - 1) {
                            $query->orWhere($filter, 'LIKE', '%' . $word . '%');
                        }
                    }
                }
            }
        }
    }

    public function scopeSort(Builder $query)
    {
        if (!request()->has('sort') || empty($this->allowSort)) {
            return;
        }

        $sortFields = explode(',', request('sort')); // convert string to array of sort fields
        $allowSort = collect($this->allowSort);

        // remove sort fields that are not allowed
        foreach ($sortFields as $sortField) {

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

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request()->has('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }

}
