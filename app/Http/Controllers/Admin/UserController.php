<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatuses;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Rules\Cellphone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $fil['filter'] = $request->filter;
        $fil['lname'] = $request->lname;
        $us = User::where('code', 'like', '%' . $fil['filter'] . '%')
            ->where('lname', 'like', '%' . $fil['lname'] . '%')
            ->orderByDesc('id')->paginate(10);
        return view('dashboard.admin.users')->with(['title' => 'مدیریت کاربران',
            'users' => $us]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'cellphone' => ['required', 'unique:users,cellphone', new Cellphone()],
            'is_admin' => 'required|boolean',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->lname = $request->input('lname');
        $user->cellphone = $request->input('cellphone');
        $user->is_admin = $request->input('is_admin');
        $user->role_id = ($request->input('is_admin') ? 3 : 1);
        $user->save();

        return new JsonResponse(['message' => 'user created successfully', 'user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'cellphone' => ['nullable', Rule::unique('users')->ignore($user->id)],
            'is_admin' => 'nullable|boolean',
        ]);

        $user->name = $request->input('name') ?? $user->name;
        $user->lname = $request->input('lname') ?? $user->lname;
        $user->cellphone = $request->input('cellphone') ?? $user->cellphone;
        $user->is_admin = $request->input('is_admin') ?? $user->is_admin;
        $user->role_id = ($request->input('is_admin') ? 3 : 1) ?? $user->role_id;

        $user->save();

        return new JsonResponse(['message' => 'message updated successfully!', 'user' => $user]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function toggleStatus(User $user): JsonResponse
    {
        $user->status = ($user->status == UserStatuses::ACTIVATED ? UserStatuses::DEACTIVATED : UserStatuses::ACTIVATED);

        $user->save();

        return new JsonResponse(['message' => 'user status updated!']);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return new JsonResponse(['message' => 'user deleted!']);
    }
}
