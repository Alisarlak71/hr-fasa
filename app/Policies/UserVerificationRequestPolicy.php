<?php

namespace App\Policies;

use App\Enums\VerificationStatuses;
use App\Models\User;
use App\Models\UserVerificationRequest;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserVerificationRequestPolicy
{
    /**
     * Create a new policy instance.
     */

    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function update(User $user, UserVerificationRequest $user_verification_request): Response
    {
        if ($user->id == $user_verification_request->user_id &&
            $user_verification_request->status == VerificationStatuses::NEED_FOR_EDIT) {
            return Response::allow();
        }

        return Response::deny(trans('messages.errors.forbidden'));
    }
}
