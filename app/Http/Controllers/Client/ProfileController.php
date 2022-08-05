<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use App\Repositories\Interfaces\ProfileRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    private $clientRepo;
    private $client;

    public function __construct(ProfileRepository $clientRepo, Client $client)
    {
        $this->clientRepo = $clientRepo;
        $this->client     = $client;
    }

    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }

    public function profile($slug)
    {
        $client   = $this->clientRepo->getProfile($this->client, $slug, 'projects');

        $projects =  $client->projects()->withcount('comments')->latest()->paginate(8);


        $project    = new Project();
        $budgets    = Project::budgets();
        $types      = Project::types();
        $categories = $this->categories();
        $tags       = Tag::all();

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
        $id = Auth::guard('client')->id();
        $validator = Validator::make(
            $request->all(),
            [
                'name'        => "string|unique:clients,name,$id",
                'email'       => "string|email|unique:clients,email,$id",
                'phone'       => 'nullable|string',
                'company'     => 'required|string',
                'country'     => 'nullable|alpha',
                'avatar'      => 'nullable|mimes:png,jpg,jpeng|image',
                'about_me'    => 'required|between:10,255',
                'link'        => 'nullable|url|string',
            ]
        );

        if ($validator->fails()) {
            Toastr::error('There Is Something Not Right');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        return $this->clientRepo->updateProfile($this->client, 'client',  $request, 'clients', 'client_id');
    }

    public function changePassword(Request $request)
    {
        return $this->clientRepo->changePassword($request, $this->client, 'client', 'client.login');
    }
}
