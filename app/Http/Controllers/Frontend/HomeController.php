<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\DashboardRepository;
use App\Repositories\Interfaces\ProjectRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $ProjectRepo;
    private $CategoryRepo;
    private $DashboardRepo;

    public function __construct(ProjectRepository $ProjectRepo, CategoryRepository $CategoryRepo, DashboardRepository $DashboardRepo)
    {
        $this->ProjectRepo  = $ProjectRepo;
        $this->CategoryRepo = $CategoryRepo;
        $this->DashboardRepo = $DashboardRepo;
    }

    public function index()
    {
        return view(
            'frontend.index',
            [
                'categories'               => $this->CategoryRepo->index(),
                'count_Users'              => $this->DashboardRepo->getCountUsers(),
                'count_Works'              => $this->DashboardRepo->getCountWorks(),
                'count_clients'            => $this->DashboardRepo->getCountClients(),
                'count_projects_activate'  => $this->DashboardRepo->getCountProjectsActivate(),
            ]
        );
    }

    public function showProjectsInCategory($slug)
    {
        $projects = $this->CategoryRepo->getAllProjectsInCategory($slug);

        return view('frontend.projects_in_category', compact('projects'));
    }

    public function  browseProjects()
    {

        $projects = Project::with('comments', 'client')->withCount('comments')->latest()->paginate();
        return view('frontend.projects', compact('projects'));
    }


    public function getFindFreelancers()
    {
        $freelancers = $this->DashboardRepo->getAllUsers();

        return view('frontend.find_freelancer', compact('freelancers'));
    }

    public function show($slug)
    {
        $project = $this->ProjectRepo->getOneProject($slug);

        $comments = $project->comments()->latest()->paginate(8);

        return view('frontend.show_project', compact('project', 'comments'));
    }

    public function showContact()
    {
        return view('frontend.contact');
    }
}
