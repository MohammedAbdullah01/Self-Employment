<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interface\ProductInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Businessphotos;
use Illuminate\Http\Request;
use App\Models\Latestwork;
use Illuminate\Support\Facades\Validator;

class LatestWorkController extends Controller
{

    public function storeLatestWork(Request $request)
    {


        // $validator = Validator::make($request->all(),[
        //     "title"        => 'required|between:5,50|string',
        //     "description"  => 'required|between:10,300|string',
        //     "main_photo"   => 'required|image|mimes:jpeg,png,jpg',
        //     "sub_images.*"  => 'image|mimes:jpeg,png,jpg',
        //     ]);
        //     if($validator->fails()){
        //         Toastr::error('Erorrrrrrrrrrr');
        //         return redirect()->back()->withErrors($validator)->withInput($request->all());
        //     }



        $validator = $request->validate([
            "title"        => 'required|between:5,50|string',
            "description"  => 'required|between:10,300|string',
            "main_photo"   => 'required|image|mimes:jpeg,png,jpg',
            "sub_images*"  => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('main_photo')) {

            $main_photo = $request->file('main_photo');

            if ($main_photo->isValid()) {

                $name_main_photo = time() . '_' . $main_photo->getClientOriginalName();

                $uplode_path = $main_photo->storeAs('/users/latestwork', $name_main_photo, 'public');
            }
        }

        $latestwork =  Latestwork::create([

            'user_id'     => Auth::id(),
            'title'       => $request->post('title'),
            'description' => $request->post('description'),
            'main_photo'  => $name_main_photo,
        ]);


        if ($request->hasFile('sub_images')) {
            $files =  $request->file('sub_images');
            foreach ($files as $file) {
                if ($file->isValid()) {

                    $photo_name = time() . '_' . $file->getClientOriginalName();
                    $uplodePhotos = $file->storeAs('/users/latestwork', $photo_name, 'public');

                    $latestwork->photos()->create([
                        'sub_images' => $photo_name,
                    ]);
                } else {
                    Toastr::error('There Is Something wrong With Uploading Photos');
                    return redirect()->back();
                }
            }
        }
        Toastr::success('Successfully Created Latestwork');
        return redirect()->back();
    }




    public function updateLatestWork(Request $request, $id)
    {



        $validator = $request->validate([
            "title"        => 'required|between:5,50|string',
            "description"  => 'required|between:10,300|string',
            "main_photo"   => 'image|mimes:jpeg,png,jpg',
            "sub_images*"  => 'image|mimes:jpeg,png,jpg',
        ]);

        $latestwork =  Latestwork::where('user_id', Auth::id())->findOrFail($id);



        if ($request->hasFile('main_photo') && $request->file('main_photo')->isValid()) {

            $search_path_main_picture = public_path('storage/users/latestwork/' . $latestwork->main_picture);

            if (File::exists($search_path_main_picture)) {
                File::delete($search_path_main_picture);
            }

            $main_photo = $request->file('main_photo');

            $name_main_photo = time() . '_' . $main_photo->getClientOriginalName();

            $uplode_path = $main_photo->storeAs('/users/latestwork', $name_main_photo, 'public');
            $latestwork->update([
                'main_photo'  => $name_main_photo,
            ]);
        }
        $latestwork->update([
            'title'       => $request->post('title'),
            'description' => $request->post('description'),

        ]);


        if ($request->hasFile('sub_images')) {
            $files =  $request->file('sub_images');
            foreach ($files as $file) {
                if ($file->isValid()) {

                    $photo_name = time() . '_' . $file->getClientOriginalName();
                    $uplodePhotos = $file->storeAs('/users/latestwork', $photo_name, 'public');

                    $latestwork->photos()->create([
                        'sub_images' => $photo_name,
                    ]);
                } else {
                    Toastr::error('There Is Something wrong With Uploading Photos');
                    return redirect()->back();
                }
            }
        }
        Toastr::success('Successfully Created Latestwork');
        return redirect()->back();
    }

    public function destroyLatestWork($id)
    {
        $latestwork = Latestwork::where('user_id', Auth::id())->findOrFail($id);
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

    public function destroySubPhoto($id)
    {

        $sub_photo = Businessphotos::findOrfail($id);

        $search_path_sub_images   = public_path('storage/users/latestwork/' . $sub_photo->sub_images);

        if (File::exists($search_path_sub_images)) {

            File::delete($search_path_sub_images);
        }

        $sub_photo->delete();

        Toastr::success('Successfully Deleted Photo');
        return redirect()->back();

        // Toastr::error('There is something not right');
        // return redirect()->back();
    }
}
