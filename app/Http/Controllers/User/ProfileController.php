<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile( $name )
    {
        $user = User::where('name' ,$name )
            ->with('latestwork')
                ->withCount('latestwork')->firstOrFail();

        $latestwork =  $user->latestwork()->latest()->paginate();
        $commented_projects =  $user->commendProjects()->withCount('comments')->latest()->paginate();
        // dd($commented_projects);
        return view('users.profile', compact('user', 'latestwork' , 'commented_projects'));
    }


    public function update(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'gander'      => 'nullable|in:male,female',
            'name'        => "alpha|unique:users,name,$id",
            'email'       => "string|unique:users,email,$id||unique:clients,email",
            'phone'       => 'nullable|string',
            'title_job'   => 'required|alpha',
            'country'     => 'nullable|alpha',
            'hourly_rate' => 'required|numeric',
            'avatar'      => 'nullable|mimes:png,jpg,jpeng|image',
            'about_me'    => 'required|between:10,255',
            'skills'      => 'required|string',
            'twitter'     => 'nullable|url|string',
            'github'      => 'nullable|url|string',
            'linkedin'    => 'nullable|url|string',
        ]);

        $user = User::findOrFail(Auth::id());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $photo_path = public_path('storage/users/' . $user->avatar);

            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }

            $avatar_name = time() . '_' . $request->avatar->getClientOriginalName();
            $upload_path = $request->avatar->storeAs('users/', $avatar_name, 'public');
            $user->update([
                'avatar'   => $avatar_name
                ]);
        }
        $user->update([
            'name'     => $request->post('name'),
            'email'    => $request->post('email'),
        ]);


        $user->profile()->updateOrCreate(
            [
                'user_id' => $user->id,

            ],

            [
                'gander'      => $request->post('gander'),
                'phone'       => $request->post('phone'),
                'title_job'   => $request->post('title_job'),
                'country'     => $request->post('country'),
                'hourly_rate' => $request->post('hourly_rate'),
                'about_me'    => $request->post('about_me'),
                'skills'      => $request->post('skills'),
                'twitter'     => $request->post('twitter'),
                'github'      => $request->post('github'),
                'linkedin'    => $request->post('linkedin'),
            ]
        );
        Toastr::success("Your Personal Data Has Been Modified Successfully");
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'oldpassword'           => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);
        if ($validator->fails())
        {
            Toastr::error('Erorrrrrrrrrrr');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = User::where('id' , Auth::id())->firstOrFail();

        if(! Hash::check($request->post('oldpassword') , $user->password))
        {
            Toastr::error('Something Went Wrong');
            return redirect()->back();
        }
        $user->update([
            'password' => Hash::make($request->post('password')),
        ]);

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

        Toastr::success('Successfully Changed Password');

            return redirect()->route('user.login');
    }

}
