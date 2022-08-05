<?php

namespace App\Repositories\Interfaces;


interface ProjectRepository
{
    public function getProjects();

    public function store($request);

    public function update($request, $project);

    public function destroy($project);
}
