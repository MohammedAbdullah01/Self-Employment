<?php

namespace App\Repositories\Interfaces;


interface CategoryRepository
{
    public function index();

    public function getAllProjectsInCategory($slug);

    public function store($request);

    public function update($request,  $category);

    public function destroy($category);

}
