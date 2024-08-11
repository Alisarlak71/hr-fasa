<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserInformationPolicy
{
    /**
     * Create a new policy instance.
     */

    use HandlesAuthorization;
    public function __construct()
    {
    }

    public function view(User $user , UserInformation $userInformation): Response
    {
        if ($user->id == $userInformation->user_id) {
            return Response::allow();
        }

        return Response::deny(trans('context.errors.forbidden'));
    }

    public function update(User $user , UserInformation $userInformation): Response
    {
        return $this->view($user, $userInformation);
    }

    public function delete(User $user , UserInformation $userInformation): Response
    {
        return $this->view($user, $userInformation);
    }
}
