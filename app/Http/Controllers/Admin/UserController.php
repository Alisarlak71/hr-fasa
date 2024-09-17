<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatuses;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\food;
use App\Models\permission;
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

    public function index(Request $request)
    {
        if (auth()->user()->canDo('userList') !== "false") {
            $fil['filter'] = $request->filter;
            $fil['lname'] = $request->lname;
            $us = User::with('getPerm')->where('code', 'like', '%' . $fil['filter'] . '%')
                ->where('lname', 'like', '%' . $fil['lname'] . '%')
                ->orderByDesc('id')->paginate(10);
            return view('dashboard.admin.users')->with(['title' => 'مدیریت کاربران',
                'users' => $us]);
        } elseif (auth()->user()->canDo('userAccount') !== "false")
            return redirect('admin/users/account_number');
        elseif (auth()->user()->canDo('userDocs') !== "false")
            return redirect('admin/users/documents');
        elseif (auth()->user()->canDo('userPresent') !== "false")
            return redirect('admin/users/food');
        else
            return redirect('/');
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

        permission::where('user_id', $user->id)->delete();
        if ($request->input('permUser'))
            permission::insert(['user_id' => $user->id, 'perm' => $request->input('permUser')]);
        if ($request->input('permAccount'))
            permission::insert(['user_id' => $user->id, 'perm' => $request->input('permAccount')]);
        if ($request->input('permDocs'))
            permission::insert(['user_id' => $user->id, 'perm' => $request->input('permDocs')]);
        if ($request->input('permPresent'))
            permission::insert(['user_id' => $user->id, 'perm' => $request->input('permPresent')]);

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

    public function foodPerson(Request $request)
    {
        if (auth()->user()->canDo('userPresent')) {
            $st = \DB::table('setting')->where('text', 'maxTime')->first();
            if (!$st) {
                \DB::table('setting')->insert([
                    'text' => 'maxTime',
                    'value' => 9,
                ]);
                $st = \DB::table('setting')->where('text', 'maxTime')->first();
            }
            $fil['filter'] = $request->filter;
            $fil['lname'] = $request->lname;
            $uid = auth()->user()
                ->where('code', 'like', '%' . $fil['filter'] . '%')
                ->where('lname', 'like', '%' . $fil['lname'] . '%')
                ->pluck('id', 'id');

            $accounts = food::whereIn('user_id', $uid)->whereIn('id', function ($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('user_food')
                    ->whereDate('created_at', \Carbon\Carbon::today())
                    ->groupBy('user_id');
            })->whereDate('created_at', \Carbon\Carbon::today())->where('present', 1)
                ->orderBy('created_at', 'desc')->paginate(10);

            return view('dashboard.admin.foodUsers')->with(['title' => 'حساب‌های بانکی',
                'userActs' => $accounts, 'st' => $st]);
        }
        return redirect('/');
    }
}
