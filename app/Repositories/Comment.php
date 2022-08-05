<?php

namespace App\Repositories;

use App\Models\Comment as ModelsComment;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use App\Repositories\Interfaces\CommentRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class Comment implements CommentRepository
{
    public function index()
    {
    }

    public function store($request, $project_Id)
    {
        $request->validate([
            'project_id' => 'required|numeric',
            'comment'    => 'required|string|between:20,255',
        ]);

        $user = User::findOrFail(Auth::guard('web')->id());

        if ($user->commendProjects()->find($project_Id)) {
            Toastr::warning("The Project Was Submitted Before That You Can Edit The Comment :( ");
            return redirect()->back();
        }


        $comment =  ModelsComment::create([
            'project_id' => $request->post('project_id'),
            'user_id'    => Auth::guard('web')->id(),
            'comment'    => $request->post('comment'),
        ]);

        $comment->project->client->notify(new NewCommentNotification($comment, $user));

        Toastr::success("The Comment Was Successfully Stored :) ");
        return redirect()->back();
    }

    public function update($request, $comment)
    {

        $request->validate([
            'project_id' => 'required|numeric',
            'comment'    => 'required|string|between:20,255',
        ]);

        if ($comment->user_id !== Auth::guard('web')->id()) {
            Toastr::error("You Can't Edit a Comment  Not Yours ");
            return redirect()->back();
        }

        $comment->update([
            'comment'    => $request->post('comment'),
        ]);
        Toastr::success("The Comment Was Successfully Updated :) ");
        return redirect()->back();
    }

    public function destroy($comment)
    {
        if ($comment->user_id !== Auth::guard('web')->id()) {
            Toastr::error("You Can't Edit a Call Yhat's Not Yours ");
            return redirect()->back();
        }
        $comment->forcedelete();
        Toastr::success("Successfully Deleted Comment :)");
        return redirect()->back();
    }
}
