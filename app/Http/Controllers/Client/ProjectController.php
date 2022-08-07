<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    private $projectRepo;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }


    public function index()
    {
        $projects = Project::where('client_id', Auth::guard('client')->id())->with('category.parent', 'client')->latest()->paginate();

        return view('clients.pages.projects.index', compact('projects'));
    }


    public function store(Request $request)
    {
        return $this->projectRepo->store($request);
    }


    public function update(Request $request, Project $project)
    {
        return $this->projectRepo->update($request, $project);
    }


    public function destroy(Project $project)
    {
        if ($project->client_id !== Auth::guard('client')->id()) {
            Toastr::error("You Can't Edit a Project Not Yours ");
            return redirect()->back();
        }
        return $this->projectRepo->destroy($project);
    }


    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }
}
