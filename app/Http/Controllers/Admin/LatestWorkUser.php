<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LatesWorkRepository;

class LatestWorkUser extends Controller
{
    private $latestworkRepo;

    public function __construct(LatesWorkRepository $latestworkRepo)
    {
        $this->latestworkRepo = $latestworkRepo;
    }


    public function latestWorks()
    {
        $latestworks = $this->latestworkRepo->getlatestWorks();
        return view('admin.pages.latestworks.latestworks_all', compact('latestworks'));
    }


    public function destroyLatestWork($latestwork)
    {
        return $this->latestworkRepo->destroy($latestwork);
    }
}
