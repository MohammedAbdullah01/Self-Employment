<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function  browseProjects()
    {

        $projects = Project::with('comments' , 'client')->withCount('comments')->latest()->paginate();
        Debugbar::debug($projects);
        return view('frontend.projects' , compact('projects'));
    }

    public function show($title)
    {
        $project = Project::where('title' , $title)->with('comments' , 'client')->withCount('comments')->firstOrFail();

        $comments = $project->comments()->latest()->paginate(8);

        return view('frontend.show_project' ,compact('project' , 'comments'));
    }
}
