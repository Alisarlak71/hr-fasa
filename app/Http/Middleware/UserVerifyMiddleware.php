<?php

namespace App\Http\Middleware;

use App\Enums\VerificationStatuses;
use App\Models\UserInformation;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_information =  UserInformation::whereUserId(Auth::id())->orderByDesc('created_at')->first();
        if(!Auth::user()->isAdmin() && !$user_information)
            return redirect()->route('informations.index');
        return $next($request);
    }
}
