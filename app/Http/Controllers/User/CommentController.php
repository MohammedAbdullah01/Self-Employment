<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Project $project)
    {
        $request->validate([
            'project_id' => 'required|numeric',
            'comment'    => 'required|string|between:20,200',
        ]);

        // dd($request->all());
        $user = User::findOrFail(Auth::guard('web')->user()->id);

        if ($user->commendProjects()->find($project->id)) {
            Toastr::warning("The Project Was Submitted Before That You Can Edit The Comment :( ");
            return redirect()->back();
        }


        $comment =  Comment::create([
            'project_id' => $request->post('project_id'),
            'user_id'    => Auth::guard('web')->id(),
            'comment'    => $request->post('comment'),
        ]);

        $comment->project->client->notify(new NewCommentNotification($comment, $user));

        Toastr::success("The Comment Was Successfully Stored :) ");
        return redirect()->back();
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
            'project_id' => 'required|numeric',
            'comment'    => 'required|string|between:20,200',
        ]);


        $comment = Comment::findOrFail($id)->update([
            'project_id' => $request->post('project_id'),
            'user_id'    => Auth::id(),
            'comment'    => $request->post('comment'),
        ]);
        Toastr::success("The Comment Was Successfully Updated :) ");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->forcedelete();
        Toastr::success("Successfully Deleted Comment :)");
        return redirect()->back();
    }
}
