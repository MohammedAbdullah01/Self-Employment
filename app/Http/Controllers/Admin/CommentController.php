<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepository;

class CommentController extends Controller
{
    private $commentRepo;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function index()
    {
        $comments = $this->commentRepo->index();

        return view('admin.pages.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        return $this->commentRepo->destroy($comment);
    }
}
