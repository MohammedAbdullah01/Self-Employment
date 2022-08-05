<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Project;
use App\Repositories\Interfaces\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    private $commentRepo;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }


    public function store(Request $request, Project $project)
    {
        return  $this->commentRepo->store($request, $project->id);
    }


    public function update(Request $request, Comment $comment)
    {
        return  $this->commentRepo->update($request, $comment);
    }


    public function destroy(Comment $comment)
    {
        return  $this->commentRepo->destroy($comment);
    }
}
