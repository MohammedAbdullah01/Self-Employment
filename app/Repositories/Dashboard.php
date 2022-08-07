<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Latestwork;
use App\Models\Project;
use App\Models\User;
use App\Repositories\Interfaces\DashboardRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class Dashboard implements DashboardRepository
{
    protected $ClientModel;
    protected $UserModel;
    protected $ProjectModel;
    protected $CommentModel;
    protected $CatrgoryModel;
    protected $LatestWorkModel;


    public function __construct(
        Client $ClientModel,
        User $UserModel,
        Project $ProjectModel,
        Comment $CommentModel,
        Categorie $CatrgoryModel,
        Latestwork $LatestWorkModel
    ) {
        $this->ClientModel    = $ClientModel;
        $this->UserModel      = $UserModel;
        $this->ProjectModel   = $ProjectModel;
        $this->CommentModel   = $CommentModel;
        $this->CatrgoryModel  = $CatrgoryModel;
        $this->LatestWorkModel  = $LatestWorkModel;
    }


    public function getAllUsers()
    {
        $users = $this->UserModel::withCount('latestwork', 'comments')->latest()->paginate();
        return $users;
    }


    public function destroyOneUser($user)
    {
        $user = $this->UserModel::findOrFail($user);
        $user->forcedelete();
        $photo_path = public_path('storage/users/' . $user->avatar);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted User :) ');
        return redirect()->back();
    }


    public function getAllClients()
    {
        $clients = $this->ClientModel::withCount('projects')->latest()->paginate();
        return $clients;
    }


    public function destroyOneClient($client)
    {
        $client = $this->ClientModel::findOrFail($client);
        $client->forcedelete();
        $photo_path = public_path('storage/clients/' . $client->avatar);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted Client :) ');
        return redirect()->back();
    }

    public function getCountClients()
    {
        return $this->ClientModel::count();
    }

    public function getCountUsers()
    {
        return $this->UserModel::count();
    }

    public function getCountProjectsActivate()
    {
        return $this->ProjectModel::where('activate', 1)->count();
    }

    public function getCountProjectsNotActivate()
    {
        return $this->ProjectModel::where('activate', 0)->count();
    }

    public function getCountComments()
    {
        return $this->CommentModel::count();
    }

    public function getCountCategories()
    {
        return $this->CatrgoryModel::count();
    }

    public function getCountWorks()
    {
        return $this->LatestWorkModel::count();
    }
}
