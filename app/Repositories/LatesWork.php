<?php

namespace App\Repositories;

use App\Models\Latestwork;
use App\Models\User;
use App\Repositories\Interfaces\LatesWorkRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LatesWork implements LatesWorkRepository
{
    protected $latestWorkModel;

    public function __construct(Latestwork $latestWorkModel)
    {
        $this->latestWorkModel = $latestWorkModel;
    }

    public function getlatestWorks()
    {
        $latestwork =  $this->latestWorkModel::with('user', 'photos', 'category')->latest()->paginate();

        return $latestwork;
    }


    public function store($request)
    {

        $validator = Validator::make($request->all(), [
            "title"        => 'required|between:5,50|string',
            "category_id"  => 'required|exists:categories,id|numeric',
            "description"  => 'required|between:10,300|string',
            "main_photo"   => 'required|image|mimes:jpeg,png,jpg',
            "sub_images.*" => 'image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        if ($request->hasFile('main_photo')) {

            $main_photo = $request->file('main_photo');

            if ($main_photo->isValid()) {

                $name_main_photo = time() . '_' . $main_photo->getClientOriginalName();

                $uplode_path = $main_photo->storeAs('/users/latestwork', $name_main_photo, 'public');
            }
        }

        $latestwork =  $this->latestWorkModel::create([

            'user_id'     => Auth::guard('web')->id(),
            'title'       => $request->post('title'),
            'category_id' => $request->post('category_id'),
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
        Toastr::success("Successfully Created Lates Work ");
        return redirect()->back();
    }

    public function update($request, $latestwork)
    {
        $validator = Validator::make($request->all(), [
            "title"        => 'required|between:5,50|string',
            "category_id"  => 'required|exists:categories,id|numeric',
            "description"  => 'required|between:10,300|string',
            "main_photo"   => 'image|mimes:jpeg,png,jpg',
            "sub_images*" => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $latestwork =  $this->latestWorkModel::where('user_id', Auth::guard('web')->id())->findOrFail($latestwork);

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
            'category_id' => $request->post('category_id'),

        ]);


        if ($request->hasFile('sub_images')) {

            foreach ($latestwork->photos as $subphoto) {
                $search_path_subphoto = public_path('storage/users/latestwork/' . $subphoto->sub_images);
                if (File::exists($search_path_subphoto)) {
                    File::delete($search_path_subphoto);
                    $subphoto->delete();
                }
            }

            $files =  $request->file('sub_images');

            foreach ($files as $file) {
                if ($file->isValid()) {

                    $photo_name = time() . '_' . $file->getClientOriginalName();
                    $uplodePhotos = $file->storeAs('/users/latestwork', $photo_name, 'public');

                    $latestwork->photos()->create(
                        [
                            'sub_images' => $photo_name,
                        ]
                    );
                } else {
                    Toastr::error('There Is Something wrong With Uploading Photos');
                    return redirect()->back();
                }
            }
        }
        Toastr::success('Successfully Created Latestwork');
        return redirect()->back();
    }

    public function destroy($latestwork)
    {

        $latestwork = $this->latestWorkModel::findOrFail($latestwork);
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

        $latestwork->forcedelete();
        Toastr::success('Successfully Deleted Project');
        return redirect()->back();
    }
}
