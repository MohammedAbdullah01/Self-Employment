<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:admins,email',
            'password' => 'required|string|min:5|max:30',
        ]);

        $admin = $request->only(['email','password']);
        // dd(Auth::guard('web')->attempt($admin));

        if(Auth::guard('admin')->attempt($admin)){
            Toastr::success('Login Admin Successfully :)');
            return redirect()->route('admin.dashboard');
        }else{
            Toastr::error('incorrect Username Or Password');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.show.login');
    }
}
