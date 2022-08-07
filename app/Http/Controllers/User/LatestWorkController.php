<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LatesWorkRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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


    public function updateLatestWork(Request $request, $latestwork)
    {

        return $this->latestwork->update($request, $latestwork);
    }


    public function destroyLatestWork($latestwork)
    {
        if($latestwork->user_id !==  Auth::guard('web')->id()){

            Toastr::error("You Can't Deleted a Work Not Yours ");
            return redirect()->back();
        }

        return $this->latestwork->destroy($latestwork);
    }
}
