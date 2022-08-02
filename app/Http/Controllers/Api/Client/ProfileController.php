<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\AuthClientResource;
use App\Http\Resources\Client\ProfileResource;
use App\Http\Resources\Client\ProjectResource;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// $project    = new Project();
// $budgets    = Project::budgets();
// $types      = Project::types();
// $categories = $this->categories();
// $tags       = [];

class ProfileController extends Controller
{

    protected function categories()
    {
        return Categorie::pluck('name', 'id')->toArray();
    }

    public function profile()
    {
        $client = Client::where('id', Auth::guard('sanctum')->user()->id)->withCount('projects')->firstOrFail();


        $projects =  $client->projects()->latest()->paginate(12);

        if (!$client->projects_count) {
            return response()->json([
                'client'   => new AuthClientResource($client),
                'Projects' => 'There Are Not Project'
            ]);
        }
        return response()->json([
            'client'   => new AuthClientResource($client),
            'projects' => ProjectResource::collection($projects),
            'count_projects' => $client->projects_count
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
