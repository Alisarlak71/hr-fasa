<?php

namespace App\Http\Controllers\User;

use App\Jobs\SendSmsJob;
use App\Models\SignIn;
use App\Models\User;
use App\Services\File\FileManager;
use App\Services\Otp;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Validation\ValidationException;

class ProfileController
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.user.profile')->with(['title' => 'پروفایل کاربری', 'user' => Auth::user()->load('photo')]);
    }

    /**
     * @param Request $request
     * @param Otp $otp
     * @return JsonResponse
     */
    public function update(Request $request, Otp $otp): JsonResponse
    {
        $request->validate([
            'name' => 'nullable',
            'cellphone' => 'nullable',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $cellphone = $request->input('cellphone');

        if (!empty($cellphone) && $cellphone != $user->cellphone) {
            $ttl = $otp->ttl($cellphone);

            if ($ttl > 0) {
                return new JsonResponse(['expires_after' => $ttl]);
            } else {
                $code = $otp->generate($cellphone);
                dispatch(new SendSmsJob($cellphone, $code));
                return new JsonResponse(['expires_after' => $otp->expiresAfter(), 'otp' => $code]);
            }
        }

        $user->name = $request->input('name') ?? $user->name;

        $user->save();

        return new JsonResponse(['message' => 'success']);
    }

    /**
     * @param Request $request
     * @param Otp $otp
     * @return JsonResponse
     * @throws ValidationException
     */
    public function confirmUpdate(Request $request, Otp $otp): JsonResponse
    {
        $request->validate([
            'name' => 'nullable',
            'cellphone' => ['required', 'string', 'max:20'],
            'otp' => ['required', 'numeric'],
        ]);

        $cellphone = $request->input('cellphone');
        if (!$otp->check($cellphone, $request->input('otp'))) {
            throw ValidationException::withMessages([
                'error' => 'کد وارد شده اشتباه است'
            ]);
        }

        /** @var User $user */
        $user = Auth::user();
        $user->name = $request->input('name') ?? $user->name;
        $user->cellphone = $cellphone;

        $user->save();

        return new JsonResponse(['message' => 'success']);
    }

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function signIns(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.user.sign_ins')->with(['title' => 'ورود ها', 'sign_ins' => SignIn::whereUserId(Auth::id())->orderByDesc('id')->paginate(10)]);
    }

    /**
     * @param Request $request
     * @param FileManager $fm
     * @return JsonResponse
     */
    public function changePhoto(Request $request, FileManager $fm): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048']
        ]);
        $file = $request->file('file');
        $files = $fm->upload([$file], 'users');
        $fm->attachFile('users', Auth()->id(), $files);
        return new JsonResponse(['messages' => 'files uploaded!']);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = Auth::user();
        $current_password = $request->input('current_password');
        $password = $request->input('password');

        if (Hash::check($current_password, $user->password)) {
            $user->password = Hash::make($password);
            $user->save();
            return new JsonResponse(['message' => 'success']);
        } else
            throw new HttpClientException('کلمه عبور فعلی اشتیاه است!', '401');
    }
}
