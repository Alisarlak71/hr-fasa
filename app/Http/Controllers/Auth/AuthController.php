<?php

namespace App\Http\Controllers\Auth;

use App\Services\Otp;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController
{
    /**
     * @param Request $request
     * @param Otp $otp
     * @return JsonResponse
     * @throws HttpClientException
     */
    public function login(Request $request, Otp $otp): JsonResponse
    {
        $request->validate([
            'cellphone' => ['required', 'numeric' , 'exists:users,cellphone'],
            'password' => ['required'],
//            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('otp_action')]
        ]);


        if (!Auth::attempt($request->only(['cellphone', 'password'])))
            throw new HttpClientException('نام کاربری یا رمز عبور اشتباه است!', 401);

        return new JsonResponse(['message' => 'ورود موفق']);
    }
}
