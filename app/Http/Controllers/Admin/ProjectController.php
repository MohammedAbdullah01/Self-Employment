<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectActivte()
    {
        $projects_activate = Project::where('activate' , 1)->latest()->paginate();

            return view('admin.pages.projects.activate_project' , compact('projects_activate'));
    }


    public function projectNotActivte()
    {
        $projects_not_activate = Project::where('activate' , 0)->latest()->paginate();

            return view('admin.pages.projects.not_activate_project' , compact('projects_not_activate'));
    }


    public function showProject($title)
    {
        $project = Project::with('comments')->where('title' , $title)->firstOrFail();

        $comments = $project->comments()->latest()->paginate();

            return view('admin.pages.projects.show_project' , compact('project' , 'comments'));
    }

    public function storeActivatProject($id)
    {
        $projects_activate = Project::where('id' ,  $id)->update([
            'activate' => 1
        ]);
        Toastr::success('Succrssfully Activat Project :)');
        return redirect()->back();

    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        Toastr::success('Succrssfully Delete Project :)');
        return redirect()->back();
    }


}
