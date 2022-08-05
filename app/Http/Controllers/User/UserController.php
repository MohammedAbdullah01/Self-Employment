<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $authRepo;
    protected $user;

    public function __construct(AuthRepository $authRepo, User $user)
    {
        $this->authRepo = $authRepo;
        $this->user = $user;
    }


    public function showRegister()
    {
        return view('users.auth.register');
    }


    public function store(AuthRequest $request)
    {


        return $this->authRepo->storeDataRegister(
            $request,
            $this->user,
            'user.verify',
            'user_id',
            'user.login'
        );
    }

    public function verify(Request $request)
    {
        return $this->authRepo->verify(
            $request,
            'user',
            'user.login',
        );
    }

    public function showLogin()
    {
        return view('users.auth.login');
    }

    public function checkUserLogin(Request $request)
    {

        return  $this->authRepo->checkLogin(
            $request,
            'users',
            'web',
            'user.profile'

        );
    }


    public function showForgetPassword()
    {
        return view('users.auth.forgot-password');
    }


    public function sendResetLink(Request $request)
    {

        return  $this->authRepo->storeResetLink(
            $request,
            'users',
            'user.password.reset',
        );
    }


    public function showPasswordResetForm(Request $request, $token = null)
    {
        return view('users.auth.confirm-password')->with(['token' => $token, 'email' => $request->email]);
    }


    public function confirmPasswordUpdate(Request $request)
    {

        return $this->authRepo->confirmPassword(
            $request,
            'users',
            $this->user,
            'user.login'
        );
    }

    public function destroy(Request $request)
    {
        return $this->authRepo->logout(
            $request,
            'web',
            'user.login'
        );
    }


// ===================== Old ============================
    // public function showLogin()
    // {
    //     return view('users.auth.login');
    // }



    // public function checkUserLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|string|exists:users,email',
    //         'password' => 'required|string',
    //     ]);


    //     $user = $request->only(['email', 'password']);

    //     if (Auth::guard('web')->attempt($user)) {
    //         $name = Auth::guard('web')->user()->name;
    //         Toastr::success("Dear Sir Welcome::" . $name);
    //         return redirect()->route('user.profile', $name);
    //     } else {
    //         Toastr::error('Incorrect Password');
    //         return redirect()->back();
    //     }
    // }


    // public function showRegister()
    // {
    //     return view('users.auth.register');
    // }

    // public function store(AuthRequest $request)
    // {


    //     try {
    //         $this->auth->storeDataRegister(
    //             $request,
    //             $this->user,
    //             'user.verify',
    //             'user_id'
    //         );
    //         DB::commit();
    //     } catch (Throwable $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    //     Toastr::success('You Need Verify Your Account. We Have Sent You An Activation Link, Please Check Your Email. :) ');
    //     return redirect()->route('user.login');
    // }


    // public function showForgetPassword()
    // {
    //     return view('users.auth.forgot-password');
    // }

    // public function sendResetLink(Request $request)
    // {
    //     $request->validate([
    //         'email'    => 'required|email|exists:users,email|string',
    //     ]);

    //     try {
    //         $this->auth->storeResetLink(
    //             $request,
    //             'user.password.reset',
    //         );
    //         DB::commit();
    //     } catch (Throwable $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    //     Toastr::success('Successfully We Have Your Password Reset Link :) ');
    //     return redirect()->back();
    // }


    // public function showPasswordResetForm(Request $request, $token = null)
    // {
    //     return view('users.auth.confirm-password')->with(['token' => $token, 'email' => $request->email]);
    // }

    // public function confirmPasswordUpdate(Request $request)
    // {
    //     $request->validate([

    //         'email'                 => 'required|email|string|exists:clients,email',
    //         'password'              => 'required|string|min:8|confirmed',
    //         'password_confirmation' => 'required',
    //     ]);


    //     $check_token = $this->auth->confirmPassword($request, $this->client);

    //     if ($check_token) {
    //         Toastr::success('Successfully Your Password Has Been Change :)');
    //         return redirect()->route('user.login')->with('email', $request->email);

    //     } else {
    //         Toastr::error('Invalid Token :(');
    //         return redirect()->back();
    //     }
    // }


    // public function verify(Request $request)
    // {
    //     $token = $request->token;

    //     $verify_user = VerifyUser::where('token', $token)->first();

    //     if (!is_null($verify_user)) {

    //         $user = $verify_user->user;

    //         if (!$user->email_verified) {

    //             $verify_user->user->email_verified = 1;
    //             $verify_user->user->save();

    //             Toastr::success('Your Email Is Verified Successfully You Can Login :)');
    //             return redirect()->route('user.login')->with('verifiyed_email', $user->email);
    //         } else {
    //             Toastr::info('Your Email Is Already Verified  You Can Login :)');
    //             return redirect()->route('user.login')->with('verifiyed_email', $user->email);
    //         }
    //     }
    // }

    // public function destroy(Request $request)
    // {

    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect()->route('user.login');
    // }
}
