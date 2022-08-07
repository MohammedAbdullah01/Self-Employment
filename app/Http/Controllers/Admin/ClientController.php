<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DashboardRepository;

class ClientController extends Controller
{

    private $DashboardRepo;

    public function __construct(DashboardRepository $DashboardRepo)
    {
        $this->DashboardRepo = $DashboardRepo;
    }


    public function index()
    {
        $clients = $this->DashboardRepo->getAllClients();
        return view('admin.pages.clients.index', compact('clients'));
    }


    public function destroy($client)
    {
        return $this->DashboardRepo->destroyOneClient($client);
    }
}
