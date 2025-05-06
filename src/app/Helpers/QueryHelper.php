<?php

namespace App\Helpers;

use Illuminate\Database\Query\Builder;

class QueryHelper
{
    /**
     * Apply a universal search filter to a query based on specified columns.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @param array $columns
     * @param string|null $search
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public static function applySearchFilter($query, array $columns, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'like', "%{$search}%");
            }
        });
    }
}
