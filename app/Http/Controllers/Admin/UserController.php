<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('latestwork','comments')->latest()->paginate();


            return view('admin.pages.users.index' , compact('users'));

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $photo_path = public_path('storage/users/' . $user->avatar);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted User :) ');
        return redirect()->back();
    }
}
