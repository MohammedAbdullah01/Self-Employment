<?php

namespace App\Repositories;

use App\Models\Project as ModelsProject;
use App\Repositories\Interfaces\ProjectRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Project implements ProjectRepository

{
    public function getProjects()
    {
    }

    public function store($request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title'             => 'required|string|between:4,30',
                'description'       => 'required|string',
                'type'              => 'required|in:hourly,fixed',
                'budget'            => 'required|string ',
                'category_id'       => 'required|numeric ',
                'delivery_period'   => 'numeric',
                'skills'            => 'required|string',
                'tags'              => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $project = ModelsProject::create([
            'title'             => $request->post('title'),
            'slug'              => Str::slug($request->post('title')),
            'description'       => $request->post('description'),
            'type'              => $request->post('type'),
            'budget'            => $request->post('budget'),
            'category_id'       => $request->post('category_id'),
            'delivery_period'   => $request->post('delivery_period'),
            'skills'            => $request->post('skills'),
            'client_id'         => Auth::guard('client')->id()
        ]);



        $tags = explode(',', $request->post('tags'));
        $project->syncTags()->attach($request->post('tags'));


        Toastr::success('The Project Has Been Successfully Added :)');
        return redirect()->back();
    }

    public function update($request, $project)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title'             => 'required|string|between:4,30',
                'description'       => 'required|string',
                'type'              => 'required|in:hourly,fixed',
                'budget'            => 'required|string ',
                'category_id'       => 'required|numeric ',
                'delivery_period'   => 'numeric',
                'skills'            => 'required|string',
                'tags'              => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }



        if ($project->client_id !== Auth::guard('client')->id()) {
            Toastr::error("You Can't Edit a Project Not Yours ");
            return redirect()->back();
        }

        $project->update([
            'title'             => $request->post('title'),
            'slug'              => Str::slug($request->post('title')),
            'description'       => $request->post('description'),
            'type'              => $request->post('type'),
            'budget'            => $request->post('budget'),
            'category_id'       => $request->post('category_id'),
            'delivery_period'   => $request->post('delivery_period'),
            'skills'            => $request->post('skills'),
            'client_id'         => Auth::guard('client')->id()
        ]);

        $tags = explode(',', $request->post('tags'));
        $project->syncTags($tags);

        Toastr::success('The Project Has Been Successfully Updated :) ');
        return redirect()->back();
    }

    public function destroy($project)
    {
        if ($project->client_id !== Auth::guard('client')->id()) {
            Toastr::error("You Can't Edit a Project Not Yours ");
            return redirect()->back();
        }
        $project->forcedelete();
        Toastr::success("Successfully Deleted Project :)");
        return redirect()->back();
    }
}
