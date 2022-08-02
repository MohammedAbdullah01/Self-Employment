<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUserVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {

            if (!Auth::guard('web')->user()->email_verified) {

                Auth::guard('web')->logout();

                Toastr::warning(
                    '<p>You Need To Confirm Your Account. We Have Sent You An Activation Link ,<b> Please Check Your Email !!</b> </p>',
                    'Title',
                    [
                        "positionClass" => "toast-top-full-width",
                        "progressBar" => true,
                        "timeOut" => "15000",
                    ]
                );
                return redirect()->route('user.login');
            }
        }
        if (Auth::guard('client')->check()) {

            if (!Auth::guard('client')->user()->email_verified) {

                Auth::guard('client')->logout();

                Toastr::warning(
                    '<p>You Need To Confirm Your Account. We Have Sent You An Activation Link ,<b> Please Check Your Email !!</b> </p>',
                    'Title',
                    [
                        "positionClass" => "toast-top-full-width",
                        "progressBar" => true,
                        "timeOut" => "15000",
                    ]
                );
                return redirect()->route('client.login');
            }
        }
        return $next($request);
    }
}
