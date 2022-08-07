<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProfileRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class  Profile implements ProfileRepository
{

    public function getProfile($ModelName, $Slug, $Relation)
    {
        $user = $ModelName::where('slug', $Slug)->with($Relation)->withCount($Relation)->firstOrFail();

        return $user;
    }


    public function updateProfile($ModelName, $guardName,  $request, $Path_Folder_Avatar, $Forgin_Key)
    {
        $user = $ModelName::findOrFail(Auth::guard($guardName)->id());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $photo_path = public_path("storage/$Path_Folder_Avatar/" . $user->avatar);

            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }

            $avatar_name = time() . '_' . $request->avatar->getClientOriginalName();
            $upload_path = $request->avatar->storeAs("$Path_Folder_Avatar/", $avatar_name, 'public');
            $user->update([
                'avatar'   => $avatar_name
            ]);
        }
        $user->update([
            'name'     => $request->post('name'),
            'email'    => $request->post('email'),
        ]);

        $user->profile()->updateOrCreate([$Forgin_Key => $user->id], $request->all());

        Toastr::success("Your Personal Data Has Been Modified Successfully");
        return redirect()->back();
    }


    public function changePassword($request, $ModelName, $GuardName, $RedirectRoute)
    {
        $validator = Validator::make(
            $request->all(),

            [
                'oldpassword'           => 'required|string',
                'password'              => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            Toastr::error('There Is Something Not Right');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = $ModelName::findOrFail(Auth::guard($GuardName)->id());

        if (!Hash::check($request->post('oldpassword'), $user->password)) {
            Toastr::error('The Old Password Is Incorrect ');
            return redirect()->back();
        }
        $user->update([
            'password' => Hash::make($request->post('password')),
        ]);

        Auth::guard($GuardName)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Toastr::success('Successfully Changed Password');

        return redirect()->route($RedirectRoute);
    }
}
