<?php

namespace App\Http\Controllers\Auth;
class LogoutController
{
    public function logout(){
        \Auth::logout();
        return redirect()->route('login');
    }
}
