<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Models\VerifyUser;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthTokensCotroller extends Controller
{

    protected $auth;
    protected $client;

    public function __construct(AuthRepository $auth, Client $client)
    {
        $this->auth = $auth;
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return $user->tokens;
    }

    public function checkClientLogin(Request $request)
    {
        $request->validate([
            'email'       => 'required|exists:clients,email',
            'password'    => 'required|string',
            'device_name' => 'required|string'
        ]);

        $client = Client::where('email', $request->email)->first();

        if ($client && Hash::check($request->password, $client->password)) {

            if (!$client->email_verified) {

                return response()->json([
                    'error' => 'You Need To Confirm Your Account. We Have Sent You An Activation Link  Please Check Your Email !! ',
                ]);
            }

            $token = $client->createToken($request->device_name);

            return response()->json([
                'token'  => $token,
                'client' => $client,

                '_links' => [
                    '_self' => route('api.client.profile')
                ]

            ], 201);
        }
        return response()->json([
            'message' => 'Invalid Credentials',
        ], 401);
    }



    public function store(Request $request)
    {

        $request->validate([
            'email'       => 'required|unique:clients,email',
            'name'        => 'required|alpha|string|unique:users,name|unique:clients,name|between:5,20',
            'password'    => 'required|string',
            'device_name' => 'required|string',
            'password_confirmation' => 'required',
        ]);

        $client =  $this->auth->storeDataRegister(
            $request,
            $this->client,
            'api.client.verify',
            'client_id'
        );

        return response()->json([
            'success' => 'You Need Verify Your Account. We Have Sent You An Activation Link, Please Check Your Email. :) ',
            'route' => route('api.client.login')
        ]);
    }

    public function verify(Request $request)
    {
        $token = $request->token;

        $verify_user = VerifyUser::where('token', $token)->first();

        if (!is_null($verify_user)) {

            $client = $verify_user->client;

            if (!$client->email_verified) {

                $verify_user->client->email_verified = 1;
                $verify_user->client->save();

                return response()->json([
                    'success' => 'Your Email Is Verified Successfully You Can Login :)',
                ]);
            } else {

                return response()->json([
                    'info' => 'Your Email Is Already Verified  You Can Login :)',
                ]);
            }
        }
    }


    public function sendResetLink(Request $request)
    {

        $request->validate([
            'email'    => 'required|email|exists:clients,email',
        ]);

        $this->auth->storeResetLink(
            $request,
            'api.client.password.reset',
        );

        return response()->json([

            'success' => 'You Need Verify Your Email. We Have Sent You a Link To Verify The Owner Of The Account
                The Complete The Process :) ',
        ]);
    }


    public function showPasswordResetForm(Request $request, $token = null)
    {
        return response()->json([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function confirmPasswordUpdate(Request $request)
    {
        $request->validate([

            'email'                 => 'required|email|string|exists:clients,email',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $check_token = $this->auth->confirmPassword($request, $this->client);

        if ($check_token) {

            return response()->json([
                'success' => 'Successfully Your Password Has Been Change :)',
                '_link' => route('api.client.login')
            ]);
            
        } else {

            return response()->json([
                'success' => 'Invalid Token :(',
            ]);
        }
    }



    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        /* Log Out From Current Device */

        // return $user->currentAccessToken()->delete();

        /* Log Out Single From Device */
        $user->tokens()->findOrFail($id)->delete();

        /* Log Out From Device All*/
        // $user->tokens()->delete();

        return response()->json([
            'message' => 'signed out successfully',
        ], 200);
    }
}
