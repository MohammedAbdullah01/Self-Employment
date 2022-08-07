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
}
