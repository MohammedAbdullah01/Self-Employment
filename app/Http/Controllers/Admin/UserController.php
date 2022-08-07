<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DashboardRepository;

class UserController extends Controller
{
    private $DashboaedRepo;

    public function __construct(DashboardRepository $DashboaedRepo)
    {
        $this->DashboaedRepo = $DashboaedRepo;
    }
    public function index()
    {
        $users = $this->DashboaedRepo->getAllUsers();
        return view('admin.pages.users.index', compact('users'));
    }

    public function destroy($id)
    {
        return  $this->DashboaedRepo->destroyOneUser($id);
    }
}
