<?php

namespace App\Http\Controllers\User;

use App\Exports\UserAccExport;
use App\Http\Controllers\Controller;
use App\Models\accountNumber as accountModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class accountNumber extends Controller
{
    public $canAdd = 1;
    public $old;

    public function index()
    {
        $this->old = accountModel::where('user_id', auth()->id())->first();
        if ($this->old)
            $this->canAdd = 0;

        return view('dashboard.user.acount_number')
            ->with(['title' => 'حساب بانکی', 'user' => auth()->user()->load('photo'), 'canAdd' => $this->canAdd, 'old' => $this->old]);
    }

    public function add_account(Request $request)
    {
        if ($request->ajax() && $this->canAdd == 1) {
            $Validator = Validator::make($request->all(),
                [
                    'h_sheba' => 'required|numeric',
                    'h_hesab' => 'required|numeric',
                    'h_cart' => 'required|numeric',
                    'b_sheba' => 'required|numeric',
                    'b_hesab' => 'required|numeric',
                    'b_cart' => 'required|numeric'
                ]
                , [], [
                    'h_sheba' => 'شماره شبا',
                    'h_hesab' => 'شماره حساب',
                    'h_cart' => 'شماره کارت',
                    'b_sheba' => 'شماره شبا',
                    'b_hesab' => 'شماره حساب',
                    'b_cart' => 'شماره کارت'
                ]);

            if ($Validator->fails())
                return $Validator->messages()->toJson();
            else {
                if ($request->canEdit) {
                    $edit = accountModel::where('user_id',auth()->id())->first();
                    $request->edit = 0;
                    //return $request->all();
                    if ($edit->update([
                        'h_sheba' => $request->h_sheba,
                        'h_hesab' => $request->h_hesab,
                        'h_cart' => $request->h_cart,
                        'b_sheba' => $request->b_sheba,
                        'b_hesab' => $request->b_hesab,
                        'b_cart' => $request->b_cart,
                        'edit' => 0
                    ]))
                        return 'ok';
                    else
                        return 'error';
                } else {
                    $user_id = auth()->user()->id;
                    $account = new accountModel($request->all());
                    $account->user_id = $user_id;
                    if ($account->save())
                        return 'ok';
                    else
                        return 'error';
                }
            }
        } else
            return redirect('/');
        auth()->logoutOtherDevices();
    }

    public function accountNumber(Request $request)
    {
        //dd($request->all());
        $fil['filter'] = $request->filter;
        $fil['lname'] = $request->lname;
        //dd($filters);
        $uid = auth()->user()
            ->where('code', 'like', '%' . $fil['filter'] . '%')
            ->where('lname', 'like', '%' . $fil['lname'] . '%')
            ->pluck('id', 'id');
        $accounts = accountModel::whereIn('user_id', $uid)->paginate(10);

        return view('dashboard.admin.usersAccounts')->with(['title' => 'حساب‌های بانکی',
            'userActs' => $accounts]);
    }

    public function fileExport()
    {
        return Excel::download(new UserAccExport(), 'accountNumber.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function changeDoEdit(Request $request)
    {
        $uac = \App\Models\accountNumber::find($request->u);
        if ($uac->update(['edit' => !$uac->edit]))
            return 1;
        return 0;
    }
}
