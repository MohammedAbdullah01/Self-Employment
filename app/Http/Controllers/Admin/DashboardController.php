<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $DashboardRepo;
    public function __construct(DashboardRepository $DashboardRepo)
    {
        $this->DashboardRepo = $DashboardRepo;
    }
    public function index()
    {
        return view(
            'admin.dashboard',
            [
                'count_Users'                 => $this->DashboardRepo->getCountUsers(),
                'count_Works'                 => $this->DashboardRepo->getCountWorks(),
                'count_clients'               => $this->DashboardRepo->getCountClients(),
                'count_comments'              => $this->DashboardRepo->getCountComments(),
                'count_categories'            => $this->DashboardRepo->getCountCategories(),
                'count_projects_activate'     => $this->DashboardRepo->getCountProjectsActivate(),
                'count_projects_not_activate' => $this->DashboardRepo->getCountProjectsNotActivate(),
            ]
        );
    }
}
