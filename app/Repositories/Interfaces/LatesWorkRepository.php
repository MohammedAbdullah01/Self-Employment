<?php

namespace App\Repositories\Interfaces;


interface LatesWorkRepository
{
    public function index();
    public function store($request);
    public function update($request , $id);
    public function destroy($id);
}



