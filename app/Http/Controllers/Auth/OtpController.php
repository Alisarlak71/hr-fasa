<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatuses;
use App\Jobs\SendOtpJob;
use App\Jobs\SendSmsJob;
use App\Models\SignIn;
use App\Models\User;
use App\Services\Otp;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;


class OtpController
{
    /**
     * @param Request $request
     * @param Otp $otp
     * @return JsonResponse
     * @throws HttpClientException
     */
    public function request(Request $request, Otp $otp): JsonResponse
    {
        $request->validate([
            'cellphone' => ['required', 'string', 'max:20'],
//            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('otp_action')]
        ]);

        $cellphone = $request->input('cellphone');
        $is_new = false;

        if (!User::whereCellphone($cellphone)->first()) {
            throw new HttpClientException('کاربر یافت نشد!','401');
            //$is_new = true;
        }

        $ttl = $otp->ttl($cellphone);

        if ($ttl > 0) {
            return new JsonResponse(['expires_after' => $ttl, 'is_new' => $is_new]);
        } else {
            $code = $otp->generate($cellphone);
            dispatch(new SendOtpJob($cellphone, $code));

            return new JsonResponse(['expires_after' => $otp->expiresAfter(), 'otp' => $code, 'is_new' => $is_new]);
        }
    }

    /**
     * @throws ValidationException
     */
    public function submit(Request $request, Otp $otp): JsonResponse
    {
        $request->validate([
            'cellphone' => ['required', 'string', 'max:20'],
//            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('otp_action')]
        ]);

        $cellphone = $request->input('cellphone');
        $user = User::whereCellphone($cellphone)->first();
        $require = 'nullable';
        if (!$user) {
            $require = 'required';
        }

        $request->validate([
            'otp' => ['required', 'numeric'],
            'name' => [$require, 'string'],
            'cellphone' => [$require, 'numeric', 'unique:users,cellphone']
        ]);

        if (!$otp->check($cellphone, $request->input('otp'))) {
            throw ValidationException::withMessages([
                'error' => 'کد وارد شده اشتباه است'
            ]);
        }

        $user = User::whereCellphone($cellphone)->first();

        if (!$user) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->cellphone = $cellphone;
            $user->role_id = 3;
            $user->status = UserStatuses::DEACTIVATED;
            $user->save();
        }

        Auth::login($user);

        $sign_ins = new SignIn();
        $sign_ins->ip = $request->ip();
        $sign_ins->user_id = Auth::id();
        $sign_ins->user_agent = $request->userAgent();
        $sign_ins->save();

        return new JsonResponse(['message' => 'ورود موفق', 'user' => $user]);
    }
}
