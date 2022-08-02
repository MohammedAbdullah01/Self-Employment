<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }

    public function profile($name)
    {
        $client = Client::where('name' ,Str::slug($name) )->with('projects')->withCount('projects')->firstOrFail();

        $projects =  $client->projects()->withcount('comments')->latest()->paginate(8);


        $project    = new Project();
        $budgets    = Project::budgets();
        $types      = Project::types();
        $categories = $this->categories();
        $tags       = [];

        return view('clients.profile', compact(
            'client',
            'projects',
            'project',
            'budgets',
            'types',
            'categories',
            'tags',
        ));
    }


    public function update(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'name'        => "alpha|unique:clients,name,$id",
            'email'       => "string|unique:clients,email,$id|unique:users,email",
            'phone'       => 'nullable|string',
            'company'     => 'required|alpha',
            'country'     => 'nullable|alpha',
            'avatar'      => 'nullable|mimes:png,jpg,jpeng|image',
            'about_me'    => 'required|between:10,255',
            'link'        => 'nullable|url|string',
        ]);

        $client = Client::findOrFail(Auth::id());

        $client->update([
            'name'        => $request->post('name'),
            'email'       => $request->post('email'),
            'gander'      => $request->post('gander'),
            'phone'       => $request->post('phone'),
            'title_job'   => $request->post('title_job'),
            'country'     => $request->post('country'),
            'company'     => $request->post('company'),
            'about_me'    => $request->post('about_me'),
            'link'        => $request->post('link'),
        ]);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $photo_path = public_path('storage/clients/' . $client->avatar);

            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }

            $avatar_name = time() . '_' . $request->avatar->getClientOriginalName();
            $upload_path = $request->avatar->storeAs('clients/', $avatar_name, 'public');
            $client->update([
                'avatar' => $avatar_name
            ]);
        }

        // $client->updateOrCreate(
        //     [
        //         'user_id' => $user->id,

        //     ],

        //     [
        //         'name'     => $request->post('name'),
        //         'email'    => $request->post('email'),
        //         'gander'      => $request->post('gander'),
        //         'phone'       => $request->post('phone'),
        //         'title_job'   => $request->post('title_job'),
        //         'country'     => $request->post('country'),
        //         'hourly_rate' => $request->post('hourly_rate'),
        //         'about_me'    => $request->post('about_me'),
        //         'skills'      => $request->post('skills'),
        //         'twitter'     => $request->post('twitter'),
        //         'github'      => $request->post('github'),
        //         'linkedin'    => $request->post('linkedin'),
        //     ]
        // );
        // $username = trim($user->name);
        Toastr::success("Your Personal Data Has Been Modified Successfully");
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword'           => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            Toastr::error('Something Went Wrong');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $client = Client::where('id', Auth::id())->firstOrFail();

        if (!Hash::check($request->post('oldpassword'), $client->password)) {
            Toastr::error('Something Went Wrong');
            return redirect()->back();
        }
        $client->update([
            'password' => Hash::make($request->post('password')),
        ]);

        Auth::guard('client')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Toastr::success('Successfully Changed Password');
        return redirect()->route('client.login');
    }


















    public function dashboard()
    {




        return view('clients.pages.dashboard');
    }
}
