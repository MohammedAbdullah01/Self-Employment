<?php

namespace App\Repositories\Interfaces;


interface ProjectRepository
{
    public function getProjects();

    public function getProjectActivte();

    public function getProjectNotActivte();

    public function getOneProject($slug);

    public function updateActivatProject($project);

    public function store($request);

    public function update($request, $project);

    public function destroy($project);

}
