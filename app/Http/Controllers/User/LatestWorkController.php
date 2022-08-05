<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LatesWorkRepository;

class LatestWorkController extends Controller
{
    private $latestwork;

    public function __construct(LatesWorkRepository $latestwork)
    {
        $this->latestwork = $latestwork;
    }

    public function storeLatestWork(Request $request)
    {

        return $this->latestwork->store($request);
    }


    public function updateLatestWork(Request $request, $id)
    {

        return $this->latestwork->update($request, $id);
    }


    public function destroyLatestWork($id)
    {

        return $this->latestwork->destroy($id);
    }
}
