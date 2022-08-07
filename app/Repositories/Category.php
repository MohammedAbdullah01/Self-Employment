<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Repositories\Interfaces\CategoryRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Category implements CategoryRepository
{
    protected $categoryModel;

    public function __construct(Categorie $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }


    public function index()
    {
        $categories = $this->categoryModel::latest()->paginate();

        return $categories;
    }


    public function getAllProjectsInCategory ($slug)
    {
        $category = $this->categoryModel::where('slug' , $slug)->with('projects')->firstOrFail();

        $projects = $category->projects()->latest()->paginate();

        return $projects;

    }


    public function store($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'        => "required|unique:categories,name|min:4|between:3,50|string",
                'parent_id'   => 'nullable|integer|exists:categories,id',
                'description' => 'required|between:5,255|string',
                'img'         => 'required|mimes:png,jpg,jpeng|image'
            ]
        );

        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if ($request->hasFile('img')) {
            $name_photo = time() . '_' . $request->name . '.' . $request->img->getClientOriginalName();
            $uplode_photo = $request->img->storeAs('categories/', $name_photo, 'public');
        }

        $category    = $this->categoryModel::create([
            'name'        => $request->post('name'),
            'slug'        => Str::slug($request->post('name')),
            'description' => $request->post('description'),
            'parent_id'   => $request->post('parent_id'),
            'img'         => $name_photo,
        ]);
        Toastr::success('Successfully Added Category');
        return redirect()->back();
    }


    public function update($request,  $category)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name'        => "required|unique:categories,name,$category|min:4|between:3,50|string",
                'parent_id'   => 'nullable|integer|exists:categories,id',
                'description' => 'required|between:5,255|string',
                'img'         => 'mimes:png,jpg,jpeng|image'
            ]
        );

        if ($validator->fails()) {
            Toastr::error("There's A data Recording Error");
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $category = $this->categoryModel::findOrFail($category);

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $photo_path = public_path('storage/categories/' . $category->img);
            if (File::exists($photo_path)) {
                File::delete(($photo_path));
            }
            $name_photo = time() . '_' . $request->name . '.' . $request->img->getClientOriginalName();
            $uplode_photo = $request->img->storeAs('categories/', $name_photo, 'public');

            $category->img     = $name_photo;
            $category->save();
        }
        $category->update([

            'name'        => $request->post('name'),
            'slug'        => Str::slug($request->post('name')),
            'description' => $request->post('description'),
            'parent_id'   => $request->post('parent_id'),
        ]);
        Toastr::success('Successfully Updated Category');
        return redirect()->back();
    }


    public function destroy($category)
    {
        $category = $this->categoryModel::findOrFail($category);
        $category->forcedelete();
        $photo_path = public_path('storage/categories/' . $category->img);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted Category :) ');
        return redirect()->back();
    }
}
