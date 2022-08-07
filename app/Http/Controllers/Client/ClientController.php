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
}
