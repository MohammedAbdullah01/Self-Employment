<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Client;
use App\Repositories\Interfaces\AuthRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $authRepo;
    protected $client;

    public function __construct(AuthRepository $authRepo, Client $client)
    {
        $this->authRepo = $authRepo;
        $this->client = $client;
    }


    public function showRegister()
    {
        return view('clients.auth.register');
    }


    public function store(AuthRequest $request)
    {


        return $this->authRepo->storeDataRegister(
            $request,
            $this->client,
            'client.verify',
            'client_id',
            'client.login'
        );
    }


    public function verify(Request $request)
    {
        return $this->authRepo->verify(
            $request,
            'client',
            'client.login',
        );
    }

    public function showLogin()
    {
        return view('clients.auth.login');
    }


    public function checkClientLogin(Request $request)
    {

        return  $this->authRepo->checkLogin(
            $request,
            'clients',
            'client',
            'client.profile'

        );
    }


    public function showForgetPassword()
    {
        return view('clients.auth.forgot-password');
    }


    public function sendResetLink(Request $request)
    {

        return  $this->authRepo->storeResetLink(
            $request,
            'clients',
            'client.password.reset',
        );
    }


    public function showPasswordResetForm(Request $request, $token = null)
    {
        return view('clients.auth.confirm-password')->with(['token' => $token, 'email' => $request->email]);
    }


    public function confirmPasswordUpdate(Request $request)
    {

        return $this->authRepo->confirmPassword(
            $request,
            'clients',
            $this->client,
            'client.login'
        );
    }


    public function destroy(Request $request)
    {
        return $this->authRepo->logout(
            $request,
            'client',
            'client.login'
        );
    }









    // ========================= Old===================================

    // public function checkClientLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:clients,email|string',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = $request->only(['email', 'password']);

    //     if (Auth::guard('client')->attempt($user)) {
    //         $name = Auth::guard('client')->user()->name;
    //         Toastr::success("Dear Sir Welcome::" . $name);
    //         return redirect()->route('client.profile', $name);
    //     } else {
    //         Toastr::error('Incorrect Password');
    //         return redirect()->back();
    //     }
    // }




    // public function store(AuthRequest $request)
    // {
    //     try {


    //         $this->auth->storeDataRegister(
    //             $request,
    //             $this->client,
    //             'client.verify',
    //             'client_id'
    //         );
    //         DB::commit();
    //     } catch (Throwable $e) {

    //         DB::rollBack();
    //         throw $e;
    //     }

    //     Toastr::success('You Need Verify Your Account. We Have Sent You An Activation Link, Please Check Your Email. :) ');
    //     return redirect()->route('client.login');
    // }


    // public function showForgetPassword()
    // {
    //     return view('clients.auth.forgot-password');
    // }

    // public function sendResetLink(Request $request)
    // {

    //     $request->validate([
    //         'email'    => 'required|email|exists:clients,email',
    //     ]);

    //     try {
    //         $this->auth->storeResetLink(
    //             $request,
    //             'client.password.reset',
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
    //     return view('clients.auth.confirm-password')->with(['token' => $token, 'email' => $request->email]);
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
    //         return redirect()->route('client.login')->with('email', $request->email);

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

    //         $client = $verify_user->client;

    //         if (!$client->email_verified) {

    //             $verify_user->client->email_verified = 1;
    //             $verify_user->client->save();

    //             Toastr::success('Your Email Is Verified Successfully You Can Login :)');
    //             return redirect()->route('client.login')->with('verifiyed_email', $client->email);
    //         } else {
    //             Toastr::info('Your Email Is Already Verified  You Can Login :)');
    //             return redirect()->route('client.login')->with('verifiyed_email', $client->email);
    //         }
    //     }
    // }

    // public function destroy(Request $request)
    // {
    //     Auth::guard('client')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect()->route('client.login');
    // }
}
