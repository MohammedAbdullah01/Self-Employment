<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\projectRequest;
use App\Http\Resources\Client\ProjectResource;
use App\Http\Resources\Users\CommentsResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with([
            'category:id,name,description,img',
            'client:id,name,avatar',
            'tags:id,slug'
        ])->latest()->paginate();

        return $projects;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(projectRequest $request)
    {
        $request->merge([
            'client_id' => Auth::guard('sanctum')->user()->id
        ]);
        $project = Project::create($request->all());

        $tags = explode(',', $request->post('tags'));
        $project->syncTags($tags);

        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $items =  $project->load([
            'category:id,name,description,img',
            'client:id,name,avatar',
            'tags:id,slug',

        ]);
        return response()->json([
            'project' => new ProjectResource($project),
            'comments'=> CommentsResource::collection($project->comments),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'             => 'sometimes|required|string|between:4,30',
            'description'       => 'sometimes|required|string',
            'type'              => 'sometimes|required|in:hourly,fixed',
            'budget'            => 'sometimes|required|string ',
            'category_id'       => 'sometimes|required|numeric ',
            'delivery_period'   => 'numeric',
            'skills'            => 'sometimes|required|string',
            'tags'              => 'nullable|string',
        ]);
        $project = Project::where('client_id', Auth::guard('sanctum')->user()->id)->findOrfail($id);

        $project->update($request->all());

        return response()->json([

            'project' => $project,
            'message' => 'Successfully Updated Project',

        ], 200);
    }

    public function destroy(Project $project)
    {
        $client_project = $project->where('client_id', Auth::guard('sanctum')->user()->id)->first();
        if (!$client_project) {

            return response()->json([
                'message' => 'You cannot delete the project because it is not yours',
            ],404);
        }
        $client_project->forceDelete();
        return response()->json([
            'message' => 'Successfully Deleted Project',
        ], 200);
    }
}
