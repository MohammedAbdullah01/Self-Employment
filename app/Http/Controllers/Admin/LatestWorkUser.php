<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Latestwork;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LatestWorkUser extends Controller
{
    public function latestWorksUser( $name )
    {
        $user = User::where('name' ,$name )
            ->with('latestwork')
                ->withCount('latestwork')->firstOrFail();

        $latestwork =  $user->latestwork()->latest()->paginate(4);
        return view('admin.pages.latestworks.show_user_works', compact('user', 'latestwork'));
    }


    public function destroyLatestWork ($id)
    {
        $latestwork = Latestwork::findOrFail($id);
        $search_path_main_picture = public_path('storage/users/latestwork/'  . $latestwork->main_photo);

        if (File::exists($search_path_main_picture)) {
            File::delete($search_path_main_picture);
        }

        foreach ($latestwork->photos as $photo) {

            $search_path_sub_images   = public_path('storage/users/latestwork/'  . $photo->sub_images);

            if (File::exists($search_path_sub_images)) {
                File::delete($search_path_sub_images);
            }
        }

        $latestwork->delete();
        Toastr::success('Successfully Deleted Project');
        return redirect()->back();
    }
}
