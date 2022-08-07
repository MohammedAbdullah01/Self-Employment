<?php

namespace App\Repositories\Interfaces;

interface  DashboardRepository
{
    public function getAllUsers();

    public function destroyOneUser($user);

    public function getAllClients();

    public function destroyOneClient($client);

    public function getCountClients();

    public function getCountUsers();

    public function getCountProjectsActivate();

    public function getCountProjectsNotActivate();

    public function getCountComments();

    public function getCountCategories();

    public function getCountWorks();
}
