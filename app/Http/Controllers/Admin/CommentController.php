<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('project','user')->latest()->paginate();

            return view('admin.pages.comments.index' , compact('comments'));

    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::success("Successfully Deleted Comment :)");
        return redirect()->back();
    }
}
