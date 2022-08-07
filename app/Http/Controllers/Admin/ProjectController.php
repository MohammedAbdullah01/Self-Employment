<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepository;

class ProjectController extends Controller
{
    private $projectRepo;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }


    public function projectActivte()
    {

        return view('admin.pages.projects.activate_project', ['projects_activate' => $this->projectRepo->getProjectActivte()]);
    }


    public function projectNotActivte()
    {

        return view('admin.pages.projects.not_activate_project', ['projects_not_activate' => $this->projectRepo->getProjectNotActivte()]);
    }


    public function showProject($slug)
    {
        $project = $this->projectRepo->getOneProject($slug);

        $comments = $project->comments()->latest()->paginate();

        return view('admin.pages.projects.show_project', compact('project', 'comments'));
    }

    public function storeActivatProject($project)
    {
        return  $this->projectRepo->updateActivatProject($project);
    }

    public function destroy(Project $project)
    {
        return $this->projectRepo->destroy($project);
    }
}
