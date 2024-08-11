<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Morilog\Jalali\Jalalian;

class FilterService
{
    /**
     * Apply filters and sorting to the query.
     *
     * @param Builder $query
     * @param array $filters
     * @param array $sorts
     * @return Builder
     */
    public function apply(Builder $query, array $filters, array $sorts = []): Builder
    {
        foreach ($filters as $field => $value) {
            if ($this->isRelation($field)) {
                $this->applyRelationFilter($query, $field, $value);
            } else if (is_array($value)) {
                $this->applyComplexFilter($query, $field, $value);
            } else if ($value) {
                $this->applySimpleFilter($query, $field, $value);
            }
        }

        foreach ($sorts as $field => $direction) {
            if ($this->isRelation($field)) {
                $this->applyRelationSort($query, $field, $direction);
            } else {
                $query->orderBy($field, $direction);
            }
        }

        return $query;
    }

    /**
     * Apply a simple filter to the query.
     *
     * @param Builder $query
     * @param string $field
     * @param mixed $value
     */
    protected function applySimpleFilter(Builder $query, string $field, mixed $value): void
    {
        $query->where($field, $value);
    }

    /**
     * Apply a complex filter to the query.
     *
     * @param Builder $query
     * @param string $field
     * @param array $value
     */
    protected function applyComplexFilter(Builder $query, string $field, array $value): void
    {
        if (isset($value['operator'])) {
            foreach ($value as $operator => $val) {

                if (is_array($val)) {
                    foreach ($val as $subOperator => $subVal) {
                        if ($field == 'created_at' && $subVal) {
                            $subVal = Jalalian::fromFormat('Y/m/d', $subVal)->toCarbon()->toDateTime();
                            $query->where($field, $subOperator, $subVal);
                        }
                    }
                } else {
                    $query->where($field, $operator, $val);
                }
            }
        }

        if (isset($value['min']) && isset($value['max'])) {
            $query->whereBetween($field, [$value['min'], $value['max']]);
        }

        if (isset($value['like'])) {
            $query->where($field, 'like', '%' . $value['like'] . '%');
        }
    }

    /**
     * Apply a filter to a relationship.
     *
     * @param Builder $query
     * @param string $relationField
     * @param mixed $value
     */
    protected function applyRelationFilter(Builder $query, string $relationField, mixed $value): void
    {
        [$relation, $field] = $this->splitRelationField($relationField);

        $query->whereHas($relation, function (Builder $query) use ($field, $value) {
            if (is_array($value)) {
                $this->applyComplexFilter($query, $field, $value);
            } else if ($value) {
                $this->applySimpleFilter($query, $field, $value);
            }
        });
    }

    /**
     * Apply sorting to a relationship.
     *
     * @param Builder $query
     * @param string $relationField
     * @param string $direction
     */
    protected function applyRelationSort(Builder $query, string $relationField, string $direction): void
    {
        [$relation, $field] = $this->splitRelationField($relationField);

        $query->join($relation.'s', $query->getModel()->getTable() . '.' . $relation . '_id', '=', $relation.'s' . '.id')
            ->orderBy($relation.'s' . '.' . $field, $direction)
            ->select($query->getModel()->getTable() . '.*');
    }

    /**
     * Determine if the field is a relation.
     *
     * @param string $field
     * @return bool
     */
    protected function isRelation(string $field): bool
    {
        return str_contains($field, '.');
    }

    /**
     * Split the relation field into relation name and field name.
     *
     * @param string $field
     * @return array
     */
    protected function splitRelationField(string $field): array
    {
        return explode('.', $field, 2);
    }
}
