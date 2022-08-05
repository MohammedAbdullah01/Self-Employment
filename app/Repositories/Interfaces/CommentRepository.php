<?php

namespace App\Repositories\Interfaces;


interface CommentRepository
{

    public function index();

    public function store($request , $project_Id);

    public function update($request, $comment);

    public function destroy($comment);
}
