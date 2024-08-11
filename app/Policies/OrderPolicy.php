<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Order $order
     * @return Response
     */
    public function view(User $user, Order $order): Response
    {
        if ($user->id == $order->user_id) {
            return Response::allow();
        }

        return Response::deny(trans('messages.errors.forbidden'));
    }

    /**
     * @param User $user
     * @param Order $order
     * @return Response
     */
    public function update(User $user, Order $order): Response
    {
        return $this->view($user, $order);
    }
}
