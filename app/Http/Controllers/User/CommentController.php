<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Project;
use App\Repositories\Interfaces\CommentRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller 
{

    private $commentRepo;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
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
        if ($comment->user_id !== Auth::guard('web')->id()) {
            Toastr::error("You Can't Edit a Call Yhat's Not Yours ");
            return redirect()->back();
        }
        return  $this->commentRepo->destroy($comment);
    }
}
