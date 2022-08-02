<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\VerifyUser;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Auth implements AuthRepository
{

    public function storeDataRegister($request, $ModelName, $route_verify, $user_client_id)
    {

        $user   =  $ModelName::create([

            'name'     => $request->post('name'),
            'email'    => $request->post('email'),
            'password' => Hash::make($request->post('password'))

        ]);

        $last_id    = $user->id;
        $token      = $last_id . hash('sha256', Str::random(120));
        $verify_url = route($route_verify, ['token' => $token]);

        VerifyUser::create([
            $user_client_id => $last_id,
            'token'   => $token,
        ]);

        $message = "Dear Sir:: <b>" . $request->name . "
            </b> <p>Thanks For Registering, We Just Need To Check Your Email Address To Complete Your Account Press The Button Below  </p> ";

        $mail_data = [
            'recipient'    => $request->email,
            'fromEmail'    => $request->email,
            'fromName'     => $request->name,
            'subject'      => 'Email Verification ',
            'body'         => $message,
            'actionLink'   => $verify_url,
        ];

        Mail::send('inc.template-email-verification', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'])
                ->subject($mail_data['subject']);
        });
    }


    public function storeResetLink($request,  $RoutePasswordReset)
    {


        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->post('email'),
            'token'      => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route(
            $RoutePasswordReset,
            [
                'token' => $token,
                'email' => $request->post('email')
            ]
        );

        $body = "we are received a request to reset the password for<b> your app name</b> account
            associated with " . $request->email . " you can reset your password by clicking the link below";

        Mail::send('inc.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('Freelancer@example.com', 'Freelancer');
            $message->to($request->email, 'Your Name')
                ->subject('Reset Password');
        });
    }
    
    public function confirmPassword($request, $ModelName)
    {
        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if ($check_token) {

            $ModelName::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();
            return $check_token;
        }
    }
}
