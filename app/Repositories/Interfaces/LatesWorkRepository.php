<?php

namespace App\Repositories\Interfaces;


interface LatesWorkRepository
{
    public function getlatestWorks();

    public function store($request);

    public function update($request , $id);

    public function destroy($id);
}



