<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Interfaces\ProfileRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    private $userRepo;
    private $user;

    public function __construct(ProfileRepository $userRepo, User $user)
    {
        $this->userRepo = $userRepo;
        $this->user = $user;
    }



    public function profile($slug)
    {



        $user = $this->userRepo->getProfile($this->user, $slug, 'latestwork');


        $latestwork =  $user->latestwork()->latest()->paginate();
        $commented_projects =  $user->commendProjects()->withCount('comments')->latest()->paginate();
        return view('users.profile', compact('user', 'latestwork', 'commented_projects'));
    }


    public function update(Request $request)
    {
        $id = Auth::guard('web')->id();

        $validator        = Validator::make(
            $request->all(),
            [
                'gander'      => 'nullable|in:male,female',
                'name'        => "string|between:4,30|unique:users,name,$id",
                'email'       => "string|unique:users,email,$id",
                'phone'       => 'nullable|string',
                'title_job'   => 'required|string',
                'country'     => 'nullable|alpha|string',
                'hourly_rate' => 'required|numeric',
                'avatar'      => 'nullable|mimes:png,jpg,jpeng|image',
                'about_me'    => 'required|between:10,255',
                'skills'      => 'required|string',
                'twitter'     => 'nullable|url|string',
                'github'      => 'nullable|url|string',
                'linkedin'    => 'nullable|url|string',
            ]
        );

        if ($validator->fails()) {
            Toastr::error('There Is Something Not Right');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        return $this->userRepo->updateProfile($this->user, 'web',  $request, 'users', 'user_id');
    }

    public function changePassword(Request $request)
    {
        return $this->userRepo->changePassword($request, $this->user, 'web', 'user.login');
    }
}
