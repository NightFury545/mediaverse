<?php

namespace App\Actions\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class RangeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (is_array($value) && isset($value['from']) && isset($value['to'])) {
            $query->whereBetween($property, [$value['from'], $value['to']]);
        }

        return $query;
    }
}
