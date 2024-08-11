<?php

namespace App\Services\Transaction;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilterService
{
    /**
     * Apply filters to the query.
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $key => $value) {

            if (method_exists($this, $key) && !empty($value) && $key != 'apply') {
                $query = $this->{$key}($query, $value);
            }
        }

        return $query;
    }

    /**
     *
     * @param Builder $query
     * @param string $name
     * @return Builder
     */
    protected function name(Builder $query, string $name): Builder
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     *
     * @param Builder $query
     * @param string $username
     * @return Builder
     */
    protected function username(Builder $query, string $username): Builder
    {
        return $query->where('username', $username);
    }

    /**
     *
     * @param Builder $query
     * @param mixed $user_id
     * @return Builder
     */
    protected function user_id(Builder $query, mixed $user_id): Builder
    {
        return $query->where('user_id', $user_id);
    }

    /**
     *
     * @param Builder $query
     * @param mixed $company_id
     * @return Builder
     */
    protected function company_id(Builder $query, mixed $company_id): Builder
    {
        return $query->where('company_id', $company_id);
    }


    /**
     *
     * @param Builder $query
     * @param string $symbol
     * @return Builder
     */
    protected function symbol(Builder $query, string $symbol): Builder
    {
        return $query->where('symbol', $symbol);
    }

    /**
     *
     * @param Builder $query
     * @param string $symbol
     * @return Builder
     */
    protected function order_no(Builder $query, string $symbol): Builder
    {
        return $query->where('order_no', $symbol);
    }
}
