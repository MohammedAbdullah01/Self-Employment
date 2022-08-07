<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Repositories\Interfaces\ProfileRepository;
use App\Repositories\Project as RepositoriesProject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    private $clientRepo;
    private $projectRepo;
    private $client;

    public function __construct(ProfileRepository $clientRepo, RepositoriesProject $projectRepo, Client $client)
    {
        $this->clientRepo   = $clientRepo;
        $this->projectRepo  = $projectRepo;
        $this->client       = $client;
    }

    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }

    public function profile($slug)
    {
        $client   = $this->clientRepo->getProfile($this->client, $slug, 'projects');

        $projects =  $client->projects()->withcount('comments')->latest()->paginate(8);

        return view(
            'clients.profile',
            [
                'client'     => $client,
                'projects'   => $projects,
                'project'    => new Project(),
                'budgets'    => $this->projectRepo->getBudgets(),
                'types'      => $this->projectRepo->getTypes(),
                'categories' => $this->categories(),
                'tags'       => [],
            ]
        );
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
