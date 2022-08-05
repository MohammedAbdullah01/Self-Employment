<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\projectRequest;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Interfaces\ProjectRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    private $projectRepo;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('client_id', Auth::guard('client')->id())->with('category.parent', 'client')->latest()->paginate();
        

        Debugbar::debug($projects);

        return view('clients.pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $project    = new Project();
    //     $budgets    = Project::budgets();
    //     $types      = Project::types();
    //     $categories = $this->categories();
    //     $tags    = $project->tags()->pluck('name')->toArray();
    //     return view('clients.pages.profile', compact('budgets', 'project', 'categories', 'types','tags'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\projectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->projectRepo->store($request);
    }

    public function update(Request $request, Project $project)
    {
        return $this->projectRepo->update($request ,$project);
    }


    public function destroy(Project $project)
    {
        return $this->projectRepo->destroy($project);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($slug)
    // {
    //     $project = Project::where('client_id', Auth::id())->where('title', $slug)->firstOrfail();
    //     $tags    = $project->tags()->pluck('name')->toArray();


    //     return view('clients.pages.projects.edit', [
    //         'project'    => $project,
    //         'budgets'    => Project::budgets(),
    //         'types'      => Project::types(),
    //         'categories' => $this->categories(),
    //         'tags'       => $tags,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }
}
